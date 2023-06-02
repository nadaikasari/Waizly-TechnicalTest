<?php

    function getMinMaxSum($array) {
        $sum = array_sum($array);
        $min = $sum;
        $max = 0;
        foreach($array as $value) {
            $excluded_sum = $sum - $value;
            if($max < $excluded_sum) {
                $max = $excluded_sum;
            }
            if($min > $excluded_sum) {
                $min = $excluded_sum;
            }
        }
        print "$min $max";
    }

    $arrayNumber = [1,3,5,7,9];
    getMinMaxSum($arrayNumber);