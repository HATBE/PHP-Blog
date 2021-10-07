<?php require_once(__DIR__ . '/layout/header.php');?>
    <form method="POST">
        <h2>Delete User number <?= $data['id'];?></h2>
        <h6>Are you Sure?</h6>
        <button id="sure" class="btn btn-danger" type="submit" name="sure">YES</button>
    </form>
<?php require_once(__DIR__ . '/layout/footer.php');?>