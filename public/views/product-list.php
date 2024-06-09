
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="/public/js/messages.js" defer></script>
</head>
<body>
    <div id="container">
        <div class="messages">
            <?php if(isset($messages)): ?>
                <?php foreach($messages as $message): ?>
                    <div class="message-box">
                        <p><?= $message ?></p>
                        <button class="m-close-btn">&times;</button>
                    </div> 
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="top-bar">
            <div class="logo column-center-center">
                <img src="/public/img/endeal_logo.svg" alt="endeal_logo">
            </div>

            <?php include __DIR__.'/components/avatar.php'; ?>
        </div> 
        
        <?php include __DIR__.'/components/nav.php'; ?>

        <div class="content column-center-center">
            <h3>PRODUCT LIST</h3>
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
        <footer class="column-center-center">
            Copyright &copy; Endeal 2024
        </footer>
    </div>
</body>
</html>