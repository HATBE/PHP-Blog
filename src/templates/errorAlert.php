<?php if($data['errors'] != null):?>
    <div class="alert alert-danger" role="alert">
    <?php foreach($data['errors'] as $error):?>
        <?= $error;?><br>
    <?php endforeach;?>
    </div>
<?php endif;?>