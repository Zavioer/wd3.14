
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salesman list</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="/public/js/messages.js" defer></script>
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
            <div id="menu-toggle">
                <input name="toggle" type="checkbox" />
                <label for="toggle">
                    <span>menu</span>
                    <div></div>
                    <div></div>
                    <div></div>
                </label>
            </div>

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
            <h3>SALESMAN LIST</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Licence code</th>
                        <th>Role</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php if(isset($users)): ?>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td data-title="Name"><?= $user->getFirstName().' '.$user->getLastName() ?></td>
                            <td data-title="Email"><?= $user->getEmail() ?></td>
                            <td data-title="Licence code"><?= $user->getLicenceCode() ?></td>
                            <td data-title="Role"><?= $user->getRole()->getName() ?></td>
                            <td data-title="Modify"><a href=<?= "/userModify/{$user->getID()}"?>><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td data-title="Delete"><a href=<?= "/userDelete/{$user->getID()}"?>><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
        <footer class="column-center-center">
            Copyright &copy; Endeal 2024
        </footer>
    </div>
</body>
</html>