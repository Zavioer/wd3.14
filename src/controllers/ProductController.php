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
        $productTypes = $this->productRepository->getProductTypes();
        $user = $req['user'];

        if (!$this->isPost()) {
            return $this->render('product-add', ['productTypes' => $productTypes, 'user' => $user]);
        }

        $name = $_POST['name'];
        $upc = $_POST['upc'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $uom = $_POST['uom'];
        $description = $_POST['description'] ?? '';
        $quantity = $_POST['quantity'];


        $nameValidator = new ValidatorExecutor([
            new TextLengthValidator(3, 255)
        ]);
        $nameErrors = $nameValidator->run($name, 'Name');
        $upcErrors = $nameValidator->run($upc, 'UPC');

        $uomValidator = new ValidatorExecutor([
            new TextLengthValidator(1, 10)
        ]);
        $uomErrors = $uomValidator->run($uom, 'UOM');

        $quantityValidator = new ValidatorExecutor([
            new NumberInRangeValidator(0),
        ]);
        $quantityErrors = $quantityValidator->run($quantity, 'Quantity');

        $priceValidator = new ValidatorExecutor([
            new NumberInRangeValidator(0),
        ]);
        $priceErrors = $priceValidator->run($price, 'Price');
        
        $errors = array_merge(
            $nameErrors,
            $upcErrors,
            $uomErrors,
            $quantityErrors,
            $priceErrors,
        );

        if (!empty($errors)) {
            $messages = [];
            foreach($errors as $errorText) {
                array_push($messages, new Message($errorText, Message::ERROR));
            }
            return $this->render('product-add', [
                'messages' => $messages,
                'productTypes' => $productTypes,
                'user' => $user
            ]);
        }


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
        $result = $this->productRepository->addProduct($product, $quantity);
        
        if ($result === null) {
            $messages = [new Message('Product succesfully added!', Message::SUCCESS)];
        } else {
            if ($result->getCode() == 23505) {
                $messages = [new Message('Product Name or UPC not unique, cannot add!', Message::ERROR)];
            } else {
                $messages = [new Message("Server Error when adding Product $e->getMessage()!", Message::ERROR)];
            }
        }

        return $this->render('product-add', [
            'messages' => $messages,
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
        $result = $this->productRepository->deleteProduct($id);

        if ($result === null) {

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/productsDesktop");
        } else {
            echo $result; 
        }
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