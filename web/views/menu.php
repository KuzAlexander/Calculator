<?php
    /**
     * @var string $str
     */
?>

<nav class="navbar navbar-dark navbar-expand-lg navbar-light mb-5">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>-->
<!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link <?=$str === '/index.php' || $str === '/' ? 'active' : ''?>" href="index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <?php $str = substr($str, stripos($str,'?')) ?>
                    <a class="nav-link <?=$str === '?page=product' ? 'active' : ''?>" href="?page=product">Продукты</a>
                </li>
                <li class="nav-item">
                    <?php $str = substr($str, stripos($str,'?')) ?>
                    <a class="nav-link <?=$str === '?page=tonnage' ? 'active' : ''?>" href="?page=tonnage">Тоннаж</a>
                </li>
            </ul>
        </div>
    </div>
</nav>