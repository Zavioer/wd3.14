
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client list</title>
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

            <?php include __DIR__.'/components/avatar.php'; ?>
        </div> 
        
        <?php include __DIR__.'/components/nav.php'; ?>

        <div class="content column-center-center">
            <h3>CLIENT LIST</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Company name</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php if(isset($clients)): ?>
                    <?php foreach($clients as $client): ?>
                        <tr>
                            <td data-title="Name"><?= "{$client->getFirstName()} {$client->getLastName()}" ?></td>
                            <td data-title="Address"><?= "{$client->getCity()} {$client->getStreet()} {$client->getHouseNumber()}" ?></td>
                            <td data-title="Company name"><?= $client->getCompanyName() ?></td>
                            <td data-title="Modify"><a href=<?= "/clientModify/{$client->getId()}"?>><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td data-title="Delete"><a href=<?= "/clientDelete/{$client->getId()}"?>><i class="fa-solid fa-trash-can"></i></a></td>
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