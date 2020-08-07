<?php
class Person {
 

 /**
  * For the sake of demonstration, we"re setting this private
  */
 private $_allowDynamicAttributes = false;

 /**
  * type=primary_autoincrement
  */
 protected $id = 0;

 /**
  * type=varchar length=255 null
  */
 protected $name;

 /**
  * type=text null
  */
 protected $biography;

 public function getId() {
  return $this->id;
 }

 public function setId($v) {
  $this->id = $v;
 }

 public function getName() {
  return $this->name;
 }

 public function setName($v) {
  $this->name = $v;
 }

 public function getBiography() {
  return $this->biography;
 }

 public function setBiography($v) {
  $this->biography = $v;
 }
}

$class = new ReflectionClass('Person'); // 建立 Person这个类的反射类  
//$instance  = $class->newInstanceArgs($args); // 相当于实例化Person 类 

$properties = $class->getProperties();
foreach ($properties as $property) {
 echo $property->getName() . "<br>";
}

echo '<br>';

foreach ($properties as $property) {
 if ($property->isProtected()) {
  $docblock = $property->getDocComment();
  preg_match('/ type\=([a-z_]*) /', $property->getDocComment(), $matches);
  echo $matches[1] ?? '' . "<br>";
 }
}

echo '<br>';

$method = $class->getMethods();       //来获取到类的所有methods
print_r($method);

var_dump($class->hasMethod('setName'));
var_dump($class->getMethod('setName'));
/*$class->hasMethod(string)  //是否存在某个方法
$class->getMethod(string)  //获取方法*/

echo '<br>';

// 执行detail方法
$method = new ReflectionMethod('Person', 'setName');
 

if ($method->isPublic() && !$method->isStatic()) {
 echo 'Action is right';
}
echo $method->getNumberOfParameters(); // 参数个数
var_dump($method->getParameters()); // 参数对象数组