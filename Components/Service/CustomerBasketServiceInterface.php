<?php

namespace FroshShareBasket\Components\Service;

use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

interface CustomerBasketServiceInterface
{
    /**
     * @param int $customerId
     * @param ShopContextInterface $context
     *
     * @return Carts[]
     */
    public function getList($customerId, ShopContextInterface $context);
}
