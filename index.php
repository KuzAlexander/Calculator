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
        outputKey($keyArr);
        $product = trim(readline('введите продукт: '));
        $productIndex = check($product, $keyArr);
        if ($productIndex == -1){
            echo "Элемента нет в списке.\n";
            continue;
        }

        outputKey($arrMonth);
        $month = trim(readline('введите месяц: '));
        $monthIndex = check($month, $arrMonth);
        if ($monthIndex == -1){
            echo "Элемента нет в списке.\n";
            continue;
        }

        $keyTonnage = array_keys($arr[$keyArr[$productIndex]]);
        outputKey($keyTonnage);
        $tonnage = trim(readline('введите тоннаж: '));
        $tonnageIndex = check($tonnage, $keyTonnage);
        if ($tonnageIndex == -1){
            echo "Элемента нет в списке.\n";
            continue;
        }

        echo 'Цена: ' . $arr[$keyArr[$productIndex ]][$keyTonnage[$tonnageIndex]][$monthIndex] . ".\n";
        break;
    }


    $str = "\n" . $keyArr[$productIndex] . "\n";
    $str .= "мес/тон\t\t" . implode("    \t", $arrMonth) . "\n";

    foreach ($arr[$keyArr[$productIndex]] as $key => $value){
        $str .= $key . ' ';
        foreach ($value as $k => $val){
            $str .= "\t\t" . $val . ' ';
        }
        $str .= "\n";
    }
    echo $str;

	