<?php

$handle = fopen("test8.txt", "r");
$max = 0;
$tab = [];
$maxval = 0;
$res = 0;
if ($handle) {
    
    while (($line = fgets($handle)) !== false) 
    {
        $lineString = trim(preg_replace('/\s\s+/', ' ', $line));
        $arr = explode('|', $lineString);
        $output_values = $arr[1];
        $output_values_array = explode(' ', $output_values);
        foreach($output_values_array as $output_digit)
        {
            switch (strlen($output_digit))
            {
                case 2:
                case 3:
                case 4:
                case 7:
                    $res ++;
                    echo $output_digit . "\n";
                    break;
                default:
                    break;
            }
        }
    }
    fclose($handle);

} else {
    // error opening the file.
    echo 'MERDE';
}

function debug($a)
{
    $r = '';
    foreach($a as $b)
    {
        $r.= $b . ' ';
    }
    echo $r . "\n";
}





echo $res . "\n";

//var_dump(explode("\n", $tab[0]));
echo "\n-------------\n";



//test($res);
