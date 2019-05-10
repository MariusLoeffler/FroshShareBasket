<?php

namespace FroshShareBasket\Components\Gateway;

use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

interface CustomerBasketGatewayInterface
{
    /**
     * @param int $customerId
     * @param ShopContextInterface $context
     *
     * @return Carts[]
     */
    public function getList($customerId, ShopContextInterface $context);
}
