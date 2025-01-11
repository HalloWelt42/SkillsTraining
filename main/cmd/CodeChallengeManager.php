<?php

class CodeChallengeManager
{
    public string $baseDir;
    public int $itemsPerPage;

    public function __construct(string $baseDir = 'codechallenges/', int $itemsPerPage = 10)
    {
        $this->baseDir = rtrim($baseDir, '/') . '/';
        $this->itemsPerPage = $itemsPerPage;
    }

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

    public function showMenu(array $challenges, int $page = 1): string
    {
        $totalChallenges = count($challenges);
        $totalPages = ceil($totalChallenges / $this->itemsPerPage);
        $start = ($page - 1) * $this->itemsPerPage;
        $end = min($start + $this->itemsPerPage, $totalChallenges);

        $menu = str_repeat('=', 36) . "\n";
        $menu .= " Code-Challenges Menü (Seite $page von $totalPages)\n";
        $menu .= str_repeat('=', 36) . "\n";

        for ($i = $start; $i < $end; $i++) {
            $uniqueId = $i + 1;
            $menu .= " [$uniqueId] - {$challenges[$i]}\n";
        }

        $menu .= str_repeat('=', 36) . "\n";
        $menu .= " [n] - Nächste Seite\n";
        $menu .= " [p] - Vorherige Seite\n";
        $menu .= " [0] - Beenden\n";
        $menu .= str_repeat('=', 36) . "\n";
        $menu .= "Hinweis: Direkt ausführen mit: php run.php <ID>\n";
        $menu .= str_repeat('=', 36) . "\n";

        return $menu;
    }

    public function runChallengeById(array $challenges, int $challengeId): void
    {
        $index = $challengeId - 1;
        if (isset($challenges[$index])) {
            $selectedChallenge = $challenges[$index];
            $solutionPath = $this->baseDir . $selectedChallenge . '/solution.php';

            echo "Starte: {$selectedChallenge}\n";
            include $solutionPath;
        } else {
            echo "Ungültige Challenge-ID: $challengeId\n";
        }
    }
}
