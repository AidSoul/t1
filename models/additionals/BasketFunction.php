<?php

namespace app\models\additionals;

use Yii;
use yii\base\Model;
use app\components\AddNotifi;
use app\models\tables\Basket;

class BasketFunction extends Model 
{

    public $idGoods = 1;
    public $basket = null;
    private $obj = null;

    public function __construct($goods)
    {
        $this->idGoods = $goods;
        $this->basket = new Basket;    
    }

    private function notifi(){

    }

    private  function checkNull($obj)
    {
      return $obj;
    }

    public function add(){
        
      return $this->checkNull($this->basket->addInBasket($this->idGoods));
    }

    public function delete(){
        return $this->checkNull($this->basket->removeGoods($this->idGoods));
    }

    public function removeOne(){
        return $this->checkNull($this->basket->removeOfBasket($this->idGoods));
    }

}