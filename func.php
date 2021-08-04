<?php

    function outputKey($array){
        echo "\n";
        foreach ($array as $key => $value){
            echo $key . ' - ' . $value . ' ';
        }
        echo "\n";
    }

    function check($element, $array){
        $key = array_keys($array);
        $num = array_search($element, $key);
        if($num === false) {
            return -1;
        }else{
            return $num;
        }
    }
