<?php

$handle = fopen("test8.txt", "r");
$max = 0;
$tab = [];
$fiveDigits = [];
$sixDigits = [];
$maxval = 0;
$res = 0;
if ($handle) {
    
    while (($line = fgets($handle)) !== false) 
    {
        $lineString = trim(preg_replace('/\s\s+/', ' ', $line));
        $arr = explode('|', $lineString);
        $output_values = $arr[0];
        $output_values_array = explode(' ', $output_values);

        $one = null;
        $four = null;
        $seven = null;
        $eight = null;
        foreach($output_values_array as $output_digit)
        {
            switch (strlen($output_digit))
            {
                case 2:
                    $tab[1] = str_split($output_digit);
                    break;
                case 3:
                    $tab[7] = str_split($output_digit);
                    break;
                case 4:
                    $tab[4] = str_split($output_digit);
                    break;
                case 7:
                    $tab[8] = str_split($output_digit);
                    break;
                case 5:
                    $fiveDigits[] = str_split($output_digit);
                    break;
                case 6:
                    $sixDigits[] = str_split($output_digit);
                    break;
                default:
                    break;
            }
        }
        $pattern = getCode($tab, $sixDigits, $fiveDigits);

        $describe_output_code = getOuputCode($pattern, explode(' ', $arr[1]));
        $res += intval($describe_output_code);
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


function getCode($tab, $sixDigits_array, $fiveDigits_array)
{

    // 9
    foreach($sixDigits_array as $keySix => $sixDigits)
    {
        $isNine = true;
        foreach($tab[4] as $fourDigit)
        {
            if (!in_array($fourDigit, $sixDigits))
            {
                $isNine = false;
                break;
            }
        }
        if ($isNine)
        {
            $tab[9] = $sixDigits;
            unset($sixDigits_array[$keySix]);
        }
    }

    // 6 - 0 
    foreach($sixDigits_array as $keySix => $sixDigits)
    {
        $isZero = true;
        foreach($tab[1] as $oneDigit)
        {
            if (!in_array($oneDigit, $sixDigits))
            {
                $isZero = false;
                break;
            }
        }
        if ($isZero)
        {
            $tab[0] = $sixDigits;
            unset($sixDigits_array[$keySix]);
        }
        else
        {
            $tab[6] = $sixDigits;
            unset($sixDigits_array[$keySix]);
        }
    }

    //--------------------------------------------
    //--------5 DIGITS ---------------------------
    //--------------------------------------------
    foreach($fiveDigits_array as $keyFive => $fiveDigits)
    {
        $isTree = true;
        foreach($tab[1] as $oneDigit)
        {
            if (!in_array($oneDigit, $fiveDigits))
            {
                $isTree = false;
            }
        }
        if ($isTree)
        {
            $tab[3] = $fiveDigits;
            unset($fiveDigits_array[$keyFive]);
        }

    }

    foreach($fiveDigits_array as $keyFive => $fiveDigits)
    {
        $isFive = true;
        foreach($fiveDigits as $fiveDigit)
        {
            if (!in_array($fiveDigit, $tab[6]))
            {
                $isFive = False;
            }
        }
        if (!$isFive)
        {
            $tab[2] = $fiveDigits;
            unset($fiveDigits_array[$keyFive]);
        }
        else
        {
            $tab[5] = $fiveDigits;
            unset($fiveDigits_array[$keyFive]);
        }

    }

    return $tab;

}

function getOuputCode($pattern, $output)
{
    $code = '';
    foreach($output as $output_digit)
    {
        if ($output_digit)
        {
            $val = '';
            switch (strlen($output_digit))
            {
                case 2:
                    $val = '1';
                    break;
                case 3: 
                    $val ='7';
                    break;
                case 4:
                    $val = '4';
                    break;
                case 7:
                    $val = '8';
                    break;
            }

            if (!$val)
            {
                foreach ($pattern as $digit => $tabDigit)
                {
                    if (!array_diff(str_split($output_digit), $tabDigit) && count(str_split($output_digit)) == count($tabDigit))
                    {
                        $val = strval($digit);
                        // var_dump($pattern);
                        // echo $digit . "\n";
                        // echo $output_digit . "\n";
                        // echo $val;die;
                    }
                }
            }
            if ($val == '')
            {
                var_dump( $pattern[5]);
                echo '_____________________' . "\n";
                var_dump(array_diff(str_split($output_digit), $pattern[5]));
            }
            $code .= $val;
        }
        

    }

    echo $code . "\n";
    return $code;
}

echo $res . "\n";

//var_dump(explode("\n", $tab[0]));
echo "\n-------------\n";



//test($res);
