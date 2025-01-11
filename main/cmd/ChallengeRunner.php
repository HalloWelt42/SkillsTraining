<?php

class ChallengeRunner
{
    public function run(): void
    {
        $manager = new CodeChallengeManager();
        $challenges = $manager->getChallenges();

        if (empty($challenges)) {
            echo "Keine Code-Challenges gefunden.\n";
            return;
        }

        global $argv;
        if (isset($argv[1])) {
            $challengeId = (int)$argv[1];
            $manager->runChallengeById($challenges, $challengeId);
            return;
        }

        $page = 1;
        do {
            echo $manager->showMenu($challenges, $page);

            $choice = trim(fgets(STDIN));

            if ($choice === "0") {
                echo "Programm beendet. Auf Wiedersehen!\n";
                break;
            }

            if ($choice === 'n') {
                $totalChallenges = count($challenges);
                if ($page * $manager->itemsPerPage < $totalChallenges) {
                    $page++;
                } else {
                    echo "Sie sind bereits auf der letzten Seite.\n";
                }
                continue;
            }

            if ($choice === 'p') {
                if ($page > 1) {
                    $page--;
                } else {
                    echo "Sie sind bereits auf der ersten Seite.\n";
                }
                continue;
            }

            $index = (int)$choice - 1;
            if (isset($challenges[$index])) {
                $selectedChallenge = $challenges[$index];
                $solutionPath = $manager->baseDir . $selectedChallenge . '/solution.php';

                echo "Starte: $selectedChallenge\n";
                include $solutionPath;

                echo "\n" . str_repeat('-', 36) . "\n";
                echo "Drücken Sie [Enter], um zurück zum Menü zu gelangen.";
                fgets(STDIN);
            } else {
                echo "Ungültige Auswahl. Bitte versuchen Sie es erneut.\n";
            }
        } while (true);
    }
}
