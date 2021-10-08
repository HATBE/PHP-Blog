<?php Template::load('header');?>
    <?php if(isset($_SESSION['loggedIn'])):?>
        <a href="<?= ROOT_PATH . 'posts/create/';?>" class="my-2 btn btn-success">Create</a>
    <?php endif;?>

    <?php if($data['postsData'] == null):?>
        <div class="alert alert-danger" role="alert">
            No Posts found.
        </div>
    <?php else:?>
        <?php foreach($data['postsData'] as $post): ?>
            <?php Template::load('postCard', array('id' => $post['id'], 'currentPage' => $data['currentPage'], 'body' => $post['body'], 'title' => $post['title'], 'newestPostId' => $data['newestPostId'], 'date' => $post['date'], 'username' => $post['username'], 'view' => $data['view']));?>
        <?php endforeach;?>
    <?php endif;?>

    <?php Template::load('pagination', array('currentPage' => $data['currentPage'], 'maxPage' => $data['maxPage']));?>
<?php Template::load('footer');?>