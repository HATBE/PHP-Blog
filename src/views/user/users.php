<?php Template::load('header');?>

<a href="<?= ROOT_PATH . 'authentications/register/';?>" class="my-2 btn btn-success">Register</a>

<?php if($data['usersData'] == null):?>
    <div class="alert alert-danger" role="alert">
        No Users found.
    </div>
<?php else:?>
    <table class="table">
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
                <?php if($user->id != $_SESSION['loggedIn']):?>
                    <a href="<?= ROOT_PATH;?>users/delete/<?= $user->id;?>" class="btn btn-danger">Delete</a>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>

<?php Template::load('footer');?>