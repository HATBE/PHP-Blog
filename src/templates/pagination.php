<?php if($meta):?> 
<div class="container d-flex justify-content-center">
<?php if($meta['maxPage'] > 1 && $meta['page'] <= $meta['maxPage']):?>
    <nav aria-label="...">
        <ul class="pagination top-buffer">
                <li class="page-item <?= $meta['page'] <= 1 ? 'disabled' : ''?>">
                    <a class="page-link link-light" href="<?= Linker::link($controller, $method, [($meta['page'] - 1), $args])?>">&lt;</a>
                </li>
            <?php if($meta['page'] > (1 + 1)):?>
                <li class="page-item"><a class="page-link link-light" href="<?= Linker::link($controller, $method, [1, $args])?>">1</a></li>
                <?php if($meta['page'] > (1 + 2)):?>
                    <li class="page-item"><a class="page-link link-light" href="">...</a></li>
                <?php endif;?>
            <?php endif;?>
            <?php if($meta['page'] > 1):?>
                <li class="page-item"><a class="page-link link-light" href="<?= Linker::link($controller, $method, [($meta['page'] - 1), $args])?>"><?= ($meta['page'] - 1);?></a></li>
            <?php endif;?>
            <li class="page-item active">
            <span class="page-link">
                <?= $meta['page'];?>
            </span>
            </li>
            <?php if($meta['page'] < $meta['maxPage']):?>
                <li class="page-item"><a class="page-link link-light" href="<?= Linker::link($controller, $method, [($meta['page'] + 1), $args])?>"><?= ($meta['page'] + 1);?></a></li>
            <?php endif;?>
            <?php if($meta['page'] < ($meta['maxPage'] - 1)):?>
                <?php if($meta['page'] < ($meta['maxPage'] - 2)):?>
                    <li class="page-item"><a class="page-link link-light" href="">...</a></li>
                <?php endif;?>
                <li class="page-item"><a class="page-link link-light" href="<?= Linker::link($controller, $method, [$meta['maxPage'], $args])?>"><?= $meta['maxPage']?></a></li>
                <?php endif;?>
            <li class="page-item <?= $meta['page'] >= $meta['maxPage'] ? 'disabled' : ''?>">
                <a class="page-link link-light" href="<?= Linker::link($controller, $method, [($meta['page'] + 1), $args])?>">&gt</a>
            </li>
        </ul>
    </nav>
<?php endif;?>
</div>
<?php endif;?>

