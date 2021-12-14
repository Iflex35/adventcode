<?php


    $handle = fopen("test9.txt", "r");
    $tab = [];
    $res = 0;
    $x = 0;
    if ($handle) {
        
        while (($line = fgets($handle)) !== false) 
        {
            $lineString = trim(preg_replace('/\s\s+/', ' ', $line));
            $x_axe = str_split($lineString);

            $y = 0;
            $tab[$x] = [];
            foreach ($x_axe as $point)
            {
                $value_point = intval($point);
                $tab[$x][$y] = [];
                $tab[$x][$y]['bassin'] = 0;
                $tab[$x][$y]['value']  = $value_point;
                if ($value_point == 9)
                {
                    $tab[$x][$y]['bassin'] = -1;
                }
                $y++;
            }
            $x ++;
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
    
    $nbBassin = 1;
    $bassins = [];
    foreach ($tab as $x => $x_axe)
    {
        foreach ($x_axe as $yKey => $y)
        {   

                $bassinSize = 0;
               // echo '-----------------------------------------------------' . "\n";

    
                extendBassin($nbBassin,  $x, $yKey, $bassinSize, $tab); 
                if ($bassinSize)
                {
                    $bassins[] = $bassinSize;
                    if ($bassinSize)
                    {
                        echo $bassinSize . "\n";
                    }
                }         

            
        }
    }
    rsort($bassins);
    $res = 1;
    for($i = 0; $i < 3 ; $i++)
    {
        $res = $res * $bassins[$i];
    }



    function extendBassin(&$nbBassin,  $coordX, $coordY, &$size, &$tab)
    {
        
        if ($tab[$coordX][$coordY]['bassin'] == 0)
        {
           // echo 'x : ' . $coordX . ' ; y : ' . $coordY . ' => value = ' . $tab[$coordX][$coordY]['value'] . ' || bassin = ' .  $tab[$coordX][$coordY]['bassin'] . "\n";
            $tab[$coordX][$coordY]['bassin'] = $nbBassin;
            $size ++;
            $valueN = $tab[$coordX][$coordY]['value'] - 1;
            $valueP = $tab[$coordX][$coordY]['value'] + 1;
            
            $inBassinRight = isset($tab[$coordX][$coordY +1]) &&  (($tab[$coordX][$coordY +1]['value'] >= $valueN) || ($tab[$coordX][$coordY +1]['value'] <= $valueP));
            if ($inBassinRight)
            {
                extendBassin($nbBassin, $coordX, $coordY + 1, $size, $tab);
            }

            //left
            $inBassinLeft = isset($tab[$coordX][$coordY -1]) &&  (($tab[$coordX][$coordY -1]['value'] >= $valueN) || ($tab[$coordX][$coordY -1]['value']  <= $valueP));
            if ($inBassinLeft)
            {
                extendBassin($nbBassin, $coordX, $coordY - 1,  $size, $tab);
            }

            //up
            $inBassinLeft = isset($tab[$coordX+1][$coordY]) &&  (($tab[$coordX+1][$coordY]['value'] >= $valueN) || ($tab[$coordX+1][$coordY ]['value']  <= $valueP));
            if ($inBassinLeft)
            {
                extendBassin($nbBassin, $coordX+1, $coordY , $size, $tab);
            }

            //down
            $inBassinLeft = isset($tab[$coordX-1][$coordY]) &&  (($tab[$coordX-1][$coordY]['value'] >= $valueN) || ($tab[$coordX-1][$coordY]['value']  <= $valueP));
            if ($inBassinLeft)
            {
                extendBassin($nbBassin, $coordX-1, $coordY , $size, $tab);
            }
        }
        else
        {
            return 0;
        }
        return $size;

    }
  
    // echo $bassins[0]. "\n";
    // echo $bassins[1]. "\n";
    // echo $bassins[2]. "\n";
    echo $res . "\n";

    //var_dump(explode("\n", $tab[0]));
    echo "\n-------------\n";



    //test($res);

