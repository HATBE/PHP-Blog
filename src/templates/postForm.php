
<div class="row justify-content-md-center">
    <form method="POST" class="col-sm-5">
        <h2><?= $actionName;?> Post</h2>
        <?php Template::load('alert', ['type' => 'danger', 'msg' => $errors]);?>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="titleInput" value="<?= $title;?>" type="text" class="form-control" id="title">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Text</label>
            <textarea name="bodyInput" class="form-control" id="body" rows="14"><?= $body;?></textarea>
        </div>
        <button name="submitInput" type="submit" class="btn btn-primary"><?= $actionName;?></button>
    </form>
</div>
