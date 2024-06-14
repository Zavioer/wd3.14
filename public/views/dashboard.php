
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/public/js/charts/monthlyIncome.js" defer></script>
    <script src="/public/js/charts/categoryShare.js" defer></script>
</head>
<body>
    <div id="container">
        <?php include __DIR__.'/components/messages.php'; ?>

        <?php include __DIR__.'/components/top-bar.php'; ?>
        
        <?php include __DIR__.'/components/nav.php'; ?>

        <div class="content column-space-around">
            <div class="content-top">
                <div>
                    <h3>INCOME CHART</h3>
                    <div class="graph">
                        <canvas id="income-chart"></canvas>
                    </div>
                </div>
            </div>

            <div class="content-bottom">
                <div>
                    <h3>TOP SELLING</h3>
                    <div class="badges-list">
                        <?php if(isset($products)): ?>
                            <?php foreach($products as $product): ?>
                                <div class="badge-base">
                                    <img src=<?= $product->getImgPath(); ?> alt=<?= "{$product->getName()} image"?>>
                                    <div class="badge-base-content">
                                        <h4><?= $product->getName(); ?></h4>
                                        <p>Price: <?= $product->getPrice(); ?>$</p>
                                        <p>Amount: <?= $product->getWarehouseQuantity(); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div>
                    <h3>CATEGORY SHARE</h3>
                    <div class="graph">
                        <canvas id="category-share"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <?php include __DIR__.'/components/footer.php'; ?>
    </div>
</body>
</html>