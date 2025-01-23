<?php

/**
 * Eine mögliche Strategie, um das Problem zu lösen, besteht darin, 
 * das erste Zeichen der Zeichenfolge ans Ende zu verschieben und 
 * dabei das erste gegenüberliegende Zeichen in der Folge zu entfernen. 
 * Hier ist ein Beispiel mit der Zeichenfolge 'DDRRR':
 * 
 * DDRRR – Das erste D wird nach hinten verschoben, 
 *          und das erste R wird entfernt.
 * DRRD – Das nächste D wird nach hinten verschoben, 
 *          und erneut wird das erste R entfernt.
 * RDD – Jetzt wird das erste R nach hinten verschoben, 
 *          und das erste D wird entfernt.
 * DR – Das verbleibende D wird nach hinten verschoben, 
 *          und das einzige R wird entfernt.
 * D – Übrig bleibt nur D, das somit gewinnt.
 * 
 * Diese Strategie eliminiert nach und nach gegensätzliche Zeichen, 
 * bis nur noch ein „Gewinner“ übrig bleibt.
 */

class Solution {

    /**
     * @param String $senate
     * @return String
     */
    function predictPartyVictory($senate) {
        $radiant = [];
        $dire = [];
        
        // Initialisiere die Warteschlangen
        for ($i = 0; $i < strlen($senate); $i++) {
            if ($senate[$i] === 'R') {
                $radiant[] = $i;
            } else {
                $dire[] = $i;
            }
        }
    
        // Simuliere den Wahlprozess
        $n = strlen($senate);
        while (!empty($radiant) && !empty($dire)) {
            $r = array_shift($radiant); // Nimm den vordersten Radiant
            $d = array_shift($dire);   // Nimm den vordersten Dire
            
            if ($r < $d) {
                // Radiant gewinnt, füge ihn am Ende hinzu
                $radiant[] = $r + $n;
            } else {
                // Dire gewinnt, füge ihn am Ende hinzu
                $dire[] = $d + $n;
            }
        }
    
        // Bestimme den Gewinner
        return empty($radiant) ? "Dire" : "Radiant";
    }
}


$test = new Solution();

foreach([
    'DDRRR'
] AS $val){
    print_r($test->predictPartyVictory($val));
}