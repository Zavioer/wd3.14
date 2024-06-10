<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link rel="stylesheet" href="/public/css/mobile.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php';?>
</head>
<body>
    <?php include __DIR__.'/components/mobile/logo.php';?>

    <?php include __DIR__.'/components/mobile/nav.php';?>

    <?php include __DIR__.'/components/messages.php';?>
    
    <div id="container">
        <div>
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
    </div>
</body>
</html>