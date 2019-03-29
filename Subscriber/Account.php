<?php

namespace FroshShareBasket\Subscriber;

use Enlight\Event\SubscriberInterface;
use Enlight_Components_Session_Namespace as Session;
use Shopware\Bundle\StoreFrontBundle\Service\ContextServiceInterface;

class Account implements SubscriberInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var ContextServiceInterface
     */
    private $contextService;

    public function __construct(
        Session $session,
        ContextServiceInterface $contextService
    ) {
        $this->session = $session;
        $this->contextService = $contextService;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_Frontend_Account_Carts' => 'onActionFrontendAccountCarts',
        ];
    }

    public function onActionFrontendAccountCarts(\Enlight_Event_EventArgs $args)
    {
        /**@var $controller Shopware_Controllers_Frontend_Account */
        $controller = $args->getSubject();
        $view = $controller->View();
        $request = $controller->Request();

    /*    $view->froshSavedCarts = $this->customerBasketService->getList(
            $this->session->offsetGet('sUserId'),
            $this->contextService->getShopContext()
        ); */

        return true;
    }
}
