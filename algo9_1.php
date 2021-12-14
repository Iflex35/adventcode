<?php

$handle = fopen("test9.txt", "r");
$tab = [];
$res = 0;
if ($handle) {
    
    while (($line = fgets($handle)) !== false) 
    {
        $lineString = trim(preg_replace('/\s\s+/', ' ', $line));
        $tab[] = str_split($lineString);
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

foreach ($tab as $x => $x_axe)
{
    foreach ($x_axe as $yKey => $y)
    {

            $DownMore  = !isset($tab[$x-1][$yKey]) || ($tab[$x-1][$yKey] > $y);
            $UpMore = !isset($tab[$x+1][$yKey]) || $tab[$x+1][$yKey] > $y;
            $RightMore    = !isset($tab[$x][$yKey+1]) || $tab[$x][$yKey+1] > $y;
            $LeftMore  = !isset($tab[$x][$yKey-1]) || $tab[$x][$yKey-1] > $y;


            if ($LeftMore &&
                $RightMore &&
                $UpMore &&
                $DownMore)
            {
                echo 'x : ' .$x . '; y : ' . $yKey . ' ____  ';
                echo $y . "\n";
                $res += ($y + 1);
            }
        
    }
}





echo $res . "\n";

//var_dump(explode("\n", $tab[0]));
echo "\n-------------\n";



//test($res);
