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
        
    public function productAdd($req) {
        if (!$this->isPost()) {
            $productTypes = $this->productRepository->getProductTypes();
            return $this->render('product-add', ['productTypes' => $productTypes, 'user' => $req['user']]);
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
            $type,
            'https://placehold.co/600x400'
        );

        $this->productRepository->addProduct($product, $quantity);
        $productTypes = $this->productRepository->getProductTypes();
        return $this->render('product-add', [
            'messages' => ['Product succesfully added'],
            'productTypes' => $productTypes,
        ]);
    }

    public function products($req) {
        // TODO: check user agent and render appropriate page
        $products = $this->productRepository->getProducts();
        $user = $req['user'];
        return $this->render('product-list', ['products' => $products, 'user' => $user]);
    }

    public function productsMobile($req) {
        // TODO: check user agent and render appropriate page
        $products = $this->productRepository->getProducts();
        $user = $req['user'];
        return $this->render('product-list-m', ['products' => $products, 'user' => $user]);
    }

    public function productDetail($req) {
        $id = $req['input'];
        $product = $this->productRepository->getProductById($id);
        return $this->render('product-detail', ['product' => $product]);
    }

    public function productDelete($req) {
        $id = $req['input'];
        $this->productRepository->deleteProduct($id);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/productsDesktop");
    }

    public function productModify($req) {
        if (!$this->isPost()) {
            $id = $req['input'];
            $user = $req['user'];
            $productTypes = $this->productRepository->getProductTypes();
            $product = $this->productRepository->getProductById($id);
            return $this->render('product-modify', [
                'product' => $product,
                'productTypes' => $productTypes,
                'user' => $user,
            ]);
        }

        $updatedProduct = new Product(
            $_POST['id'],
            $_POST['name'],
            $_POST['upc'],
            $_POST['description'],
            $_POST['price'],
            $_POST['uom'],
            $_POST['type'],
            'https://placehold.co/600x400'
        );

        $this->productRepository->updateProduct($updatedProduct);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/products");
    }
}