<?php

namespace FroshShareBasket\Components\Service;

use FroshShareBasket\Components\Gateway\CustomerBasketGatewayInterface;
use Shopware\Bundle\StoreFrontBundle\Service\ListProductServiceInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class CustomerBasketService implements CustomerBasketServiceInterface
{
    /**
     * @var CustomerBasketGatewayInterface
     */
    private $customerBasketGateway;

    private $listProductService;

    public function __construct(
        CustomerBasketGatewayInterface $customerBasketGateway,
        ListProductServiceInterface $listProductService
    ) {
        $this->customerBasketGateway = $customerBasketGateway;
        $this->listProductService = $listProductService;
    }

    public function getList($customerId, ShopContextInterface $context)
    {
        $customerBasketList = $this->customerBasketGateway->getList($customerId, $context);

        $ordernumbers = [];

        foreach($customerBasketList as $basket) {
            foreach($basket->getItems() as $item){
                $ordernumbers[] = $item->getOrdernumber();
            }
        }

        $products = $this->listProductService->getList($ordernumbers, $context);

        foreach($customerBasketList as $basket) {
            array_map(
                function ($item) use($products) {
                    $item->setProduct($products[$item->getOrdernumber()]);
                    },
                $basket->getItems()
            );
        }

        return $customerBasketList;
    }
}
