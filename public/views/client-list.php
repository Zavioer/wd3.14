<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client list</title>
    <link rel="stylesheet" href="./public/css/main.css" type="text/css">
    <link rel="stylesheet" href="./public/css/home.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="logo" class="column-center-center">
        <img src="./public/img/endeal_logo.svg" alt="endeal logo">
    </div>
    <nav class="row-center-space-around">
        <i class="fa-solid fa-house"></i>
        <i class="fa-solid fa-plus"></i>
        <i class="fa-solid fa-list-ul"></i>
        <i class="fa-solid fa-gear"></i>
    </nav>
    <div id="container">
        <h3>CLIENT LIST</h3>
        <div class="badges-list">
            <?php if (isset($clients)): ?> 
                <?php foreach ($clients as $client): ?>  
                    <div class="badge-base">
                        <img src="" alt="badge img placeholder">
                        <div class="badge-base-content">
                            <h4><?= $client->getFirstName() ?></h4>
                            <p><?= $client->getLastName() ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>