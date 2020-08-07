<?php
class MysqlPool
{
    private $min; // 最小连接数
    private $max; // 最大连接数
    private $count; // 当前连接数
    private $redis; // redis连接
    protected $freeTime; // 用于空闲连接回收判断

    public static $instance;

    /**
     * MysqlPool constructor.
     */
    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1',6379);

        $this->min = 10;
        $this->max = 100;
        $this->freeTime = 10 * 3600;
    }

    /**
     * @return MysqlPool
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 创建连接
     * @return MySQL
     */
    protected function createConnection()
    {
        $conn = mysqli_connect('192.168.100.107', 'root', '');
        mysqli_select_db($conn, 'yb_settlement');
        mysqli_query($conn,"SET NAMES utf8");

        $sql = 'select * from yb_pay';
        $result = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result);

        print_r($res);
        exit;

        return $conn;
    }

    /**
     * 创建连接对象
     * @return array|null
     */
    protected function createConnObject()
    {
        $conn = $this->createConnection();
        return $conn ? ['last_used_time' => time(), 'conn' => $conn] : null;
    }

    /**
     * 初始化连接
     * @return $this
     */
    public function init()
    {
        for ($i = 0; $i < $this->min; $i++) {
            $obj = $this->createConnObject();
            $this->count++;
            $this->redis->lpush('connections',json_encode($obj));
        }

        return $this;
    }

    /**
     * 获取连接
     * @param int $timeout
     * @return mixed
     */
    public function getConn($timeout = 3)
    {
        if (empty($this->redis->lsize('connections'))) {
            if ($this->count < $this->max) {
                $this->count++;
                $obj = $this->createConnObject();
            } else {
                $obj = $this->redis->lpop('connections');
            }
        } else {
            $obj = $this->redis->lpop('connections');
        }

        $obj = json_decode($obj, true);

        return $obj['conn'] ? $obj['conn'] : $this->getConn();
    }

    /**
     * 回收连接
     * @param $conn
     */
    public function recycle($conn)
    {
        if ($conn) {
            $this->redis->lpush('connections',json_encode(['last_used_time' => time(), 'conn' => $conn]));
        }
    }

    public function query($conn, $sql)
    {
        $result = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result);

        return $res;
    }

    /**
     * 回收空闲连接
     */
    public function recycleFreeConnection()
    {
        // 每 2 分钟检测一下空闲连接
       if ($this->redis->lsize('connections') < intval($this->max * 0.5)) {
           // 请求连接数还比较多，暂时不回收空闲连接
           return;
       }

       if (empty($this->redis->lsize('connections'))) {
           return;
       }

       $connObj = $this->redis->lpop('connections');
       $connObj = json_decode($connObj, true);
       $nowTime = time();
       $lastUsedTime = $connObj['last_used_time'];

       // 当前连接数大于最小的连接数，并且回收掉空闲的连接
       if ($this->count > $this->min && ($nowTime - $lastUsedTime > $this->freeTime)) {
           mysqli_close($connObj['conn']);
           $this->count--;
       } else {
           $this->redis->lpush('connections',json_encode($connObj));
       }
    }
}

MysqlPool::getInstance()->init()->recycleFreeConnection();
$conn = MysqlPool::getInstance()->getConn();

$result = MysqlPool::getInstance()->query($conn, 'select * from yb_pay');

print_r($result);
MysqlPool::getInstance()->recycle($conn);
