<?php

$handle = fopen("test2.txt", "r");
if ($handle) {
    $tab = [];
    $valid = 0 ;
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        if(isValid($line))
        {
            $valid++;
        }

    }

    


    fclose($handle);

    echo $valid;
} else {
    // error opening the file.
    echo 'MERDE';
}


function isValid($str, $test = false)
{
    $r1 = 0;
    $r2 = 0;
    $tabStr = explode(':', $str);

    //PASSWORD
    $password = trim($tabStr[1]);
    
    //RULES
    $rules = $tabStr[0];
    $tabRules = explode(' ', $rules);
    $letter = $tabRules[1];
    
    //MIN MAX
    $minMax = $tabRules[0];
    $tabMinMax = explode('-', $minMax);
    $min = intval($tabMinMax[0]);
    $max = intval($tabMinMax[1]);
    if (isset($password[$min-1]) &&  $password[$min-1] == $letter)
    {
        $r1 = 1;
    }
    if (isset($password[$max-1]) &&  $password[$max-1] == $letter)
    {
        $r2 = 1;
    }
    if ($test)
    {
        debug([$min, $max, $password[$min+1] , $password[$max+1],  $letter ]);
    }
    //return $occurence >= $min && $occurence <= $max;
    return ($r1 + $r2) == 1;

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
function test($res)
{
    foreach($res as $r)
    {
        echo $r['data'] . ' ';
        echo ($r['oracle'] == isValid($r['data'], true)) ? 'true' : 'false';
        echo "\n";
    }
}

$res = [];
$res[] = ['data' => '5-9 g: ggccggmgn', 'oracle' => true];
$res[] = ['data' => '11-16 l: llllqllllllllflq', 'oracle' => true];
$res[] = ['data' => '3-6 q: qvqqqpzqd', 'oracle' => true];
$res[] = ['data' => '6-11 f: ffffpcffffp', 'oracle' => false];

echo "\n-------------\n";
test($res);
