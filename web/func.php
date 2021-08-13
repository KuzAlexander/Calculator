<?php

    function getKeyNumber($element, array $array)
    {
        $key = array_keys($array);
        $num = array_search($element, $key);
        return $num === false ? NULL : $num;
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
        $str = "";
        if ($selected === null) {
            $str .= "<option selected disabled>$name</option>";
        } else {
            $str .= "<option disabled>$name</option>";
        }

        foreach($arr as $key => $value) {
            if ($key == $selected && $selected != null) {
                $ch = "selected";
            } else {
                $ch = "";
            }
            $str .= "<option $ch value='$key'>$value</option>";
        }
        return $str;
    }

    function warning(string $str, $index)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $index === null) {
            echo "<p class='warning mb-1'>выберите $str</p>";
        }
    }


