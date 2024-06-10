
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product modify</title>
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
            <h3>MODIFY PRODUCT</h3>
            <form action="/productModify" method="POST" class="form-base-desktop">
                <?php if(isset($product)): ?> 
                <div class="form-input-wrapper">
                    <input type="text" name="name" placeholder="Name" class="text-input-base" value=<?= $product->getName(); ?>>
                    <input type="text" name="upc" placeholder="UPC" class="text-input-base" value=<?= $product->getUpc(); ?>>
                    <textarea class="textarea-base" name="description" placeholder="Description" id="description"><?= $product->getDescription(); ?></textarea>
                    <input type="text" name="price" placeholder="Price" class="text-input-base" value=<?= $product->getPrice(); ?>>
                    
                    <select name="type" id="type-select" class="select-input-base">
                        <option value="">Choose product type</option>
                        <hr>
                        <?php if(isset($productTypes)): ?>
                            <?php foreach($productTypes as $productType): ?>
                                <?php if($productType->getId() === $product->getProductTYpeId()): ?>
                                    <option selected value=<?= $productType->getId(); ?>><?= $productType->getName(); ?></option>
                                <?php else: ?>
                                    <option value=<?= $productType->getId(); ?>><?= $productType->getName(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <input type="text" name="uom" placeholder="uom" class="text-input-base" value=<?= $product->getUom(); ?>>
                    <!-- <input type="text" name="quantity" placeholder="quantity" class="text-input-base" value=<?= $product->getWarehouseQuantity(); ?>> -->

                    <input type="hidden" name="id" value=<?= $product->getId(); ?>>
                </div>
                <?php endif; ?>

                <div class="form-button-section">
                    <button type="submit" class="button-base">SAVE</button>
                    <button type="reset" class="button-base">RESET</button>
                </div>
            </form>
        </div>

        <?php include __DIR__.'/components/footer.php'; ?>
    </div>
</body>
</html>