<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile home</title>
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
        <h3>PRODUCT LIST</h3>
        <div class="badges-list">
            <?php if (isset($products)): ?> 
                <?php foreach ($products as $product): ?>  
                    <a href=<?= '/productDetail/'.$product->getId() ?> class="badge-link">
                    <div class="badge-base">
                        <img src=<?= $product->getImgPath() ?> alt="badge img placeholder">
                        <div class="badge-base-content">
                            <h4><?= $product->getName() ?></h4>
                            <p>Price: <?= $product->getPrice() ?>$</p>
                            <p>Amount: <?= $product->getWarehouseQuantity() ?></p>
                        </div>
                    </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>