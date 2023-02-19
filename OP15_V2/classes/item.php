<?php
class Item
{
    public $name, $price, $amount;

    function __construct($name, $price, $amount)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> amount = $amount;
    }
}