<?php if(!empty($msg)):?>
<div class="alert alert-<?= $type?>" role="alert">
    <?php foreach($msg as $ms):?>
        <?= $ms?><br>
    <?php endforeach;?>
</div>
<?php endif;?>