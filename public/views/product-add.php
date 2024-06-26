
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="icon" href="/public/img/endeal_favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
</head>
<body>
    <div id="container">
        <?php include __DIR__.'/components/messages.php'; ?>

        <?php include __DIR__.'/components/top-bar.php'; ?>
        
        <?php include __DIR__.'/components/nav.php'; ?>

        <div class="content column-center-center">
            <h3>NEW PRODUCT</h3>
            <form action="/productAdd" method="POST" class="form-base-desktop">
                <div class="form-input-wrapper">
                    <input type="text" required name="name" placeholder="Name" class="text-input-base">
                    <input type="text" required name="upc" placeholder="UPC" class="text-input-base">
                    <textarea class="textarea-base" name="description" placeholder="Description" id="description"></textarea>
                    <input type="number" step="0.01" min="0" required name="price" placeholder="Price" class="text-input-base">
                    
                    <select name="type" required id="type-select" class="select-input-base">
                        <option value="">Choose product type</option>
                        <hr>
                        <?php if(isset($productTypes)): ?>
                            <?php foreach($productTypes as $productType): ?>
                                <option value=<?= $productType->getId(); ?>><?= $productType->getName(); ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <input type="text" required name="uom" placeholder="UOM" class="text-input-base">
                    <input type="number" step="1" min="1" value=1 required name="quantity" placeholder="Quantity" class="text-input-base">
                </div>

                <div class="form-button-section">
                    <button type="submit" class="button-base">ADD</button>
                    <button type="reset" class="button-base">CLEAR</button>
                </div>
            </form>
        </div>

        <?php include __DIR__.'/components/footer.php'; ?>
    </div>
</body>
</html>