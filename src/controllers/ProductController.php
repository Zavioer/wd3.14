<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ProductRepository.php';
require_once __DIR__.'../../forms/ProductForm.php';

class ProductController extends AppController {
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }
        
    public function productAdd($req) {
        $productTypes = $this->productRepository->getProductTypes();
        $user = $req['user'];

        if (!$this->isPost()) {
            return $this->render('product-add', ['productTypes' => $productTypes, 'user' => $user]);
        }

        $productForm = new ProductForm($_POST);
        if (!$productForm->validate()) {
            $messages = $this->createMessagesArray($productForm->getErrors(), Message::ERROR);
            return $this->render('product-add', [
                'messages' => $messages,
                'productTypes' => $productTypes,
                'user' => $user
            ]);
        }

        $product = $productForm->getValidatedModel();
        $quantity = $_POST['quantity'];
        $result = $this->productRepository->addProduct($product, $quantity);
        
        if ($result !== null) {
            if ($result->getCode() == 23505) {
                $messages = [new Message('Product Name or UPC not unique, cannot add!', Message::ERROR)];
            } else {
                $messages = [new Message("Server Error when adding Product $e->getMessage()!", Message::ERROR)];
            }
            return $this->render('product-add', [
                'messages' => $messages,
                'productTypes' => $productTypes,
                'user' => $user
            ]);
        }
        $this->redirect('products');
    }

    public function products($req) {
        $products = $this->productRepository->getProducts();
        $user = $req['user'];
        return $this->render('product-list', ['products' => $products, 'user' => $user]);
    }

    public function productsMobile($req) {
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
        $result = $this->productRepository->deleteProduct($id);

        if ($result !== null) {
            $this->redirect('internalServerError');
        }

        $this->redirect('products');
    }

    public function productModify($req) {
        if (!$this->isPost()) {
            $id = $req['input'];
            $user = $req['user'];
            $_SESSION['lastProductId'] = $id;
            $productTypes = $this->productRepository->getProductTypes();
            $product = $this->productRepository->getProductById($id);
            return $this->render('product-modify', [
                'product' => $product,
                'productTypes' => $productTypes,
                'user' => $user,
            ]);
        }

        $_POST['quantity'] = 0;
        $productForm = new ProductForm($_POST);
        if (!$productForm->validate()) {
            $messages = $this->createMessagesArray($productForm->getErrors(), Message::ERROR);
            $product = $this->productRepository->getProductById($_SESSION['lastProductId']);
            $productTypes = $this->productRepository->getProductTypes();
            return $this->render('product-modify', [
                'product' => $product,
                'messages' => $messages,
                'productTypes' => $productTypes,
                'user' => $user
            ]);
        }

        $updatedProduct = $productForm->getValidatedModel();
        $this->productRepository->updateProduct($updatedProduct);
        $this->redirect('products');
    }
}