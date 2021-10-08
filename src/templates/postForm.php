<div class="card text-white bg-secondary top-buffer">
    <div class="card-body">
        <div class="row justify-content-md-center">
            <form method="POST" class="col-sm-5">
                <h2><?= $actionName;?> Post</h2>
                <?php Template::load('errorAlert', array('errors' => $errors));?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" value="<?= $title;?>" type="text" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Text</label>
                    <textarea name="body" class="form-control" id="body" rows="14"><?= $body;?></textarea>
                </div>
                <button name="submit" type="submit" class="btn btn-primary"><?= $actionName;?></button>
            </form>
        </div>
    </div>
</div>