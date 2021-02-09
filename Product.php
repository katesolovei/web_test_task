<?php


class Product
{
    public $code;
    public $price;
    public $offer;

    public function __construct($code, $price, $offer)
    {
        $this->code = $code;
        $this->price = $price;
        $this->offer = $offer;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getOffer()
    {
        return $this->offer;
    }
}