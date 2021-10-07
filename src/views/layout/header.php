<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?= ROOT_PATH;?>assets/css/style.css">

        <title><?= SITE_NAME;?></title>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-dark bg-dark">
            <div class="container">
                <a class=" navbar-brand" href="<?= ROOT_PATH;?>"><?= SITE_NAME;?></a>
                
                <?php if(!isset($_SESSION['loggedIn'])):?>
                    <a href="<?= ROOT_PATH;?>users/login">
                        <button class="btn btn-sm btn-outline-primary" type="button">Login</button>
                    </a>
                <?php else:?>
                    <div>
                        <a class="nounderline" href="<?= ROOT_PATH;?>users/logout">
                            <button class="btn btn-sm btn-outline-primary" type="button">Logout</button>
                        </a>
                        <a class="nounderline" href="<?= ROOT_PATH;?>users/users">
                            <button class="btn btn-sm btn-outline-primary" type="button">Users</button>
                        </a>
                    </div>
                <?php endif;?>
            </div>
        </nav>
        <div class="body-container">
            <div class="container p-3">