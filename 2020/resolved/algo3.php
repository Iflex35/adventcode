<?php

$handle = fopen("test3.txt", "r");
$tab = [];
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $tab[] = str_split(trim($line));
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

$position = [0,0];
echo "\n-------------\n";

function move(&$position, $pattern)
{
    $position = [$position[0] + $pattern[0], $position[1] + $pattern[1]];
    return $position;
}

function countTreeSlope($tab, $slope)
{
    $nbTree = 0;
    do {
        move($position, $slope);
        $pos_x  = $position[1];
        if (!isset($tab[$position[0]][$position[1]]))
        {
            $pos_x = intval(fmod($position[1], 31));
        }
        if ($tab[$position[0]][$pos_x] == '#')
        {
            $nbTree ++;
        }
    } while ($position[0] < count($tab) - 1);
    return $nbTree;
}

$t = [[1,1], [1,3], [1, 5], [1, 7], [2,1]];

$result = 1;
foreach ($t as $try)
{
    $nbTree = countTreeSlope($tab, $try);
    echo $nbTree . "\n";
    $result = $result * $nbTree;
}

echo $result;

//test($res);
