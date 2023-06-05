<?php
    function plusMinus($arr) {
        // Number Ratio
        $positive_ratio = 0;
        $negative_ratio = 0;
        $zero_ratio = 0;

        // Number Count
        $positive_count = 0;
        $negative_count = 0;
        $zero_count = 0;

        // count all type of number
        foreach($arr as $check_num) {
            if ($check_num > 0) {
                $positive_count++;
            } else if($check_num < 0){
                $negative_count++;
            } else {
                $zero_count++;
            }
        }

        // total number count
        $total_count = $positive_count + $negative_count + $zero_count;

        // Number Ratio
        $positive_ratio = round($positive_count / $total_count, 6);
        $negative_ratio = round($negative_count / $total_count, 6);
        $zero_ratio = round($zero_count / $total_count, 6);

        // Print answer with 6 places after the decimal.
        echo sprintf("%6f\n", $positive_ratio);
        echo sprintf("%6f\n", $negative_ratio);
        echo sprintf("%6f\n", $zero_ratio);
    }

    $number = intval(trim(fgets(STDIN)));

    $array_temp = rtrim(fgets(STDIN));

    $array = array_map('intval', preg_split('/ /', $array_temp, -1, PREG_SPLIT_NO_EMPTY));

    plusMinus($array);