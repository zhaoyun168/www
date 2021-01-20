<?php
/**
 * OAuth2服务
 */
namespace app\schedule\controller;

use base\controller\HomeBaseController;
use platform\common\LoggerClient;

class OauthController extends HomeBaseController
{
    
    private $storage;       //数据库链接
    private $server;        //OAuth2服务

    //monolog object
    private $_instance;
    //monolog instance
    private $logger;
 
    public function __construct()
    {
        if (!($this->_instance instanceof LoggerClient)) {
            $this->_instance = new LoggerClient();
        }
        $this->logger = $this->_instance->getMonolog('soap_server', BASE_ROOT . 'log/oauth1/'.date('Y-m-d').'.log', 0);
        
        \OAuth2\Autoloader::register();        //注册OAuth2服务        
        $dsn = "mysql:dbname=oauth;host=127.0.0.1";
        $this->storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => 'root', 'password' => ''));
        $this->server = new \OAuth2\Server($this->storage);
    }
    /**
     * 获取令牌（access_token）
     */
    public function token()
    {
        $this->server->addGrantType(new \OAuth2\GrantType\ClientCredentials($this->storage));
        $this->server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($this->storage));
        $this->server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
    }
 
    /**
     * 通过令牌获取用户信息
     */
    public function resource()
    {
        if (!$this->server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
            $this->server->getResponse()->send();
            die;
        }
        $token = $this->server->getAccessTokenData(\OAuth2\Request::createFromGlobals());
        //$token['user_id']就是用户id，然后再通过user_id在数据库里查询用户信息并返回即可。
        //echo "User ID associated with this token is {$token['user_id']}";
        
        $user_info = [
            'user_id' => 1,
            'user_name' => 'tianyu',
            'user_profiles' => 'PHP architect',
        ];

        echo json_encode($user_info);
    }
 
    public function authorize()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
    
        // validate the authorize request
        if (!$this->server->validateAuthorizeRequest($request, $response)) {
            $response->send();
            exit();
        }
        // display an authorization form
        if($_GET['authorized']){
                $is_authorized = ($_GET['authorized']=='yes');
                $userid = 1;  //用户的id
                $this->server->handleAuthorizeRequest($request, $response, $is_authorized,$userid);
                if ($is_authorized) {
                    //同意授权
                    //保存用户授权的选项(略)                
                    //生成授权码(Authorization Code)
                    $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
                    //exit("SUCCESS! Authorization Code: $code");                
                    $response->send();exit();
                
                }else{
                   //没有授权
                }
        }else{
            //展示授权视图
            exit('<form method="post"><label>Do You Authorize TestClient?</label><input name="authorized" type="submit" value="yes" /> <input name="authorized" type="submit" value="no" /></form>'); 
       } 
   } 

   public function oauth()
    {
        //1.得到授权码(Authorization Code)
        $code = $_GET['code'];    
        //2.通过授权码得到令牌(Access_token)
        $post_data = array(
            'grant_type'=>'authorization_code',
            'client_id'=>'testclient',
            'client_secret'=>'testpass',
            'redirect_uri'=>'http://localhost/sybtmb_test/public/index.php/api/test',
            'code'=>$code
        );
        $result = $this->post('http://localhost/sybtmb_test/public/index.php/schedule/oauth/token',$post_data);
        $result = json_decode($result,true);
        $token = $result['access_token'];
        if(!$token) exit("获取令牌失败");
        //3.通过令牌获取用户基本信息
        $userinfo = $this->post('http://localhost/sybtmb_test/public/index.php/schedule/oauth/resource',['access_token'=>$token]);
        $userinfo = json_decode($userinfo,true);
        print_r($userinfo);exit();
    }
     
     
    // 发送post请求
    // @param string $url 请求地址
    // @param array $post_data post键值对数据
    // @return string
    public function post($url, $post_data){
        $o="";
        foreach ($post_data as $k=>$v)
        {
            $o.= "$k=".urlencode($v)."&";
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        $this->logger->info(sprintf('[%s]返回结果[%s]', $this->_instance->uniqid, $result));
        curl_close($ch);
        return $result;
    }
}
