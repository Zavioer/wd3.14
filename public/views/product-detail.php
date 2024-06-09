<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="/public/css/home.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        <?php if(isset($product)): ?>
            <h3><?= $product->getName() ?></h3>
            <div class="badge-large">
                <img src=<?= $product->getImgPath() ?> alt="badge-large-img">
                <div class="badge-large-content">
                    <?= $product->getDescription() ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>