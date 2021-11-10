<?php
class product {
  public $titel;
  public $desc;
  public $price;
  

  function __construct($titel, $desc, $price ) {
    $this->titel = $titel;
    $this->desc = $desc;
    $this->price = $price; 
  }
  function get_titel() {
    return $this->titel;
  }
  function set_titel($titel){
  	$this->titel = $titel;
  }
    function get_desc() {
    return $this->desc;
  }
  function set_desc($desc){
  	$this->desc = $desc;
  }
    function get_price() {
    return $this->price;
  }
  function set_price($price){
  	$this->price = $price;
  }
}

?>