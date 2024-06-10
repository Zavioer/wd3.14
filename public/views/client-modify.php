
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client modify</title>
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
            <h3>MODIFY CLIENT</h3>
            <form action="/clientModify" method="POST" class="form-base-desktop">
                <?php if(isset($client)): ?> 
                <div class="form-input-wrapper">
                    <input type="text" name="first-name" placeholder="First name" class="text-input-base" value=<?= $client->getFirstName() ?>>
                    <input type="text" name="last-name" placeholder="Last name" class="text-input-base" value=<?= $client->getLastName() ?>>
                    <input type="text" name="city" placeholder="City" class="text-input-base" value=<?= $client->getCity() ?>>
                    <input type="text" name="street" placeholder="Street" class="text-input-base" value=<?= $client->getStreet() ?>>
                    <input type="text" name="house-number" placeholder="House number" class="text-input-base" value=<?= $client->getHouseNumber() ?>>
                    <input type="text" name="postal-code" placeholder="Postal code" class="text-input-base" value=<?= $client->getPostalCode() ?>>
                    <input type="hidden" name="id" value=<?= $client->getId() ?>>
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