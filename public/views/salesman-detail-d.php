
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salesman detail</title>
    <link rel="stylesheet" href="public/css/home-desktop.css" type="text/css">
    <link rel="stylesheet" href="public/css/salesman-desktop.css" type="text/css">
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
            <h3>SALESMAN DETAIL</h3>
            <?php
                if(isset($user)){
                    echo $user;
                }
            ?>
            </table>
        </div>
        <footer class="column-center-center">
            Copyright &copy; Endeal 2024
        </footer>
    </div>
</body>
</html>