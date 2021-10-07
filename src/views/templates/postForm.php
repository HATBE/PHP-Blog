<div class="card text-white bg-secondary top-buffer">
    <div class="card-body">
        <div class="row justify-content-md-center">
            <form method="POST" class="col-sm-5">
                <h2><?= $data['actionName'];?> Post</h2>
                <?php require(__DIR__ . '/../templates/errorAlert.php');?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" value="<?= $data['title'];?>" type="text" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Text</label>
                    <textarea name="body" class="form-control" id="body" rows="14"><?= $data['body'];?></textarea>
                </div>
                <button name="submit" type="submit" class="btn btn-primary"><?= $data['actionName'];?></button>
            </form>
        </div>
    </div>
</div>