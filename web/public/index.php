<?php
    require_once('../../data/table.php');
    require_once ('../func.php');

    $keyArr = array_keys($arr);
    $product = $_REQUEST['product'];
    if (isset($product)) {
        $productIndex = getKeyNumber($product, $keyArr);
    }

    $month = $_REQUEST['month'];
    if (isset($month)) {
        $monthIndex = getKeyNumber($month, $arrMonth);
    }

    $keyTonnage = array_keys($arr[$keyArr[0]]);
    $tonnage = $_REQUEST['tonnage'];
    if (isset($tonnage)) {
        $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
    }

    $post = $_SERVER['REQUEST_METHOD'] === 'POST';

    require_once ('../view.php');

