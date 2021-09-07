<?php
/**
 * @var array $keyTonnage
 * @var string $tonnage
 * @var Request $request
 * @var View $this
 */
?>
<div class="wrap">
    <div class="container">
        <div class="main pt-5 pb-5 d-flex flex-column">
            <div class="main__menu">
                <?=$this->renderPhpFile('@/web/views/menu.php', ['request'=>$request])?>
            </div>
            <div class="main__block">
                <p class="fs-3 mb-3"><?=$tonnage?></p>
                <?php foreach ($keyTonnage as $key => $value): ?>
                    <p class="fs-4 mb-2"><?=$key + 1 . '. ' . $value?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>