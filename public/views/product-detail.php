<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile home</title>
    <link rel="stylesheet" href="./public/css/main.css" type="text/css">
    <link rel="stylesheet" href="./public/css/home.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="logo">
        <img src="./public/img/endeal_logo.svg" alt="endeal logo">
    </div>
    <nav class="row-center-space-around">
        <i class="fa-solid fa-house"></i>
        <i class="fa-solid fa-plus"></i>
        <i class="fa-solid fa-list-ul"></i>
        <i class="fa-solid fa-gear"></i>
    </nav>
    <div id="container">
        <?php if(isset($product)): ?>
            <h3><?= $product->getName()?></h3>
            <div class="badge-large">
                <img src="" alt="badge-large-img">
                <div class="badge-large-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat elit mauris, ut efficitur velit accumsan ut. Praesent eget viverra neque. Aenean iaculis condimentum venenatis. Integer vel vehicula nibh. Integer elementum lectus sagittis velit gravida, eget pharetra libero fermentum. Sed consequat mauris non turpis iaculis, ut porttitor ipsum ultrices. In vitae ex in ante aliquet semper. 
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>