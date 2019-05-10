<?php

namespace FroshShareBasket\Components\Gateway;

use Doctrine\DBAL\Connection;
use FroshShareBasket\Struct\Cart;
use FroshShareBasket\Struct\Item;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class CustomerBasketGateway implements CustomerBasketGatewayInterface
{
    public function __construct(Connection $connection, Hydrator\BasketHydrator $basketHydrator)
    {
        $this->connection = $connection;
        $this->basketHydrator = $basketHydrator;
    }

    public function getList($customerId, ShopContextInterface $context)
    {
        $qb = $this->createQueryBuilder();

        // TODO: Maybe also take the subshop id into account, is this neccesary?

        $qb
            ->andWhere($qb->expr()->eq('basketCustomer.customer_id', ':customerId'))
            ->setParameter(':customerId', $customerId)
        ;
        $stmt = $qb->execute();

        $result = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $key = $row['__basket_basketId'];

            if (!$result[$key] instanceof Cart) {
                $result[$key] = $this->basketHydrator->hydrateBasket($row);
            }

            $result[$key]->addItem($this->basketHydrator->hydrateItem($row));
        }

        return $result;
    }

    protected function createQueryBuilder()
    {
        $qb = $this->connection->createQueryBuilder();

        $qb
            ->addSelect($this->getShareBasketFields())
            ->addSelect($this->getShareBasketItemFields())
            ->from('s_plugin_sharebasket_baskets', 'basket')
            ->innerJoin('basket', 's_plugin_sharebasket_basket_customer', 'basketCustomer', 'basket.id = basketCustomer.basket_id')
            ->leftJoin('basket', 's_plugin_sharebasket_articles', 'basketItem', 'basket.id = basketItem.share_basket_id')
        ;

        return $qb;
    }

    /**
     * @return string[]
     */
    protected function getShareBasketFields()
    {
        return [
            'basket.id AS __basket_id',
            'basket.basket_id AS __basket_basketId',
            'basket.created AS __basket_created',
            'basket.hash AS __basket_hash',
            'basket.save_count AS __basket_saveCount',
            'basket.shop_id AS __basket_shopId',
        ];
    }

    /**
     * @return string[]
     */
    protected function getShareBasketItemFields()
    {
        return [
            'basketItem.id AS __basketItem_id',
            'basketItem.ordernumber AS __basketItem_ordernumber',
            'basketItem.quantity AS __basket_quantity',
            'basketItem.mode AS __basket_mode',
            'basketItem.attributes AS __basket_attributes',
        ];
    }
}
