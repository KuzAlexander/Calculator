<?php

    require_once('../data/table.php');
    require_once 'func.php';

    $keyArr = array_keys($arr);

    while (true) {
        printKey($keyArr);
        $product = trim(readline('выберите продукт: '));
        $productIndex = getKeyNumber($product, $keyArr);
        if (isset($productIndex)) {
            break;
        }
        echo "Элемента нет в списке." . PHP_EOL;
    }

    while (true) {
        printKey($arrMonth);
        $month = trim(readline('выберите месяц: '));
        $monthIndex = getKeyNumber($month, $arrMonth);
        if (isset($monthIndex)) {
            break;
        }
        echo "Элемента нет в списке." . PHP_EOL;
    }

    while (true) {
        $keyTonnage = array_keys($arr[$keyArr[$productIndex]]);
        printKey($keyTonnage);
        $tonnage = trim(readline('выберите тоннаж: '));
        $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
        if (isset($tonnageIndex)) {
            break;
        }
        echo "Элемента нет в списке." . PHP_EOL;
    }

    echo PHP_EOL . "Цена: "  . $arr[$keyArr[$productIndex]][$keyTonnage[$tonnageIndex]][$monthIndex] . PHP_EOL;

    $str = tableOutput($arr, $keyArr[$productIndex], $arrMonth);

    echo $str;
