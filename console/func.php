<?php

    function printKey(array $array)
    {
        echo PHP_EOL;
        foreach ($array as $key => $value) {
            echo $key . ' - ' . $value . PHP_EOL;
        }
        echo PHP_EOL;
    }

    function getKeyNumber(string $element, array $array): ?int
    {
        $key = array_keys($array);
        foreach ($key as $value) {
            if ($element === (string) $value) {
                return $value;
            }
        }
        return null;
    }

    function tableOutput(array $array, string $product, array $month): string
    {
        $str = PHP_EOL . $product . PHP_EOL;
        $str .= "мес/тон\t\t" . implode("    \t", $month) . PHP_EOL;

        foreach ($array[$product] as $key => $value) {
            $str .= $key . ' ';
            foreach ($value as $val) {
                $str .= "\t\t" . $val . ' ';
            }
            $str .= PHP_EOL;
        }
        return $str;
    }




