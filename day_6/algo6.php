<?php

$handle = fopen("test6.txt", "r");
$init = [1=>0, 2=> 0, 3=>0, 4=>0, 5=>0, 6 => 0, 7 => 0, 8=> 0];
$tab = $init;
if ($handle) {
    
    while (($line = fgets($handle)) !== false) 
    {
        $arr = explode(',', $line);
        foreach($arr as $value)
        {
            $value = intval($value);
            if (!isset($tab[$value]))
            {
                $tab[$value] = 0;
            }
            $tab[$value] ++;
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

$res = 0;
$nbDay = 256;

for($i=0; $i < $nbDay; $i++)
{
    $tabTmp = $init;
    foreach($tab as $internalTimer => $nbLanter)
    {
        if ($internalTimer > 0 )
        {
            $tabTmp[$internalTimer-1] = $nbLanter;
        }
        else
        {
            $tabTmp[6] += $nbLanter;
            $tabTmp[8] += $nbLanter;
        }
    }
    if ($i == 1)
    {

       
    }
    $tab = $tabTmp;
}

foreach ($tab as $allLantern)
{
    $res += $allLantern;
}
echo $res . "\n";

//var_dump(explode("\n", $tab[0]));
echo "\n-------------\n";



//test($res);
