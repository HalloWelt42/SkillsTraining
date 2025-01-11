<?php

/**
 * CodeChallengeManager
 * 
 * Diese Klasse verwaltet die Anzeige und Auswahl von Code-Challenges in der Konsole. 
 * Sie listet alle verfügbaren Challenges in einem definierten Verzeichnis und ermöglicht das Ausführen einer bestimmten Lösung.
 */
class CodeChallengeManager
{
    /**
     * Basisverzeichnis, in dem sich die Challenges befinden.
     * @var string
     */
    public string $baseDir;

    /**
     * Anzahl der Einträge pro Seite im Menü.
     * @var int
     */
    public int $itemsPerPage;

    /**
     * Konstruktor
     *
     * @param string $baseDir     Das Basisverzeichnis, in dem sich die Challenges befinden (Standard: 'codechallenges/').
     * @param int    $itemsPerPage Die Anzahl der Einträge pro Seite (Standard: 10).
     */
    public function __construct(string $baseDir = 'codechallenges/', int $itemsPerPage = 10)
    {
        $this->baseDir = rtrim($baseDir, '/') . '/';
        $this->itemsPerPage = $itemsPerPage;
    }

    /**
     * Gibt eine Liste aller verfügbaren Challenges zurück, sortiert nach dem Änderungsdatum.
     *
     * @return array Eine sortierte Liste von Challenge-Namen (jüngste zuerst).
     */
    public function getChallenges(): array
    {
        $challenges = [];
        foreach (scandir($this->baseDir) as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $path = $this->baseDir . $item;
            if (is_dir($path) && file_exists($path . '/solution.php')) {
                $challenges[$item] = filemtime($path);
            }
        }

        arsort($challenges);
        return array_keys($challenges);
    }

    /**
     * Zeigt das Menü der Code-Challenges an.
     *
     * @param array $challenges Die Liste der verfügbaren Challenges.
     * @param int   $page       Die aktuelle Seite des Menüs (Standard: 1).
     * 
     * @return string Gibt das formatierte Menü als String zurück.
     */
    public function showMenu(array $challenges, int $page = 1): string
    {
        $this->clearScreen();

        $totalChallenges = count($challenges);
        $totalPages = ceil($totalChallenges / $this->itemsPerPage);
        $start = ($page - 1) * $this->itemsPerPage;
        $end = min($start + $this->itemsPerPage, $totalChallenges);

        $darkGray = "\033[1;30m";
        $lightBlue = "\033[1;34m";
        $mediumGray = "\033[0;37m";
        $reset = "\033[0m";

        $menu = "{$darkGray}" . str_repeat('=', 36) . "{$reset}" . PHP_EOL;
        $menu .= " Code-Challenges Menü (Seite {$page} von {$totalPages})" . PHP_EOL;
        $menu .= "{$darkGray}" . str_repeat('=', 36) . "{$reset}" . PHP_EOL;

        for ($i = $start; $i < $end; $i++) {
            $uniqueId = $i + 1;
            $menu .= " {$lightBlue}[{$uniqueId}]{$reset} - {$challenges[$i]}" . PHP_EOL;
        }

        $menu .= "{$darkGray}" . str_repeat('=', 36) . "{$reset}" . PHP_EOL;
        $menu .= " {$lightBlue}[n]{$reset} - Nächste Seite" . PHP_EOL;
        $menu .= " {$lightBlue}[p]{$reset} - Vorherige Seite" . PHP_EOL;
        $menu .= " {$lightBlue}[0]{$reset} - Beenden" . PHP_EOL;
        $menu .= "{$darkGray}" . str_repeat('=', 36) . "{$reset}" . PHP_EOL;
        $menu .= "{$mediumGray}Hinweis: Direkt ausführen mit: php run.php <ID>{$reset}" . PHP_EOL;
        $menu .= "{$darkGray}" . str_repeat('=', 36) . "{$reset}" . PHP_EOL;

        return $menu;
    }

    /**
     * Führt die Challenge basierend auf ihrer ID aus.
     *
     * @param array $challenges Die Liste der verfügbaren Challenges.
     * @param int   $challengeId Die eindeutige ID der Challenge (1-basiert).
     */
    public function runChallengeById(array $challenges, int $challengeId): void
    {
        $index = $challengeId - 1;
        if (isset($challenges[$index])) {
            $selectedChallenge = $challenges[$index];
            $solutionPath = $this->baseDir . $selectedChallenge . '/solution.php';

            echo "Starte: {$selectedChallenge}" . PHP_EOL;
            include $solutionPath;
        } else {
            echo "\033[0;31mFehler: Ungültige Challenge-ID: {$challengeId}\033[0m" . PHP_EOL;
        }
    }

    /**
     * Löscht den Bildschirm in der Konsole, um die Ausgabe frisch anzuzeigen.
     */
    private function clearScreen(): void
    {
        echo "\033[H\033[J";
    }
}
