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
