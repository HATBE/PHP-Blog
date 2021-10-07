<?php require_once(__DIR__ . '/layout/header.php');?>
    
    <div class="card text-white bg-secondary top-buffer">
    <div class="card-body">
        <div class="row justify-content-md-center">
            <form method="POST" class="col-sm-5">
                <h2>Edit Post Number <?= $data['id'];?></h2>
                <?php if($data['errors'] != null):?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach($data['errors'] as $error):?>
                        <?= $error;?><br>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" value="<?= $data['title'];?>" type="text" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Text</label>
                    <textarea name="body" class="form-control" id="body" rows="14"><?= $data['body'];?></textarea>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
    </div>

<?php require_once(__DIR__ . '/layout/footer.php');?>