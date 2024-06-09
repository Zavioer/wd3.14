
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order list</title>
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
            <h3>ORDER LIST</h3>
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Salesman</th>
                        <th>Creation date</th>
                        <th>Finish date</th>
                        <th>Total price</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>State</th>
                        <th>Resolve</th>
                    </tr>
                </thead>
                <?php if(isset($orders)): ?>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td data-title="Client"><?= "{$order->getClientFirstName()} {$order->getClientLastName()}" ?></td>
                            <td data-title="Salesman"><?= "{$order->getSalesmanFirstName()} {$order->getSalesmanLastName()}" ?></td>
                            <td data-title="Creation date"><?= $order->getCreationDate() ?></td>
                            <td data-title="Finish date"><?= $order->getFinishDate() ?></td>
                            <td data-title="Total price"><?= $order->getTotalPrice() ?></td>
                            <td data-title="Product"><?= $order->getProductName() ?></td>
                            <td data-title="Quantity"><?= $order->getAmount() ?></td>
                            <td data-title="Discount"><?= $order->getDiscount() ?></td>
                            <td data-title="State"><?= $order->getState() ?></td>
                            <td data-title="Resolve"><a href=<?= "/orderResolve/{$order->getOrderId()}"?>><i class="fa-solid fa-check"></i></a></td>
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