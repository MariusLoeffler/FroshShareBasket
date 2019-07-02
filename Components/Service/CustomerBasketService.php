<?php

namespace FroshShareBasket\Components\Service;

use FroshShareBasket\Components\Gateway\CustomerBasketGatewayInterface;
use FroshShareBasket\Components\Gateway\DeleteCustomerBasketGatewayInterface;
use Shopware\Bundle\StoreFrontBundle\Service\ListProductServiceInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class CustomerBasketService implements CustomerBasketServiceInterface
{
    /**
     * @var CustomerBasketGatewayInterface
     */
    private $customerBasketGateway;

    private $listProductService;

    /**
     * @var \Enlight_Components_Session_Namespace
     */
    private $session;

    private $deleteCustomerBasketGateway;

    public function __construct(
        CustomerBasketGatewayInterface $customerBasketGateway,
        ListProductServiceInterface $listProductService,
        \Enlight_Components_Session_Namespace $session,
        DeleteCustomerBasketGatewayInterface $deleteCustomerBasketGateway
    ) {
        $this->customerBasketGateway = $customerBasketGateway;
        $this->listProductService = $listProductService;
        $this->session = $session;
        $this->deleteCustomerBasketGateway = $deleteCustomerBasketGateway;
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

    public function deleteBasket($basketId) {

        $customerId = $this->session->offsetGet('sUserId') ?: $this->session->offsetGet('auto-user');

        $this->deleteCustomerBasketGateway->deleteBasket($basketId, $customerId);
        return 0;
    }
}
