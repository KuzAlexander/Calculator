<?php
    /**
     * @var $request
     */
    $uri = $request->get('page');
?>

<nav class="navbar navbar-dark navbar-expand-lg navbar-light mb-5">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?=!$request->get() || $uri === 'index' || $uri === '' ? 'active' : ''?>" href="index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$uri === 'product' ? 'active' : ''?>" href="?page=product">Продукты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$uri === 'tonnage' ? 'active' : ''?>" href="?page=tonnage">Тоннаж</a>
                </li>
            </ul>
        </div>
    </div>
</nav>