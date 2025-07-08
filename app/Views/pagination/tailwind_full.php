<?php
$pager->setSurroundCount(2);
?>
<nav>
    <ul class="inline-flex items-center -space-x-px text-base h-10">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getPrevious() ?>" class="px-4 py-2 rounded-l-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">PREV</a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <li>
                <a href="<?= $link['uri'] ?>"
                   class="px-4 py-2 border border-gray-300 <?= $link['active'] ? 'bg-gray-800 text-white rounded-full' : 'bg-white text-gray-700 hover:bg-gray-100' ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" class="px-4 py-2 rounded-r-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">NEXT</a>
            </li>
        <?php endif ?>
    </ul>
</nav> 