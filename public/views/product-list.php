
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
</head>
<body>
    <div id="container">
        <?php include __DIR__.'/components/messages.php'; ?>

        <?php include __DIR__.'/components/top-bar.php'; ?>
        
        <?php include __DIR__.'/components/nav.php'; ?>

        <div class="content column-center-center">
            <h3>PRODUCT LIST</h3>
            <div class="horizontal-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UPC</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>UOM</th>
                            <th>Quantity</th>
                            <th>Modify</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php if(isset($products)): ?>
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td data-title="Name"><?= $product->getName() ?></td>
                                <td data-title="UPC"><?= $product->getUpc() ?></td>
                                <td data-title="Price"><?= $product->getPrice() ?></td>
                                <td data-title="Type"><?= $product->getType()->getName() ?></td>
                                <td data-title="UOM"><?= $product->getUom() ?></td>
                                <td data-title="Quantity"><?= $product->getWarehouseQuantity() ?></td>
                                <td data-title="Modify"><a href=<?= "/productModify/{$product->getID()}"?>><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td data-title="Delete"><a href=<?= "/productDelete/{$product->getID()}"?>><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <?php include __DIR__.'/components/footer.php'; ?>
    </div>
</body>
</html>