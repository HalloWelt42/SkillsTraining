# 🛠️ Code Challenge Runner

Ein flexibles PHP-Skript, mit dem Sie verschiedene Code-Challenges ausführen können, die in einem Ordner organisiert sind. Navigieren Sie durch ein Menü, wählen Sie eine Challenge aus, und führen Sie die Lösung direkt aus.

---

## 🚀 Features

- Automatisches Erkennen von Challenges im Ordner `challenges`.
- Unterstützung für beliebig viele Challenges, inklusive Seitennavigation.
- Farbcodiertes, benutzerfreundliches CLI-Interface.
- Direktes Ausführen einer Challenge durch Angabe einer Challenge-ID.
- Flexible Erweiterbarkeit durch Hinzufügen neuer Challenges.

---

## 🚀 Installation

**Projekt klonen oder herunterladen**  
```bash
git clone <dein-repo-link>
cd SkillsTraining/main
```

**Ordnerstruktur anlegen**  
Erstelle einen Ordner namens `codechallenges/` und füge deine Challenges hinzu.  
Jede Challenge muss eine Datei namens `solution.php` enthalten.

```plaintext
main/
├── cmd/
│   ├── ChallengeRunner.php
│   ├── CodeChallengeManager.php
├── challenges/
│   ├── Challenge1/
│   │   └── solution.php
│   ├── Challenge2/
│   │   └── solution.php
├── run.php
└── README.md
```

**Skript ausführen**  
```bash
php run.php
```

---

## ✨ Beispiel einer Konsolen-Ausgabe

### Menü
```plaintext
====================================
 Code-Challenges Menü (Seite 1 von 2)
====================================
 [1] - Challenge1
 [2] - Challenge2
 [3] - Challenge3
====================================
 [n] - Nächste Seite
 [p] - Vorherige Seite
 [0] - Beenden
====================================
Hinweis: Direkt ausführen mit: php run.php <ID>
====================================
Wähle eine Option:
```

### Ausgabe einer Challenge
```plaintext
Starte: Challenge1
------------------------------------
Ergebnis der Lösung:
Hallo, dies ist eine Beispielausgabe!
------------------------------------
Drücken Sie [Enter], um zurück zum Menü zu gelangen.
```

---

## 🖥️ Verwendung

**Menü aufrufen**  
Einfach das Skript ausführen:
```bash
php run.php
```
Das Menü zeigt alle verfügbaren Challenges an, sortiert nach ihrem Erstellungsdatum. Navigiere durch die Seiten oder wähle eine Challenge mit der entsprechenden Nummer.

**Direkt ausführen**  
Wenn du die ID einer Challenge kennst, kannst du sie direkt ausführen:
```bash
php run.php 1
```

---

## 📂 Hinzufügen neuer Challenges

Erstelle einen neuen Ordner in `codechallenges/`. Der Ordnername sollte dem Namen der Challenge entsprechen:
```bash
mkdir codechallenges/my_new_challenge
```

Füge eine Datei namens `solution.php` in diesen Ordner ein:
```php
<?php
echo "Hier kommt die Lösung deiner Challenge!";
?>
```

Die neue Challenge wird automatisch erkannt, wenn du das Skript ausführst. 🎉

---

## ⚙️ Verwendung mit GitHub Codespaces

GitHub Codespaces ermöglicht Ihnen, das Projekt in einer cloudbasierten Entwicklungsumgebung ohne lokale Installation auszuführen.

**Schritte zur Einrichtung**  
- Öffne das Repository in GitHub.
- Klicke auf **`Code`** und wähle **`Codespaces`**.
- Erstelle einen neuen Codespace über **`Create codespace on main`**.
- Warte, bis die Umgebung geladen ist, und öffne ein Terminal.
- Führe das Skript aus:
  ```bash
  php run.php
  ```

---

## 🛠️ Funktionsweise des Skripts

Das Skript durchsucht den `codechallenges/`-Ordner nach Unterordnern, die eine Datei namens `solution.php` enthalten. Diese werden anhand des Erstellungsdatums sortiert und im Menü angezeigt.  
Durch Eingabe der entsprechenden Nummer kann die Challenge gestartet werden. Mit zusätzlichen Optionen (`n`, `p`) können Seiten navigiert werden.

---

## ⚙️ Anforderungen

- PHP 7.4 oder höher
- Terminal/Kommandozeile

---

## 📜 Lizenz

Dieses Projekt ist lizenziert unter, siehe [LICENSE](./LICENSE) für weitere Details.

---

## 🌟 Viel Spaß beim Coden!

💡 **Tipp:** Dieses Skript ist perfekt für Übungseinheiten oder Coding-Katas geeignet. Einfach eine neue Challenge hinzufügen und loslegen! 🎉