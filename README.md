
# 🛠️ Code Challenge Runner

Ein praktisches PHP-Skript zur Organisation und Ausführung von **Code-Challenges**. 🚀  
Es bietet ein einfaches **Kommandozeilen-Menü**, in dem du alle vorhandenen Challenges anzeigen und direkt ausführen kannst.

---

## 📋 Features

- 📂 **Dynamische Ordnerstruktur**: Neue Challenges werden automatisch erkannt.  
- 📑 **Paginierte Anzeige**: Auch bei vielen Challenges bleibt die Übersicht erhalten.  
- 🎯 **Direktausführung per ID**: Führe eine Challenge direkt aus, ohne das Menü aufzurufen.  
- 🕒 **Sortierung**: Die zuletzt erstellte Challenge steht immer ganz oben.  

---

## 🚀 Installation

1. **Projekt klonen oder herunterladen**:
   ```bash
   git clone <dein-repo-link>
   cd SkillsTraining/main
   ```

2. **Ordnerstruktur anlegen**:  
   Erstelle einen Ordner namens `codechallenges/` und füge deine Challenges hinzu.  
   Jede Challenge muss eine Datei namens `solution.php` enthalten.

   ```bash
   codechallenges/
   ├── challenge1/
   │   └── solution.php
   ├── challenge2/
   │   └── solution.php
   ```

3. **Skript ausführen**:
   ```bash
   php run.php
   ```

---

## ✨ Beispiel einer Konsolen-Ausgabe

### **Menü:**
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

### **Ausgabe einer Challenge:**
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

### **1. Menü aufrufen**
Einfach das Skript ausführen:
```bash
php run.php
```

Das Menü zeigt alle verfügbaren Challenges an, sortiert nach ihrem Erstellungsdatum. Navigiere durch die Seiten oder wähle eine Challenge mit der entsprechenden Nummer.

### **2. Direkt ausführen**
Wenn du die ID einer Challenge kennst, kannst du sie direkt ausführen:
```bash
php run.php 1
```

---

## 📂 Hinzufügen neuer Challenges

1. Erstelle einen neuen Ordner in `codechallenges/`. Der Ordnername sollte dem Namen der Challenge entsprechen:
   ```bash
   mkdir codechallenges/my_new_challenge
   ```

2. Füge eine Datei namens `solution.php` in diesen Ordner ein:
   ```php
   <?php
   echo "Hier kommt die Lösung deiner Challenge!";
   ?>
   ```

3. Die neue Challenge wird automatisch erkannt, wenn du das Skript ausführst. 🎉

---

## 🛠️ Funktionsweise des Skripts

1. **Dynamisches Scannen**:  
   Das Skript durchsucht den `codechallenges/`-Ordner nach Unterordnern, die eine Datei namens `solution.php` enthalten.

2. **Sortierung nach Erstellungsdatum**:  
   Die Challenges werden basierend auf dem Erstellungsdatum ihres Ordners sortiert (neueste zuerst).

3. **Anzeige im Menü**:  
   Eine paginierte Liste der Challenges wird in der Konsole angezeigt. Der Benutzer kann navigieren oder eine Challenge ausführen.

4. **Direkte Ausführung**:  
   Falls eine ID über die Kommandozeile übergeben wird, startet das Skript die entsprechende Challenge direkt.

---

## ⚙️ Anforderungen

- PHP 7.4 oder höher
- Terminal/Kommandozeile

---

## 📜 Lizenz

Dieses Projekt ist lizenziert unter der **MIT-Lizenz**. Siehe die [LICENSE](./LICENSE) Datei für weitere Details.

---

## 🌟 Viel Spaß beim Coden!

💡 **Tipp:** Dieses Skript ist perfekt für Übungseinheiten oder Coding-Katas geeignet. Einfach eine neue Challenge hinzufügen und loslegen! 🎉