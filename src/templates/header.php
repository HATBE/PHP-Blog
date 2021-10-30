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
    <meta name="keywords" content="<?= DEFAULT_KEYWORDS?>">
    <meta name="author" content="hatbe2113">
</head>
<body>
    <header class="bg-dark mb-4 shadow text-light">
        <div class="container">
            <div class="text-center p-3">
                <h1>
                    <a href="<?= ROOT_PATH?>" class="link-light text-decoration-none">
                        <?= PAGE_TITLE?>
                    </a>
                </h1>
                <h6 class="text-muted">
                    <?= PAGE_SLOGAN?>
                </h6>
            </div>
            <nav class="bg-dark navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="<?= Linker::link('posts', 'index')?>">Blog</a>
                        </div>
                    </div>
                </div>
            </nav>
    </header>
        </div>
    <main>
        <div class="container">