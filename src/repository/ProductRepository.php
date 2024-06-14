<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Product.php';
require_once __DIR__.'/../models/ProductType.php';

class ProductRepository extends Repository
{
    public function addProduct(Product $product, $quantity=0)
    {
        try {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO product (
                    name, upc, description, price, uom, product_type_id
                )
                VALUES (?, ?, ?, ?, ?, ?)
                RETURNING *
            ');
            
            $stmt->execute([
                $product->getName(),
                $product->getUpc(),
                $product->getDescription(),
                $product->getPrice(),
                $product->getUom(),
                $product->getProductTypeId()
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->addProductWarehouseQuantity($result['id'], $quantity);
        } catch(PDOException $e) {
            return $e;
        }
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
                $product['product_type_id'],
                $product['img_path']
            );
            $quantity = $this->getProductWarehouseQuantity($newProduct->getId());
            $newProduct->setWarehouseQuantity($quantity);
            $productType = $this->getProductTypeByProductId($newProduct->getProductTypeId());
            $newProduct->setType($productType);
            array_push($products, $newProduct);
        }

        return $products;
    }

    public function getProductById(int $id)
    {
        try {
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
                $result['product_type_id'],
                $result['img_path']
            );
            $quantity = $this->getProductWarehouseQuantity($product->getId());
            $product->setWarehouseQuantity($quantity);

            $productType = $this->getProductTypeByProductId($product->getProductTypeId());
            $product->setType($productType);

            return $product;
        } catch (PDOException $e) {
            return $e;
        }
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
        try {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM product WHERE id = :id
            ');

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    private function getProductWarehouseQuantity($id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM warehouse w
            WHERE w.product_id = :productId
        ');

        $stmt->bindParam(':productId', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['quantity'] ?? 0;
    }

    private function addProductWarehouseQuantity($productId, $quantity)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO warehouse (product_id, quantity)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $productId,
            $quantity
        ]);
    }

    private function getProductTypeByProductId($id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM product_type pt
            WHERE pt.id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new ProductType(
            $result['id'],
            $result['name'],
        );
    }

    public function getProductTypes() {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM product_type pt
        ');

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $productTypes = [];

        foreach ($result as $productType) {
            $newProductType = new ProductType(
                $productType['id'],
                $productType['name'],
            );
            array_push($productTypes, $newProductType); 
        }

        return $productTypes;
    }
}
