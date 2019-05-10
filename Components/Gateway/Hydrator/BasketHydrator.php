<?php

namespace FroshShareBasket\Components\Gateway\Hydrator;

use FroshShareBasket\Struct\Basket;
use FroshShareBasket\Struct\Item;

class BasketHydrator
{
    public function hydrateBasket($data)
    {
        $basket = new Basket();

        $basket
            ->setId((int) $data['__basket_id'])
            ->setBasketId($data['__basket_basketId'])
            ->setHash($data['__basket_hash'])
            ->setSaveCount((int) $data['__basket_saveCount'])
        ;

        return $basket;
    }

    public function hydrateItem($data)
    {
        $item = new Item();

        $item
            ->setId($data['__basketItem_id'])
            ->setOrdernumber($data['__basketItem_ordernumber'])
            ->setQuantity($data['__basket_quantity'])
            ->setMode($data['__basket_mode'])
        ;

        return $item;
    }
}
