<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Order.php';
require_once __DIR__.'/../models/OrderDetailed.php';

class OrderRepository extends Repository
{
    public function addOrder(Order $order)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO order (
                client_id, salesman_id, creation_date, finish_date, total_price,
                discount, state
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
         
        $stmt->execute([
            $product->getClientId(),
            $product->getSalesmanId(),
            $product->getCreationDate(),
            $product->getFinishDate(),
            $product->getTotalPrice(),
            $product->getDiscount(),
            $product->getState()
        ]);
    }

    public function addOrderV2($clientId, $salesmanId, $productId, $amount, $discount)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT create_order(:clientId, :salesmanId, :productId, :amount, :discount)
        ');
         
        $state = "new";
        // var_dump($clientId, $salesmanId, $productId, $amount);
        $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->bindParam(':salesmanId', $salesmanId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindParam(':discount', $discount, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getOrders()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM order
        ');
         
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orders = [];

        foreach ($result as $order) {
            $newOrder = new Order(
                $order['client_id'],
                $order['salesman_id'],
                $order['creation_date'],
                $order['finish_date'],
                $order['total_price'],
                $order['discount'],
                $order['state']
            );
            array_push($orders, $newOrder);
        }

        return $orders;
    }

    public function getOrdersDetailed()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM vw_order_detailed
        ');
         
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orders = [];

        foreach ($result as $order) {
            $newOrder = new OrderDetailed(
                $order['order_id'],
                $order['client_first_name'],
                $order['client_last_name'],
                $order['salesman_first_name'],
                $order['salesman_last_name'],
                $order['creation_date'],
                $order['finish_date'],
                $order['discount'],
                $order['total_price'],
                $order['state'],
                $order['product_id'],
                $order['product_name'],
                $order['amount'],
            );
            array_push($orders, $newOrder);
        }

        return $orders;
    }

    public function getProductById(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM product
            WHERE id = :id
        ');
         
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $product = new Product(
            $result['id'],
            $result['name'],
            $result['upc'],
            $result['description'],
            $result['price'],
            $result['uom'],
            $result['product_type_id']
        );

        return $product;
    }
    
    public function updateProduct(Product $updatedProduct)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE product SET
            name = ?,
            upc = ?,
            description = ?,
            price = ?,
            uom = ?,
            product_type_id = ?
            WHERE id = ?
        ');
        $stmt->execute([
            $updatedProduct->getName(),
            $updatedProduct->getUpc(),
            $updatedProduct->getDescription(),
            $updatedProduct->getPrice(),
            $updatedProduct->getUom(),
            $updatedProduct->getProductTypeId(),
            $updatedProduct->getId()
        ]);
    }

    public function deleteProduct(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM product WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function resolveOrder(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE orders SET state = \'FINISHED\'
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
