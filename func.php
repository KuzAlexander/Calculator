<?php
    function outputTabl($arr){
        foreach($arr as $arr1){
            foreach($arr1 as $arr2){
                foreach($arr2 as $value){
                    echo $value . ' ';		
                }
                echo "\n";		
            }
            echo "\n";	            
        }

    }

    function searchTonnage($arr, $ton){
        for($i = 2; $i < count($arr); $i++){
            if (trim($arr[$i][0]) == $ton){
                return $i;
            }
        } 	
    }  
?>    