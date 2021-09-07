<?php
/**
 * @var View $this
 * @var Request $request
 * @var string $errorMassage
 */
?>
<div class="wrap">
    <div class="container">
        <div class="main pt-5 pb-5 d-flex flex-column">
            <div class="main__menu">
                <?=$this->renderPhpFile('@/web/views/menu.php', ['request'=>$request])?>
            </div>
            <div class="main__block">
                <div class="alert alert-light" role="alert">
                    <?=$errorMassage?>
                </div>
            </div>
        </div>
    </div>
</div>
