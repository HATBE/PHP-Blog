<?php Template::load('header');?>
<?php Template::load('backBtn', array('path' => $data['backPath']));?>
<?php if($data['post'] == null):?>
    <div class="alert alert-danger" role="alert">
        No Post found.
    </div>
<?php else:?>
    <?php $post = $data['post'];?>
    <?php Template::load('postCard', array('id' => $post['id'], 'currentPage' => '', 'body' => $post['body'], 'title' => $post['title'], 'newestPostId' => $data['newestPostId'], 'date' => $post['date'], 'username' => $post['username'], 'view' => $data['view']));?>
<?php endif;?>

<?php Template::load('footer');?>