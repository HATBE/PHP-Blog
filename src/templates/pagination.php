<?php if($maxPage != 1 && $currentPage <= $maxPage):?>
    <nav aria-label="...">
        <ul class="pagination top-buffer">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : ''?>">
                    <a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($currentPage - 1)?>">Previous</a>
                </li>
            <?php if($currentPage > 1):?>
                <li class="page-item"><a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($currentPage - 1);?>"><?= ($currentPage - 1);?></a></li>
            <?php endif;?>
            <li class="page-item active">
            <span class="page-link">
                <?= $currentPage;?>
            </span>
            </li>
            <?php if($currentPage < $maxPage):?>
                <li class="page-item"><a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($currentPage + 1);?>"><?= ($currentPage + 1);?></a></li>
            <?php endif;?>
                <li class="page-item <?= $currentPage >= $maxPage ? 'disabled' : ''?>">
                    <a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($currentPage + 1)?>">Next</a>
                </li>
        </ul>
    </nav>
<?php endif;?>