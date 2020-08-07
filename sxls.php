<?php

class ArrayList{

   private $list;

   private $size; 

   //构造函数

   public function __construct(){

      $this->list=array();

      $this->size=0;

   } 

   public function initList(){

      $this->list=array();

      $this->size=0;

   } 

   //删除链表

   public function destoryList(){

      if(isset($this->list)){

         unset($this->list);

        $this->size=0;

      }

   } 

   //清空链表

   public function clearList(){

      if(isset($this->list)){

        unset($this->list);        

      }

      $this->list=array();

      $this->size=0;

   } 

   //判断链表是否为空

   public function emptyList(){

      if(isset($this->list)){

         if($this->size=0)

           return TRUE;

        else

          return FALSE;

      }

   } 

   //链表长度

   public function lenghtList(){

      if(isset($this->list)){

        return $this->size;

      }

   } 

   //取元素

   public function getElem($i){

      if($i<1||$i>$this->size){

        echo "溢出<br>";

        exit();

      }

      if(isset($this->list)&&is_array($this->list)){

        return $this->list[$i-1];

      }      

   }

  

   //是否在链表中

   public function locateElem($e){

      if(isset($this->list)&&is_array($this->list)){

     

        for($i=0;$i<$this->size;$i++){  

           if($this->list[$i]==$e){

              return $i+1;         

           }

        }

        return 0;

      }

   } 

   //前驱

   public function priorElem($i){

      if($i<1||$i>$this->size){

        echo "溢出";

        exit();

      }

      if($i==1){

        echo "没有前驱";

        exit();      

      }

      if(isset($this->list)&&is_array($this->list)){

        return $this->list[$i-2];

      }

   }

  

   //后继

   public function nextElem($i){

      if($i<1||$i>$this->size){

        echo "溢出";

        exit();

      }

      if($i==$this->size){

        echo "没有后继";

        exit();      

      }

      if(isset($this->list)&&is_array($this->list)){

        return $this->list[$i];

      }

   }

  

   //插入元素

   public function insertList($i,$e){

      if($i<1||$i>$this->size+1){

        echo "插入元素位置有误";

        exit();

      }

      if(isset($this->list)&&is_array($this->list)){

       

        if($this->size==0){

           $this->list[$this->size]=$e;

           $this->size++;

        }else{

           $this->size++;

           for($j=$this->size-1;$j>=$i;$j--){

              $this->list[$j]=$this->list[$j-1];

           }

           $this->list[$i-1]=$e;

        }      

      }

     

   }

  

  

   //删除元素

   public function deleteLlist($i){

      if($i<1||$i>$this->size){

        echo "删除元素位置有误";

        exit();

      }

      if(isset($this->list)&&is_array($this->list)){

        if($i==$this->size){

           unset($this->list[$this->size-1]);         

        }else{

           for($j=$i;$j<$this->size;$j++){             

              $this->list[$j-1]=$this->list[$j];

           }

           unset($this->list[$this->size-1]);

         }

      $this->size--;

      }

   }

  

   //遍历

   public function printList(){

      if(isset($this->list)&&is_array($this->list)){

        foreach ($this->list as $value){

           echo $value." ";

        }

        echo "<br>";

      }

   }

  

  

 

}

 

?>