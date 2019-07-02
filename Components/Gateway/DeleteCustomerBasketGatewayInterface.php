<?php

namespace FroshShareBasket\Components\Gateway;

interface DeleteCustomerBasketGatewayInterface
{
    /**
     * @param int $customerId
     * @param ShopContextInterface $context
     *
     * @return Carts[]
     */
    public function deleteBasket($basketId, $customerId);
}
