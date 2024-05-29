<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Product.php';

class ProductRepository extends Repository
{
    public function addProduct(Product $product)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO product (
                name, upc, description, price, uom, product_type_id
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ');
         
        $stmt->execute([
            $product->getName(),
            $product->getUpc(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getUom(),
            $product->getProductTypeId()
        ]);
    }

    public function getProducts()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM product
        ');
         
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];

        foreach ($result as $product) {
            $newProduct = new Product(
                $product['id'],
                $product['name'],
                $product['upc'],
                $product['description'],
                $product['price'],
                $product['uom'],
                $product['product_type_id']
            );
            array_push($products, $newProduct);
        }

        return $products;
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
