<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./public/css/main.css" type="text/css">
    <link rel="stylesheet" href="./public/css/components.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="messages">
            <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
            ?>
        </div>
        
        <div class="container-left">
        </div>
        <div class="container-right column-center-center">
            <div class="container-login-outer">
                <img src="./public/img/endeal_logo.svg" alt="endeal logo">
                <div id="container-login">
                    <form id="form-login" action="login" method="POST" class="form-base column-center-center">
                        <input type="text" name="email" placeholder="Email" class="text-input-base">
                        <input type="password" name="password" placeholder="Password" class="text-input-base">
                        <a href="">Forgot password?</a>
                        <button type="submit" class="button-base">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>