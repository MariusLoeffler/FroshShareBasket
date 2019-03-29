<?php

namespace FroshShareBasket\Struct;

use Shopware\Bundle\StoreFrontBundle\Struct\Extendable;
use Shopware\Bundle\StoreFrontBundle\Struct\ListProduct;

class Item extends Extendable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $ordernumber;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $mode;

    /**
     * @var ListProduct
     */
    protected $product;

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $ordernumber
     *
     * @return $this
     */
    public function setOrdernumber($ordernumber)
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $mode
     *
     * @return $this
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param ListProduct $product
     *
     * @return $this
     */
    public function setProduct(ListProduct $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return ListProduct
     */
    public function getProduct()
    {
        return $this->product;
    }
}
