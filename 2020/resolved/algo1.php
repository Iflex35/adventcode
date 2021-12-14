<?php

$handle = fopen("test.txt", "r");
if ($handle) {
    $tab = [];
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $tab[] = intval($line);
    }

    foreach ($tab as $key => $val)
    {
        foreach ($tab as $key2 => $val2)
        {
            foreach ($tab as $key3 => $val3)
            {
                if ($key != $key2 && $key != $key3)
                {
                    if($val + $val2 + $val3 == 2020)
                    {
                        echo $val . ' ; ' . $val2 . ' ; ' . $val3;
                        echo "\n";
                        echo $val * $val2 * $val3;
                        echo "\n";
                    }
                }
            }
            unset($tab[$key]);
        }
    }

    fclose($handle);
} else {
    // error opening the file.
    echo 'MERDE';
} 