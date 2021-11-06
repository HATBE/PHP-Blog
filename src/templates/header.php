<?php
    // $title
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= ROOT_PATH?>assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>

    <link rel="icon" href="<?= ROOT_PATH?>assets/img/favico.png" type="image/x-icon">

    <title><?= PAGE_TITLE?> - <?= $title?></title>
    <meta name="description" content="<?= DESCRIPTION?>">
    <meta name="keywords" content="<?= DEFAULT_KEYWORDS . $tags?>">
    <meta name="author" content="hatbe2113">
</head>
<body>
    <header class="bg-dark mb-4 shadow text-light">
        <div class="container">
            <div class="text-center p-3">
                <h2>
                    <a href="<?= ROOT_PATH?>" class="link-light text-decoration-none">
                        <?= PAGE_TITLE?>
                    </a>
                </h2>
                <h6 class="text-muted">
                    <?= PAGE_SLOGAN?>
                </h6>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?= Linker::link('posts', 'index')?>">Blog</a>
                            </li>
                            <?php if(!isset($_SESSION['loggedIn'])):?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?= Linker::link('auth', 'login')?>">Login</a>
                            </li>
                            <?php else:?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?= Linker::link('users', 'index')?>">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?= Linker::link('auth', 'logout')?>">Logout</a>
                            </li>
                            <?php endif;?>
                        </ul>
                        <form action="<?= Linker::link('index', 'index')?>" method="GET" class="d-flex shadow">
                            <input value="<?= isset($_GET['q']) ? $_GET['q'] : '';?>" class="form-control border-0 bg-secondary text-white" placeholder="Search" name="q" type="search" placeholder="Search" aria-label="Search" required>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
    </header>
        </div>
    <main>
        <div class="container">