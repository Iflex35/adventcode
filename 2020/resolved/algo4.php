<?php

$handle = fopen("test4.txt", "r");
$tab = [];
if ($handle) {
    $currentPassport = '';
    while (($line = fgets($handle)) !== false) {
        if (trim($line) == "")
        {
            //echo $currentPassport;

            $currentPassport = explode("\n", $currentPassport);
            $t = '';
            foreach ($currentPassport as $curr)
            {
                $t .= $curr . ' ';
            }
            $tab[] = trim($t);
            $currentPassport = '';
        }
        else
        {
            $currentPassport .= $line;
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

$required = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'];
$res = 0;
foreach($tab as $passport)
{
    $count = 0;
    $fields = explode(' ', $passport);
   // $count = count($fields);
    foreach($fields as $field)
    {
        $hasCid = false;
        $fieldT = explode(':', $field);
        if ($fieldT[0] == 'cid')
        {
            $hasCid = true;
        }
        
        if (in_array($fieldT[0], $required))
        {
            $count++;
        }
    }

    if (!$hasCid)
    {
        $count++;
    }
    if ($count >= 8)
    {
        $res ++;
    }   
}

echo $res;

//var_dump(explode("\n", $tab[0]));
echo "\n-------------\n";



//test($res);
