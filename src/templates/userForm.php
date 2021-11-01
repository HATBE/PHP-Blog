<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="login-form bg-dark mt-4 p-4">
            <form method="POST" class="row g-3">
                <h4><?= $action?></h4>
                <?php Template::load('alert', ['type' => 'danger', 'msg' => $msg]);?>
                <div class="col-12">
                    <label>Username</label>
                    <input type="text" name="usernameInput" class="form-control" placeholder="Username" value="<?= $username?>">
                </div>
                <div class="col-12">
                    <label>Password</label>
                    <input type="password" name="passwordInput" class="form-control" placeholder="Password">
                </div>
                <div class="col-12">
                    <button type="submit" name="submitInput" class="btn btn-primary float-end"><?= $action?></button>
                </div>
            </form>
        </div>
    </div>
</div>