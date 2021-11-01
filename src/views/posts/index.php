<?= Template::load('header', ['title' => 'Home']);?>

<?= Template::load('postsList', ['posts' => $data['posts']['posts'], 'meta' => $data['posts']['meta']]);?>
<?= Template::load('pagination', ['meta' => $data['posts']['meta'], 'controller' => 'posts', 'method' => 'index']);?>

<?= Template::load('footer');?>