<?php

/**
 * Die Klasse ChallengeRunner steuert den Ablauf der Code-Challenges.
 * Sie ermöglicht das Navigieren durch eine Liste von Challenges, 
 * das Auswählen und Ausführen einzelner Challenges sowie das Beenden des Programms.
 */
class ChallengeRunner
{
    /**
     * Hauptmethode der Klasse, die die Navigation und Ausführung von Code-Challenges steuert.
     */
    public function run(): void
    {
        // Instanziierung des CodeChallengeManagers, der die Challenges verwaltet
        $manager = new CodeChallengeManager();

        // Abrufen aller verfügbaren Challenges
        $challenges = $manager->getChallenges();

        // Überprüfen, ob Challenges vorhanden sind
        if (empty($challenges)) {
            echo "Keine Code-Challenges gefunden.\n"; // Nachricht bei fehlenden Challenges
            return; // Programm beenden
        }

        // Zugriff auf globale Variable $argv für Befehlszeilenargumente
        global $argv;

        // Überprüfen, ob eine Challenge-ID als Argument übergeben wurde
        if (isset($argv[1])) {
            $challengeId = (int)$argv[1]; // Argument in eine Ganzzahl umwandeln
            $manager->runChallengeById($challenges, $challengeId); // Challenge ausführen
            return; // Programm beenden, da Challenge ausgeführt wurde
        }

        // Startseite des Menüs
        $page = 1;

        // Schleife, um das Menü und die Benutzerinteraktionen zu steuern
        do {
            // Aktuelle Seite des Menüs anzeigen
            echo $manager->showMenu($challenges, $page);

            // Benutzereingabe aus der Konsole lesen
            $choice = trim(fgets(STDIN));

            // Abbruchbedingung: Eingabe "0" beendet das Programm
            if ($choice === "0") {
                echo "Programm beendet. Auf Wiedersehen!\n"; // Abschiedsnachricht
                break; // Schleife verlassen
            }

            // Navigation zur nächsten Seite
            if ($choice === 'n') {
                $totalChallenges = count($challenges); // Gesamtanzahl der Challenges abrufen
                if ($page * $manager->itemsPerPage < $totalChallenges) {
                    $page++; // Zur nächsten Seite wechseln
                } else {
                    echo "Sie sind bereits auf der letzten Seite.\n"; // Nachricht bei letzter Seite
                }
                continue; // Nächste Iteration der Schleife
            }

            // Navigation zur vorherigen Seite
            if ($choice === 'p') {
                if ($page > 1) {
                    $page--; // Zur vorherigen Seite wechseln
                } else {
                    echo "Sie sind bereits auf der ersten Seite.\n"; // Nachricht bei erster Seite
                }
                continue; // Nächste Iteration der Schleife
            }

            // Auswählen einer Challenge basierend auf der Benutzereingabe
            $index = (int)$choice - 1; // Eingabe in einen Index umwandeln (Benutzer zählt ab 1)
            if (isset($challenges[$index])) {
                $selectedChallenge = $challenges[$index]; // Ausgewählte Challenge abrufen
                $solutionPath = $manager->baseDir . $selectedChallenge . '/solution.php'; // Pfad zur Lösung

                // Nachricht über die auszuführende Challenge
                echo "Starte: $selectedChallenge\n";

                // Einbinden und Ausführen der Lösung
                include $solutionPath;

                // Trenner und Nachricht nach der Ausführung
                echo "\n" . str_repeat('-', 36) . "\n";
                echo "Drücken Sie [Enter], um zurück zum Menü zu gelangen.";
                fgets(STDIN); // Warten auf Benutzereingabe
            } else {
                // Nachricht bei ungültiger Auswahl
                echo "Ungültige Auswahl. Bitte versuchen Sie es erneut.\n";
            }
        } while (true); // Endlos-Schleife, bis der Benutzer das Programm beendet
    }
}
