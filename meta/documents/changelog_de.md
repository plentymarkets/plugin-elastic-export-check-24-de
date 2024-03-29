# Release Notes für Elastic Export Check24.de

## v1.3.1 (2022-05-31)
### Fixed
- Ein Fehler im Zusammenhang mit PHP8 wurde behoben.

## v1.3.0 (2022-05-26)

### Geändert
- UPDATE - Zusätzliche Updates für Kompatibilität mit PHP 8.

## v1.2.9 (2021-10-12)

### Geändert
- Kleine strukturelle Anpassung.

## v1.2.8 (2021-04-08)

### Behoben
Format **Check24DE Fashion**:
- Beim Export wurde nicht erkannt, dass bereits eine SKU für Check24 mit der Account-ID 0 existierte, wenn in der Formateinstellung eine andere Herkunft gewählt war.

## v1.2.7 (2021-03-29)

### Behoben
Format **Check24DE Fashion**:
- Für das Generieren der SKU wird die Account-ID nicht mehr aus den Format-Einstellungen übernommen. Es ist aktuell nicht möglich, mehere Accounts zu erstellen. Deshalb konnten die Einstellungen zu Fehlern führen. Die Account-ID ist standardmäßig 0.
- Es führt nicht mehr zu einem Fehler, wenn das Modell an der Variante leer ist.

## v1.2.6 (2021-01-21)

### Geändert
- Die Performance des Exportformats wurde verbessert.

## v1.2.5 (2019-12-16)

### Geändert
- Der User Guide für das Format **Check24DE Fashion** wurde angepasst.

## v1.2.4 (2019-10-17)

### Behoben
Format **Check24DE Fashion**:
- Korrektur eines Schreibfehlers im User Guide-Kapitel **"3.2 Verfügbare Spalten des Formats Check24DE Fashion"**.
Die Spaltenbezeichnung und Merkmalverknüpfung **Kategoriepfad** war falsch. Stattdessen muss es **Kategorie-Pfad** heißen.

## v1.2.3 (2019-09-20)

### Behoben
Format **Check24DE Fashion**:
- Wenn es beim Anlegen oder Aktualisieren einer SKU für eine Variante zu einem Fehler kommt, wird dieser Fehler nun gelogged und die Variante trotzdem exportiert.

## v1.2.2 (2019-09-17)

### Geändert
Format **Check24DE Fashion**:
- Wenn Bilder mit der Variante verknüpft sind, werden nur diese Bilder exportiert. Ansonsten werden alle Bilder des Artikels exportiert.

### Behoben
Format **Check24DE Fashion**:
- Bilder werden jetzt in der Reihenfolge gemäß der gesetzten Position exportiert.

## v1.2.1 (2019-09-16)

### Geändert
Format **Check24DE Fashion**:
- Statt nur Bilder zu exportieren, die mit der Variante verknüpft sind, gilt dies nun nur noch für Varianten mit Farbattribut. Für alle anderen Varianten werden alle Bilder exportiert.

## v1.2.0 (2019-09-10)

### Hinzugefügt
- Das Format **Check24DE Fashion** wurde hinzugefügt. Das Format kann verwendet werden, um Produkte der **Fashion**-Kategorie bei Check24 anzulegen. Weitere Informationen zu dem Format findest du im **User Guide** in der **Beschreibung**.

## v1.1.9 (2019-08-23)

### Behoben
- Versandkosten werden nicht mehr leer übertragen, wenn die Variante versandkostenfrei ist.

## v1.1.8 (2019-02-14)

### Behoben
- Bildpositionen werden beim Übertragen der Bild-URL berücksichtigt.

## v1.1.7 (2019-01-21)

### Geändert
- Ein fehlerhafter Link im User Guide wurde korrigiert.

## v1.1.6 (2018-07-11)

### Geändert
- Ein fehlerhafter Link im User Guide wurde korrigiert.

## v1.1.5 (2018-05-04)

### Hinzugefügt
- Die Tabellen im User Guide wurden ergänzt.
- Informationen über das Preisvergleichsportal wurden hinzugefügt.

## v1.1.4 (2018-04-30)

### Geändert
- Laravel 5.5 Update.

## v1.1.3 (2018-03-28)

### Geändert
- Die Klasse FiltrationService übernimmt die Filtrierung der Varianten.
- Vorschaubilder aktualisiert.

## v1.1.2 (2018-02-16)

### Geändert
- Plugin-Kurzbeschreibung wurde angepasst.

## v1.1.1 (2018-01-23)

### Behoben
- Es wurde ein Fehler behoben, der dazu geführt hat, dass die Versandpreise nicht exportiert wurden.

## v1.1.0 (2017-12-28)

### Hinzugefügt
- Das Plugin berücksichtigt die neuen Felder "Bestandspuffer", "Bestand für Varianten ohne Bestandsbeschränkung" und "Bestand für Varianten ohne Bestandsführung".

## v1.0.7 (2017-09-27)

### Geändert
- Der User Guide wurde aktualisiert.
- Die Performance wurde verbessert.

## v1.0.6 (2017-07-11)

### Geändert
- Das Plugin Elastic Export ist nun Voraussetzung zur Nutzung des Pluginformats Check24DE.

### Behoben
- Es wurde ein Fehler behoben, der dazu geführt hat, dass bei dem Barcode die Marktplatzverfügbarkeit ignoriert wurde.
- Es wurde ein Fehler behoben, bei dem der Bestand nicht korrekt ausgewertet wurde.
- Es wurde ein Fehler behoben, bei dem Varianten nicht in der richtigen Reihenfolge gelistet wurden.
- Es wurde ein Fehler behoben, der dazu geführt hat, dass das Exportformat Texte in der falschen Sprache exportierte.

## v1.0.5 (2017-03-22)

### Behoben
- Es wird nun ein anderes Feld genutzt um die Bild-URLs auszulesen für Plugins die elastic search benutzen.

## v1.0.4 (2017-03-20)

### Geändert
- Aufruf der richtigen ItemDataLayer-Klasse geändert.

## v1.0.3 (2017-03-13)

### Hinzugefügt
- Marketplace Namen hinzugefügt.

### Geändert
- Plugin Icons aktualisiert.

## v1.0.2 (2017-03-03)

### Geändert
- Die ResultFields wurden angepasst, sodass der imageMutator nicht mehr greift falls "ALLE" als Referrer ausgewählt wurde.

## v1.0.1 (2017-03-01)

### Geändert
- Screenshot aktualisiert.

## v1.0.0 (2017-02-20)

### Hinzugefügt
- Initiale Plugin-Dateien hinzugefügt.
