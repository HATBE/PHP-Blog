<?php if($data['maxPage'] != 1 && $data['currentPage'] <= $data['maxPage']):?>
    <nav aria-label="...">
        <ul class="pagination top-buffer">
                <li class="page-item <?= $data['currentPage'] <= 1 ? 'disabled' : ''?>">
                    <a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] - 1)?>">Previous</a>
                </li>
            <?php if($data['currentPage'] > 1):?>
                <li class="page-item"><a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] - 1);?>"><?= ($data['currentPage'] - 1);?></a></li>
            <?php endif;?>
            <li class="page-item active">
            <span class="page-link">
                <?= $data['currentPage'];?>
            </span>
            </li>
            <?php if($data['currentPage'] < $data['maxPage']):?>
                <li class="page-item"><a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] + 1);?>"><?= ($data['currentPage'] + 1);?></a></li>
            <?php endif;?>
                <li class="page-item <?= $data['currentPage'] >= $data['maxPage'] ? 'disabled' : ''?>">
                    <a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] + 1)?>">Next</a>
                </li>
        </ul>
    </nav>
<?php endif;?>