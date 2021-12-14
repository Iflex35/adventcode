<?php

$handle = fopen("test7.txt", "r");
$max = 0;
$tab = [];
$maxval = 0;
if ($handle) {
    
    while (($line = fgets($handle)) !== false) 
    {
        $arr = explode(',', $line);
        foreach($arr as $value)
        {
            $value = intval($value);
            $tab[] = $value;
            $max += $value;
            if ($value > $maxval)
            {
                $maxval = $value;
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

$minFuel = null;


$mid = round($max / count($tab),0);
$base = round($maxval / 2 , 0);
$test = (($base * ($base + 1)) / 2) ;
for ($i = 0 ; $i < $mid ; $i++)
{
    $fuel = 0;
    foreach($tab as $val)
    {
        $base = abs($i - $val);
        $fuel += (($base * ($base + 1)) / 2) ;
    }
    if (!$minFuel || $fuel < $minFuel)
    {
        $minFuel = $fuel;
    }
}

echo $minFuel . "\n";

//var_dump(explode("\n", $tab[0]));
echo "\n-------------\n";



//test($res);
