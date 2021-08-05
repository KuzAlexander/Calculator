<?php

    require_once 'func.php';

    $arrMonth = ['Январь', 'Февраль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь'];

    $arr = [
        'Шрот' => [
            25 => [125, 121, 137, 126, 124, 128],
            50 => [145, 118, 119, 121, 122, 147],
            75 => [136, 137, 141, 137, 131, 143],
            100 => [138, 142, 117, 124, 147, 112],
        ],

        'Жмых' => [
            25 => [121, 137, 124, 137, 122, 125],
            50 => [118, 121, 145, 147, 143, 145],
            75 => [137, 124, 136, 143, 112, 136],
            100 => [142, 131, 138, 112, 117, 138],
        ],

        'Соя' => [
            25 => [137, 125, 124, 122, 137, 121],
            50 => [147, 145, 145, 143, 119, 118],
            75 => [112, 136, 136, 112, 141, 137],
            100 => [122, 138, 138, 117, 117, 142],
        ],
    ];

    $keyArr = array_keys($arr);

    while (true) {
        printKey($keyArr);
        $product = trim(readline('выберите продукт: '));
        $productIndex = getKeyNumber($product, $keyArr);
        if ($productIndex !== -1) {
            break;
        }
        echo "Элемента нет в списке." . PHP_EOL;
    }

    while (true) {
        printKey($arrMonth);
        $month = trim(readline('выберите месяц: '));
        $monthIndex = getKeyNumber($month, $arrMonth);
        if ($monthIndex !== -1) {
            break;
        }
        echo "Элемента нет в списке." . PHP_EOL;
    }

    while (true) {
        $keyTonnage = array_keys($arr[$keyArr[$productIndex]]);
        printKey($keyTonnage);
        $tonnage = trim(readline('выберите тоннаж: '));
        $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
        if ($tonnageIndex !== -1) {
            break;
        }
        echo "Элемента нет в списке." . PHP_EOL;
    }

    echo PHP_EOL . "Цена: "  . $arr[$keyArr[$productIndex]][$keyTonnage[$tonnageIndex]][$monthIndex] . PHP_EOL;

    $str = tableOutput($arr, $keyArr[$productIndex], $arrMonth);

    echo $str;
