
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add salesman</title>
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
            <h3>NEW SALESMAN</h3>
            <form action="register" method="POST" class="form-base-desktop">
                <div class="form-input-wrapper">
                    <input type="text" required name="first-name" placeholder="First name" class="text-input-base">
                    <input type="text" required name="last-name" placeholder="Last name" class="text-input-base">
                    <input type="text" required name="email" placeholder="Email" class="text-input-base">
                    <input type="text" required name="licence-code" placeholder="Licence code" class="text-input-base">
                    <input type="text" required name="city" placeholder="City" class="text-input-base">
                    <input type="text" required name="street" placeholder="Street" class="text-input-base">
                    <input type="text" required name="house-number" placeholder="House number" class="text-input-base">
                    <input type="text" required name="postal-code" placeholder="Postal code" class="text-input-base">
                    <select name="role" required id="role" class="select-input-base">
                        <?php if(isset($roles)): ?>
                            <?php foreach ($roles as $role): ?>
                                <?php if($role->getName() == 'salesman'): ?>
                                    <option value=<?= $role->getId() ?> selected><?= $role->getName() ?></option>
                                <?php else: ?>
                                    <option value=<?= $role->getId() ?>><?= $role->getName() ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
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