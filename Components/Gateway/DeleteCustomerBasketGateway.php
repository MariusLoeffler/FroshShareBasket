<?php


namespace FroshShareBasket\Components\Gateway;

use Doctrine\DBAL\Connection;

class DeleteCustomerBasketGateway implements DeleteCustomerBasketGatewayInterface
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * DeleteCustomerBasketGateway constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function deleteBasket($basketId, $customerId)
    {
        $qb = $this->createQueryBuilder();

        $qb
            ->setParameter(':basketId', $basketId)
            ->setParameter(':customerId', $customerId)
        ;

        $qb->execute();
    }

    protected function createQueryBuilder()
    {
        $qb = $this->connection->createQueryBuilder();
        $subQb = $this->connection->createQueryBuilder();

        $subQb
            ->select('basketCustomer.basket_id')
            ->from('s_plugin_sharebasket_basket_customer', 'basketCustomer')
            ->innerJoin('basketCustomer', 's_plugin_sharebasket_baskets', 'baskets', 'baskets.id = basketCustomer.basket_id')
            ->andWhere($qb->expr()->eq('baskets.basket_id', ':basketId'))
            ->andWhere($qb->expr()->eq('basketCustomer.customer_id', ':customerId'));

        $qb
            ->delete('s_plugin_sharebasket_basket_customer')
            ->where(
                $qb->expr()->eq(
                    's_plugin_sharebasket_basket_customer.basket_id',
                    '('.$subQb->getSQL().')'
                )
            )
        ;

        return $qb;
    }
}
