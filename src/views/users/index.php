<?= Template::load('header', ['title' => 'Users', 'tags' => '']);?>

<h1 class="d-none">Users Overview</h1>

<a href="<?= Linker::link('auth', 'register')?>" class="btn btn-primary">+ Register</a>

<?php if($data['usersData'] == null):?>
    <div class="alert alert-danger" role="alert">
        No Users found.
    </div>
<?php else:?>
    <table class="table table-dark mt-4">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($data['usersData'] as $user): ?>
        <tr>
            <th scope="row"><?= $user->id;?></th>
            <td><?= $user->username;?></td>
            <td><a href="<?= ROOT_PATH;?>users/edit/<?= $user->id;?>" class="btn btn-warning">Edit</a></td>
            <td>
                <?php if($user->id != $_SESSION['loggedIn'] || $user->id != 1):?>
                    <a href="<?= ROOT_PATH;?>users/delete/<?= $user->id;?>" class="btn btn-danger">Delete</a>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>

<?= Template::load('footer');?>