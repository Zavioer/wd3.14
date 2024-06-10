
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salesman list</title>
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
            <h3>SALESMAN LIST</h3>
            <div class="horizontal-scroll">
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
        </div>

        <?php include __DIR__.'/components/footer.php'; ?>
    </div>
</body>
</html>