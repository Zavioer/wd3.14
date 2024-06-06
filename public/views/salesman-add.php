
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add salesman</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <!-- <link rel="stylesheet" href="/public/css/salesman-desktop.css" type="text/css"> -->
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
                <img src="/public/img/endeal_logo.svg" alt="endeal_logo">
            </div>
            <div class="avatar">

            <i class="fa-solid fa-circle-user"></i>
            <div class="user-menu">
                <div>
                    <a href="/logout">Logout</a>
                </div>
            </div>
            </div>
        </div> 

        <nav>
            <div class="menu-list">
                <div class="menu-section-header">
                    Salesman
                </div>
                <div class="menu-entry">
                    <a href="/register">
                        <i class="fa-solid fa-person-circle-plus"></i>
                        Add
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="/users">
                        <i class="fa-solid fa-person-circle-question"></i>
                        Detail
                    </a>
                </div>
                <div class="menu-section-header">
                    Product
                </div>
                <div class="menu-entry">
                    <a href="/productAdd">
                        <i class="fa-solid fa-plus"></i>
                        Add
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="/products">
                        <i class="fa-solid fa-list"></i>
                        List
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="#">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        Reports
                    </a>
                </div>
                <div class="menu-section-header">
                    Clients
                </div>
                <div class="menu-entry">
                    <a href="/clientAdd">
                        <i class="fa-solid fa-plus"></i>
                        Add
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="/clients">
                        <i class="fa-solid fa-list"></i>
                        List
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="#">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        Reports
                    </a>
                </div>
            </div>
        </nav>

        <div class="content column-center-center">
            <h3>NEW SALESMAN</h3>
            <form action="register" method="POST" class="form-base-desktop">
                <div class="form-input-wrapper">
                    <input type="text" name="first-name" placeholder="First name" class="text-input-base">
                    <input type="text" name="last-name" placeholder="Last name" class="text-input-base">
                    <input type="text" name="email" placeholder="Email" class="text-input-base">
                    <input type="text" name="licence-code" placeholder="Licence code" class="text-input-base">
                    <input type="text" name="city" placeholder="City" class="text-input-base">
                    <input type="text" name="street" placeholder="Street" class="text-input-base">
                    <input type="text" name="house-number" placeholder="House number" class="text-input-base">
                    <input type="text" name="postal-code" placeholder="Postal code" class="text-input-base">
                    <select name="role" id="role" class="select-input-base">
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
        <footer class="column-center-center">
            Copyright &copy; Endeal 2024
        </footer>
    </div>
</body>
</html>