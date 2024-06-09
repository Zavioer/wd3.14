
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
</head>
<body>
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

        <div class="top-bar">
            <div class="logo column-center-center">
                <img src="/public/img/endeal_logo.svg" alt="endeal_logo">
            </div>

            <div class="hamburger-menu">
                <button class="hamburger-menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            
            <?php include __DIR__.'/components/avatar.php'; ?>
        </div> 
        
        <?php include __DIR__.'/components/nav.php'; ?>

        <div class="content column-center-center">
            <h3>NEW PRODUCT</h3>
            <form action="/productAdd" method="POST" class="form-base-desktop">
                <div class="form-input-wrapper">
                    <input type="text" name="name" placeholder="Name" class="text-input-base">
                    <input type="text" name="upc" placeholder="UPC" class="text-input-base">
                    <textarea class="textarea-base" name="description" placeholder="Description" id="description">
                    </textarea>
                    <input type="text" name="price" placeholder="Price" class="text-input-base">
                    
                    <select name="type" id="type-select" class="select-input-base">
                        <option value="">Choose product type</option>
                        <hr>
                        <?php if(isset($productTypes)): ?>
                            <?php foreach($productTypes as $productType): ?>
                                <option value=<?= $productType->getId(); ?>><?= $productType->getName(); ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <input type="text" name="uom" placeholder="uom" class="text-input-base">
                    <input type="text" name="quantity" placeholder="quantity" class="text-input-base">
                </div>

                <div class="form-button-section">
                    <button type="submit" class="button-base">ADD</button>
                    <button type="reset" class="button-base">CLEAR</button>
                </div>
            </form>
        </div>
        <footer class="column-center-center">
            Copyright &copy; Endeal 2024
        </footer>
    </div>
</body>
</html>