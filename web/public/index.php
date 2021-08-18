<?php

    function getAbsolutePath (string $path): string
    {
        return str_replace('@', dirname(__DIR__, 2), $path);
    }

    $data = require_once(getAbsolutePath('@/data/table.php'));

    $arrMonth = $data[0];
    $arrProduct = $data[1];

    require_once (getAbsolutePath('@/web/func.php'));

    $keyArrProduct = array_keys($arrProduct);
    $product = $_POST['product'];
    if (isset($product)) {
        $productIndex = getKeyNumber($product, $keyArrProduct);
    }

    $month = $_POST['month'];
    if (isset($month)) {
        $monthIndex = getKeyNumber($month, $arrMonth);
    }

    $keyTonnage = array_keys($arrProduct[$keyArrProduct[0]]);
    $tonnage = $_POST['tonnage'];
    if (isset($tonnage)) {
        $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
    }

    require_once (getAbsolutePath('@/web/view.php'));

