<div class="pagination justify-content-center">
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination">
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="page-link">
                        <span aria-hidden="true" class="page-link"><?= lang('Pager.first') ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
                        <span aria-hidden="true" class="page-link"><?= lang('Pager.previous') ?></span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <li <?= $link['active'] ? 'class="active"' : '' ?> class="page-item active">
                    <a href="<?= $link['uri'] ?>" class="page-link">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
                        <span aria-hidden="true" class="page-link"><?= lang('Pager.next') ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
                        <span aria-hidden="true" class="page-link"><?= lang('Pager.last') ?></span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>