<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Order.php';

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

    public function getOrders()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM order
        ');
         
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orders = [];

        foreach ($result as $ordre) {
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
}
