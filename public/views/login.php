<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="/public/img/endeal_favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <?php include __DIR__.'/components/js-scripts-base.php'; ?>
</head>
<body>
    <?php include __DIR__.'/components/messages.php'; ?>

    <div class="container-login">
        <div class="img-cover">
            <img src="/public/img/salesman.jpg" alt="salesman cover">
        </div>

        <div class="container-right column-center-center">
            <div class="column-center-center">
                <img src="/public/img/endeal_logo.svg" alt="endeal logo">

                <div class="login-form-outer">
                    <form id="login-form" action="/login" method="POST" class="column-center-center">
                        <input type="text" required name="email" placeholder="Email" class="text-input-base">
                        <input type="password" required name="password" placeholder="Password" class="text-input-base">
                        <button type="submit" class="button-base">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>