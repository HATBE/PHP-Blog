<?php require_once(__DIR__ . '/layout/header.php');?>

<div class="card text-white bg-secondary top-buffer">
  <div class="card-body">
    <div class="row justify-content-md-center">
        <form method="POST" class="col-sm-5">
            <h2>Edit user ID <?= $data['id'];?></h2>
            <?php if($data['errors'] != null):?>
              <div class="alert alert-danger" role="alert">
                <?php foreach($data['errors'] as $error):?>
                    <?= $error;?><br>
                <?php endforeach;?>
              </div>
            <?php endif;?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input name="username" value="<?= $data['username'];?>" type="text" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
  </div>
</div>

<?php require_once(__DIR__ . '/layout/footer.php');?>