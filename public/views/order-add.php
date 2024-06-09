<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add order</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="/public/css/home.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="/public/js/order.js" defer></script>
    <script type="text/javascript" src="/public/js/messages.js" defer></script>
</head>
<body>
    <div id="logo" class="column-center-center">
        <img src="/public/img/endeal_logo.svg" alt="endeal logo">
    </div>
    <nav class="row-center-space-around">
        <a href="/home"><i class="fa-solid fa-house"></i></a>
        <a href="/orderAdd"><i class="fa-solid fa-plus"></i></a>
        <a href="/products"><i class="fa-solid fa-list-ul"></i></a>
        <a href="#"><i class="fa-solid fa-gear"></i></a>
    </nav>
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

        <h3>NEW ORDER</h3>
        <form id="form-add-order" action="/orderAdd" method="POST" class="form-base column-center-stretch">
            <select name="client" id="client-select" class="select-base select-input-base">
                <option value="">Load client data</option>
                <hr>
                <?php if(isset($clients)): ?>
                    <?php foreach($clients as $client): ?>
                        <option value=<?= $client->getId(); ?>><?= $client->getFirstName().' '.$client->getLastName(); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            
            <input type="text" name="first-name" placeholder="First name" class="text-input-base">
            <input type="text" name="last-name" placeholder="Last name" class="text-input-base">
            <input type="text" name="city" placeholder="City" class="text-input-base">
            <input type="text" name="street" placeholder="Street" class="text-input-base">
            <input type="text" name="house-number" placeholder="House number" class="text-input-base">
            <input type="text" name="postal-code" placeholder="Postal code" class="text-input-base">
            <select name="product" id="product-select" class="select-base select-input-base">
                <option value="">Choose product</option>
                <hr>
                <?php if(isset($products)): ?>
                    <?php foreach($products as $product): ?>
                        <option value=<?= $product->getId(); ?>><?= $product->getName(); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <input type="text" name="amount" placeholder="Amount" class="text-input-base">
            <input type="text" name="discount" placeholder="Discount" class="text-input-base">
            <button type="submit" class="button-base">ADD</button>
        </form>
    </div>
</body>
</html>