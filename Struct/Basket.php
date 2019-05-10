<?php

namespace FroshShareBasket\Struct;

use Shopware\Bundle\StoreFrontBundle\Struct\Extendable;

class Basket extends Extendable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $basketId;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     */
    protected $saveCount;

    /**
     * @var Item[]
     */
    protected $items = [];

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
     * @param string $id
     *
     * @return $this
     */
    public function setBasketId($basketId)
    {
        $this->basketId = $basketId;

        return $this;
    }

    /**
     * @return string
     */
    public function getBasketId()
    {
        return $this->basketId;
    }

    /**
     * @param string $hash
     *
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param int $saveCount
     *
     * @return $this
     */
    public function setSaveCount($saveCount)
    {
        $this->saveCount = $saveCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getSaveCount()
    {
        return $this->saveCount;
    }

    /**
     * @param Item[] $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item $item
     *
     * @return $this
     */
    public function addItem($item)
    {
        $this->items[] = $item;

        return $this;
    }
}
