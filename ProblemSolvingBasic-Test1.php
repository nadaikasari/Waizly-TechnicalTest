<?php

    echo "Enter numbers : ";
    $input = fgets(STDIN);

    // Split the input into an array
    $numbers = explode(' ', $input);
    $numbers = array_map('trim', $numbers);
    
    getMinMaxSum($numbers);

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