<?php 
require_once __DIR__ . './../main/config.php';

/**
 * teilweise mit GPT generiert
 */

// Basisordner für die Code-Challenges
$challengesDir = 'codechallenges/';

// Anzahl der Einträge pro Seite
$itemsPerPage = 10;

// Alle Challenge-Ordner auslesen und nach Änderungsdatum sortieren
function getChallenges($dir)
{
    $challenges = [];
    foreach (scandir($dir) as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . $item;
        if (is_dir($path) && file_exists($path . '/solution.php')) {
            $challenges[$item] = filemtime($path);
        }
    }

    // Sortiere die Challenges nach Änderungsdatum (absteigend)
    arsort($challenges);

    // Rückgabe nur der Challenge-Namen (Keys)
    return array_keys($challenges);
}

// Menü anzeigen (mit Paginierung)
function showMenu($challenges, $page, $itemsPerPage)
{
    $totalChallenges = count($challenges);
    $totalPages = ceil($totalChallenges / $itemsPerPage);
    $start = ($page - 1) * $itemsPerPage;
    $end = min($start + $itemsPerPage, $totalChallenges);

    echo "=======================================================\n";
    echo "       Code-Challenges Menü (Seite $page von $totalPages)\n";
    echo "=======================================================\n";

    for ($i = $start; $i < $end; $i++) {
        $uniqueId = $i + 1; // Eindeutige ID
        echo " [$uniqueId] - " . $challenges[$i] . "\n";
    }

    echo "=======================================================\n";
    echo " [n] - Nächste Seite\n";
    echo " [p] - Vorherige Seite\n";
    echo " [0] - Beenden\n";
    echo "=======================================================\n";
    echo "Hinweis: Sie können eine Challenge direkt ausführen mit:\n";
    echo " php run.php <Challenge-ID>\n";
    echo "=======================================================\n";
    echo "Bitte wählen Sie eine Aufgabe (0-" . count($challenges) . "): ";
}

// Hauptprogramm
$challenges = getChallenges($challengesDir);

if (empty($challenges)) {
    echo "Keine Code-Challenges gefunden.\n";
    exit(1);
}

// Direktaufruf mit Challenge-ID
if (isset($argv[1])) {
    $challengeId = (int)$argv[1] - 1;

    if (isset($challenges[$challengeId])) {
        $selectedChallenge = $challenges[$challengeId];
        $solutionPath = $challengesDir . $selectedChallenge . '/solution.php';

        echo "Starte direkt: $selectedChallenge\n";
        include $solutionPath;
        exit(0);
    } else {
        echo "Ungültige Challenge-ID: {$argv[1]}\n";
        exit(1);
    }
}

$page = 1;
do {
    showMenu($challenges, $page, $itemsPerPage);

    // Benutzereingabe
    $choice = trim(fgets(STDIN));

    // Beenden
    if ($choice === "0") {
        echo "Programm beendet. Auf Wiedersehen!\n";
        break;
    }

    // Nächste Seite
    if ($choice === 'n') {
        if ($page * $itemsPerPage < count($challenges)) {
            $page++;
        } else {
            echo "Sie sind bereits auf der letzten Seite.\n";
        }
        continue;
    }

    // Vorherige Seite
    if ($choice === 'p') {
        if ($page > 1) {
            $page--;
        } else {
            echo "Sie sind bereits auf der ersten Seite.\n";
        }
        continue;
    }

    // Verarbeite Auswahl
    $index = (int)$choice - 1;
    if (isset($challenges[$index])) {
        $selectedChallenge = $challenges[$index];
        $solutionPath = $challengesDir . $selectedChallenge . '/solution.php';

        echo "Starte: $selectedChallenge\n";

        // Lösung ausführen
        include $solutionPath;

        echo "\n-------------------------------------------------------\n";
        echo "Drücken Sie [Enter], um zurück zum Menü zu gelangen.";
        fgets(STDIN);
    } else {
        echo "Ungültige Auswahl. Bitte versuchen Sie es erneut.\n";
    }

} while (true);
