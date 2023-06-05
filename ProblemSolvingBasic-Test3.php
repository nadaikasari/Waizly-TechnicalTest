<?php
    $inputTime = fgets(STDIN);

    $result = timeConversion($inputTime);

    function timeConversion($time) {
        // get time format
        $time_format = substr($time, -2);
        // get time for 12h format
        $time_12h = substr($time, 0, -2);
        // get all hour, minute, second
        [$hour, $minute, $second] = explode(':', $time_12h);

        if ($time_format == 'AM') {
            if ($hour == '12') {
                // if hour is 12 than change to 0
                $hour = '0';
            }
        } else if ($time_format == 'PM') {
            if ($hour < 12) {
                // if hour is less 12, add 12 hour
                $hour = $hour + 12;
            }
        }

        $time_24h = sprintf("%02d:%02d:%02d", $hour, $minute, $second);

        echo $time_24h;
    }