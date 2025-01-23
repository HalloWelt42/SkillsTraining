<?php

// https://leetcode.com/problems/number-of-recent-calls 933
class RecentCounter {
    private $requests;

    public function __construct() {
        $this->requests = []; // Liste, um Zeitstempel der Anfragen zu speichern
    }

    /**
     * @param Integer $t
     * @return Integer
     */
    public function ping($t) {
        // Neue Anfrage hinzufügen
        $this->requests[] = $t;

        // Entferne alle Anfragen, die außerhalb des Zeitfensters liegen
        while ($this->requests[0] < $t - 3000) {
            array_shift($this->requests); // Entfernt die älteste Anfrage
        }

        // Anzahl der verbleibenden Anfragen zurückgeben
        return count($this->requests);
    }
}

// Testfälle
$recentCounter = new RecentCounter();
echo $recentCounter->ping(1) . PHP_EOL;    // 1
echo $recentCounter->ping(100) .PHP_EOL;  // 2
echo $recentCounter->ping(3001) . PHP_EOL; // 3
echo $recentCounter->ping(3002) . PHP_EOL; // 3
