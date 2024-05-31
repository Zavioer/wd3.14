
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client add</title>
    <link rel="stylesheet" href="./public/css/home-desktop.css" type="text/css">
    <link rel="stylesheet" href="./public/css/salesman-desktop.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="container">
        <div class="messages">
            <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
            ?>
        </div>

        <div class="top-bar">
            <div class="logo column-center-center">
                <img src="./public/img/endeal_logo.svg" alt="endeal_logo">
            </div>
            <i class="fa-solid fa-circle-user"></i>
        </div> 

        <nav>
            <div class="menu-list">
                <div class="menu-section-header">
                    salesman
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-person-circle-plus"></i>
                    Add
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-person-circle-question"></i>
                    detail
                </div>
                <div class="menu-section-header">
                    product
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-plus"></i>
                    add
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-list"></i>
                    list
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    reports
                </div>
                <div class="menu-section-header">
                    clients
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-plus"></i>
                    add
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-list"></i>
                    list
                </div>
                <div class="menu-entry">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    reports
                </div>
            </div>
        </nav>

        <div class="content column-center-center">
            <h3>NEW CLIENT</h3>
            <form action="addClient" method="POST" class="form-base-desktop">
                <div class="form-input-wrapper">
                    <input type="text" name="first-name" placeholder="First name" class="text-input-base">
                    <input type="text" name="last-name" placeholder="Last name" class="text-input-base">
                    <input type="text" name="city" placeholder="City" class="text-input-base">
                    <input type="text" name="street" placeholder="Street" class="text-input-base">
                    <input type="text" name="house-number" placeholder="House number" class="text-input-base">
                    <input type="text" name="postal-code" placeholder="Postal code" class="text-input-base">
                    <input type="text" name="company-name" placeholder="Company name" class="text-input-base">
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