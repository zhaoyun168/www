<?php
/**
 * 钩子类
 */
class Hook
{
  static public function execute($type, $model='')
  {
    if($model == ''){
      $m = new Hello();
    }else{
      $m = new $model();
    }
    if($type == 'string'){
      $m->string();
    }elseif($type == 'arr'){
      $m->arr();
    }
  }
}
class Test
{
  public static function example()
  {
    Hook::execute('string');
    echo 'hello<br/>';
    Hook::execute('arr');
  }
}
//我们只要改动一个外部的Hello类,就可以实现对系统内部的控制了
class Hello
{
  public function string()
  {
    $str = '我是一个钩子测试<br>';
    echo $str;
  }
  public function arr()
  {
    $arr = array(1,2,3,4,5,6);
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
  }
}
Test::example();