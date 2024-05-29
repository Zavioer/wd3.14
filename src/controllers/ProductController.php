<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ProductRepository.php';

class ProductController extends AppController {
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }
        
    public function addProduct() {
        if (!$this->isPost()) {
            return $this->render('product-add-d');
        }

        $name = $_POST['name'];
        $upc = $_POST['upc'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $uom = $_POST['uom'];
        $description = $_POST['description'] ?? '';
        $quantity = $_POST['quantity']; // TODO add relation with warehouse table

        $product = new Product(
            0, // TODO temporary ID not used in insert
            $name,
            $upc,
            $description,
            $price,
            $uom,
            $type
        );

        $this->productRepository->addProduct($product);

        return $this->render('product-add-d', ['messages' => ['Product succesfully added']]);
    }

    public function products() {
        $products = $this->productRepository->getProducts();
        return $this->render('product-list', ['products' => $products]);
    }

    public function productDetail(int $id) {
        $product = $this->productRepository->getProductById($id);
        return $this->render('product-detail', ['product' => $product]);
    }
}