<div class="card text-white bg-secondary top-buffer">
  <div class="card-body">
    <div class="row justify-content-md-center">
        <form method="POST" class="col-sm-5">
            <h2><?= $data['actionName'];?></h2>
            <?php require(__DIR__ . '/../templates/errorAlert.php');?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input name="username" value="<?= $data['username'];?>" type="text" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary"><?= $data['actionName'];?></button>
        </form>
    </div>
  </div>
</div>