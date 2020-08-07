<?php
/**
 * 基本redis实现的环形消息队列
 * 用法:
 * use Com\RingQueue;
 * $queue = RingQueue::getInstance('msg');
 *
 * 加入队列
 * $queue->push('aaaaaa');
 * $queue->push('bbbbb');
 * 读取队列
 * $value = $queue->pop()
 *
 * 删除队列
 * $queue->flushQueue();
 */
class RingQueue
{
    static public $timeout = 1;
    static public $queueName = 'ring_queue';
    public $redis;
    public $current_index;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1',6379);
    }

    public function set_current_index($index)
    {
        $this->redis->set('current_index', $index);
    }

    public function get_current_index()
    {
        return $this->redis->get('current_index');
    }

    public function get_task($current_index)
    {
        return $this->redis->sMembers('task_'.$current_index);
    }

    public function delete($current_index, $value)
    {
        return $this->redis->srem('task_'.$current_index, $value);
    }

    /**
     * 取得缓存类实例
     * @static
     * @access public
     * @return mixed
     */
    public function getInstance($queueName)
    {
        self::$queueName = 'ring_' . $queueName;
        static $_instance = array();
        if (!isset($_instance[self::$queueName])) {
            $_instance[self::$queueName] = new RingQueue();
        }
        return $_instance[self::$queueName];
    }
    //设置队列名称
    public static function setQueueName($name)
    {
        self::$queueName = 'ring_' . $name;
    }
    /**
     * 添加队列(lpush)
     * @param string $value
     * @return int 队列长度
     */
    public function push($value)
    {
        return $this->redis->lPush(self::$queueName, $value);
    }
    /**
     * 读取队列,将读取到的值放在队列最左侧
     * @return string|nil
     */
    public function pop()
    {
        $result = $this->redis->brPop(self::$queueName, self::$timeout);
        if (empty($result)) {
            return $result;
        } else {
            //将取出来的值添加到最队列最左侧
            $this->redis->lPush(self::$queueName, $result[1]);
             return $result[1];
        }
    }
    /**
     * 删除一个消息队列
     */
    public function flushQueue()
    {
        $this->redis->delete(self::$queueName);
    }
    /**
     * 返回队列长茺
     * @return int
     */
    public function len()
    {
        return $this->redis->LLEN(self::$queueName);
    }
}

$RingQueue = new RingQueue();
$queue = $RingQueue->getInstance('msg');

//$queue->flushQueue();

//加入队列

/*for ($i=1; $i <= 60; $i++) { 
    $queue->push($i);
}*/
/*$queue->push('1');
$queue->push('2');
$queue->push('3');
$queue->push('4');
$queue->push('5');*/
//读取队列

while (true) {
    $value = $queue->pop();

    echo date('Y-m-d H:i:s');

    $queue->set_current_index($value);

    echo "\n\r";

    echo $current_index = $queue->get_current_index();

    echo "\n\r";

    $result = $queue->get_task($current_index);

    print_r($result);

    foreach ($result as $key => $value) {
        $queue->delete($current_index, $value);    
    }

    sleep(1);
}
?>