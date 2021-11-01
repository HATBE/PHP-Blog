<?php if($posts !== null):?>
    <?php if(isset($_SESSION['loggedIn'])):?>
        <div class="my-2">
            <a href="<?= Linker::link('posts', 'create')?>" class="btn btn-primary">+ ADD</a>
        </div>
    <?php endif;?>
    <b><?= $meta['elements']?></b> of <b><?= $meta['count']?></b> posts on page <b><?= $meta['page']?></b> of <b><?= $meta['maxPage']?></b>
    <?php foreach($posts as $post):?>
        <?php Template::load('post', ['post' => $post, 'view' => true, 'page' => $meta['page']]);?>
    <?php endforeach;?>
<?php else:?>
    <?php Template::load('alert', ['type' => 'danger', 'msg' => 'No posts found!']);?>
<?php endif;?>