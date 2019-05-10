<?php

namespace FroshShareBasket\Components\Service;

use FroshShareBasket\Components\Gateway\CustomerBasketGatewayInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class CustomerBasketService implements CustomerBasketServiceInterface
{
    /**
     * @var CustomerBasketGatewayInterface
     */
    private $customerBasketGateway;

    public function __construct(CustomerBasketGatewayInterface $customerBasketGateway)
    {
        $this->customerBasketGateway = $customerBasketGateway;
    }

    public function getList($customerId, ShopContextInterface $context)
    {
        // TODO: Maybe also set the products if needed
        return $this->customerBasketGateway->getList($customerId, $context);
    }
}
