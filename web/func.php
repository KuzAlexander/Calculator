<?php

    function getKeyNumber($element, array $array): ?int
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
        $str = "<p class='product'>$product</p><table>";
        $str .= "<tr><td>мес/тон</td>";
        foreach ($month as $value) {
            $str .= "<td>$value</td>";
        }
        $str .= "</tr>";

        foreach ($array[$product] as $key => $value) {
            $str .= "<tr><td>$key</td>";
            foreach ($value as $val) {
                $str .= "<td>$val</td>";
            }
            $str .= "</tr>";
        }
        $str .= "</table>";
        return $str;
    }

    function option(array $arr, string $name, $selected): string
    {
        $select = ($selected === null) || ($selected === $name) ? 'selected' : '';
        $str = "<option $select>$name</option>";

        foreach($arr as $key => $value) {
            $ch = (string) $key === $selected ? 'selected' : '';
            $str .= "<option $ch value='$key'>$value</option>";
        }
        return $str;
    }

    function warning(string $str, $index): string
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && (($index === null) || ($index === $str))) {
            return "<p class='warning mb-1'>выберите $str</p>";
        }
        return '';
    }



