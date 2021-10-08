<div class="card text-white bg-secondary top-buffer">
  <div class="card-body">
    <div class="row justify-content-md-center">
        <form method="POST" class="col-sm-5">
            <h2><?= $actionName;?></h2>
            <?php Template::load('errorAlert', array('errors' => $errors));?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input name="username" value="<?= $username;?>" type="text" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary"><?= $actionName;?></button>
        </form>
    </div>
  </div>
</div>