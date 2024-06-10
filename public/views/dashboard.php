
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" defer></script>
    <script src="/public/js/charts/income.js" defer></script>
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
                        <div class="badge-base">
                            <img src="" alt="badge-base-img">
                            <div class="badge-base-content">
                                <p>Product Name</p>
                                <p>Price: 100$</p>
                                <p>Amount: 10</p>
                            </div>
                        </div>
                        <div class="badge-base">
                            <img src="" alt="badge-base-img">
                            <div class="badge-base-content">
                                <p>Product Name</p>
                                <p>Price: 100$</p>
                                <p>Amount: 10</p>
                            </div>
                        </div>
                        <div class="badge-base">
                            <img src="" alt="badge-base-img">
                            <div class="badge-base-content">
                                <p>Product Name</p>
                                <p>Price: 100$</p>
                                <p>Amount: 10</p>
                            </div>
                        </div>
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