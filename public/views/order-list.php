
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order list</title>
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
            <h3>ORDER LIST</h3>
            <div class="horizontal-scroll">
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
                                <td data-title="Finish date"><?= $order->getFinishDate() ?? '-' ?></td>
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
        </div>

        <?php include __DIR__.'/components/footer.php'; ?>
    </div>
</body>
</html>