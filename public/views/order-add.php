<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add order</title>
    <link rel="icon" href="/public/img/endeal_favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/public/css/mobile.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
    <script type="text/javascript" src="/public/js/order.js" defer></script>
</head>
<body>
    <?php include __DIR__.'/components/mobile/logo.php'; ?>

    <?php include __DIR__.'/components/mobile/nav.php'; ?>

    <?php include __DIR__.'/components/messages.php'; ?>

    <div id="container">
        <div>
            <h3>NEW ORDER</h3>
            <form id="add-order-from" action="/orderAdd" method="POST" class="form-base-desktop">
                <div class="form-input-wrapper">
                    <select name="client" id="client-select" class="select-base select-input-base">
                        <option value="">Load client data</option>
                        <hr>
                        <?php if(isset($clients)): ?>
                            <?php foreach($clients as $client): ?>
                                <option value="<?= $client->getId(); ?>"><?= $client->getFirstName().' '.$client->getLastName(); ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                            
                    <input type="text" required name="first-name" placeholder="First name" class="text-input-base">
                    <input type="text" required name="last-name" placeholder="Last name" class="text-input-base">
                    <input type="text" required name="city" placeholder="City" class="text-input-base">
                    <input type="text" required name="street" placeholder="Street" class="text-input-base">
                    <input type="text" required name="house-number" placeholder="House number" class="text-input-base">
                    <input type="text" required name="postal-code" placeholder="Postal code" class="text-input-base">
                    <input type="text" required name="phone" placeholder="Phone" class="text-input-base">
                    <input type="text" required name="email" placeholder="Email" class="text-input-base">

                    <select name="product" required id="product-select" class="select-base select-input-base">
                        <option value="">Choose product</option>
                        <hr>
                        <?php if(isset($products)): ?>
                            <?php foreach($products as $product): ?>
                                <option value=<?= $product->getId(); ?>><?= $product->getName(); ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                            
                    <input type="number" required min="0" name="amount" value="1" placeholder="Amount" class="text-input-base">
                    <input type="number" step="0.01" required min="0" max="1" value="0" name="discount" placeholder="Discount" class="text-input-base">
                    <button type="submit" class="button-base">ADD</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>