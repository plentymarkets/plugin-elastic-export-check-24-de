
# User Guide für das Elastic Export Check24.de Plugin

<div class="container-toc"></div>

## 1 Bei Check24.de registrieren

Check24.de ist ein Online-Vergleichsportal, das Verbrauchern bei der Suche nach dem für sie passenden Preis-/Leistungsumfang hilft. Auch du kannst auf dem Marktplatz Check24.de deine Artikel verkaufen.

Auf dem Marktplatz Check24 bietest du deine Artikel zum Verkauf an. Weitere Informationen zu diesem Marktplatz findest du auf der Handbuchseite [Check24 einrichten](https://knowledge.plentymarkets.com/maerkte/check24). Um das Plugin für Check24.de einzurichten, registriere dich zunächst als Händler.

## 2 Das Format Check24DE-Plugin 

### 2.1 Das Format Check24DE-Plugin in plentymarkets einrichten

Mit der Installation dieses Plugins erhältst du das Exportformat **Check24DE-Plugin**, mit dem du Daten über den elastischen Export zu Check24.de überträgst. Um dieses Format für den elastischen Export nutzen zu können, installiere zunächst das Plugin **Elastic Export** aus dem plentyMarketplace, wenn noch nicht geschehen. 

Sobald beide Plugins in deinem System installiert sind, kann das Exportformat **Check24DE-Plugin** erstellt werden. Weitere Informationen findest du auf der Handbuchseite [Elastischer Export](https://knowledge.plentymarkets.com/daten/daten-exportieren/elastischer-export).

Neues Exportformat erstellen:

1. Öffne das Menü **Daten » Elastischer Export**.
2. Klicke auf **Neuer Export**.
3. Nimm die Einstellungen vor. Beachte dazu die Erläuterungen in Tabelle 1.
4. **Speichere** die Einstellungen.<br/>
→ Eine ID für das Exportformat **Check24DE-Plugin** wird vergeben und das Exportformat erscheint in der Übersicht **Exporte**.

In der folgenden Tabelle findest du Hinweise zu den einzelnen Formateinstellungen und empfohlenen Artikelfiltern für das Format **Check24DE-Plugin**.

| **Einstellung**                                     | **Erläuterung** | 
| :---                                                | :--- |
| **Einstellungen**                                   | |
| **Name**                                            | Name eingeben. Unter diesem Namen erscheint das Exportformat in der Übersicht im Tab **Exporte**. |
| **Typ**                                             | Typ **Artikel** aus der Dropdown-Liste wählen. |
| **Format**                                          | **Check24DE-Plugin** wählen. |
| **Limit**                                           | Zahl eingeben. Wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen, wird die Ausgabedatei wird für 24 Stunden nicht noch einmal neu generiert, um Ressourcen zu sparen. Wenn mehr als 9999 Datensätze benötigt werden, muss die Option **Cache-Datei generieren** aktiv sein. |
| **Cache-Datei generieren**                          | Häkchen setzen, wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen. Um eine optimale Performance des elastischen Exports zu gewährleisten, darf diese Option bei maximal 20 Exportformaten aktiv sein. |
| **Bereitstellung**                                  | **URL** wählen. Mit dieser Option kann ein Token für die Authentifizierung generiert werden, damit ein externer Zugriff möglich ist. |
| **Token, URL**                                      | Wenn unter **Bereitstellung** die Option **URL** gewählt wurde, auf **Token generieren** klicken. Der Token wird dann automatisch eingetragen. Die URL wird automatisch eingetragen, wenn unter **Token** der Token generiert wurde. |
| **Dateiname**                                       | Der Dateiname muss auf **.csv** oder **.txt** enden, damit Check24.de die Datei erfolgreich importieren kann. |
| **Artikelfilter**                                   | |
| **Artikelfilter hinzufügen**                        | Artikelfilter aus der Dropdown-Liste wählen und auf **Hinzufügen** klicken. Standardmäßig sind keine Filter voreingestellt. Es ist möglich, alle Artikelfilter aus der Dropdown-Liste nacheinander hinzuzufügen.<br/> **Varianten** = **Alle übertragen** oder **Nur Hauptvarianten übertragen** wählen.<br/> **Märkte** = Einen, mehrere oder **ALLE** Märkte wählen. Die Verfügbarkeit muss für alle hier gewählten Märkte am Artikel hinterlegt sein. Andernfalls findet kein Export statt.<br/> **Währung** = Währung wählen.<br/> **Kategorie** = Aktivieren, damit der Artikel mit Kategorieverknüpfung übertragen wird. Es werden nur Artikel, die dieser Kategorie zugehören, übertragen.<br/> **Bild** = Aktivieren, damit der Artikel mit Bild übertragen wird. Es werden nur Artikel mit Bildern übertragen.<br/> **Mandant** = Mandant wählen.<br/> **Bestand** = Wählen, welche Bestände exportiert werden sollen.<br/> **Markierung 1 - 2** = Markierung wählen.<br/> **Hersteller** = Einen, mehrere oder **ALLE** Hersteller wählen.<br/> **Aktiv** = Nur aktive Varianten werden übertragen. |
| **Formateinstellungen**                             | |
| **Produkt-URL**                                     | Wählen, ob die URL des Artikels oder der Variante an das Preisportal übertragen wird. Varianten URLs können nur in Kombination mit dem Ceres Webshop übertragen werden. |
| **Mandant**                                         | Mandant wählen. Diese Einstellung wird für den URL-Aufbau und zum Filtern gültiger Verkaufspreise verwendet. |
| **URL-Parameter**                                   | Suffix für die Produkt-URL eingeben, wenn dies für den Export erforderlich ist. Die Produkt-URL wird dann um die eingegebene Zeichenkette erweitert, wenn weiter oben die Option **übertragen** für die Produkt-URL aktiviert wurde. |
| **Auftragsherkunft**                                | Aus der Dropdown-Liste die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll. Die Auftragsherkunft wird zum Filtern gültiger Verkaufspreise und Bilder verwendet. |
| **Marktplatzkonto**                                 | Marktplatzkonto aus der Dropdown-Liste wählen. Die Produkt-URL wird um die gewählte Auftragsherkunft erweitert, damit die Verkäufe später analysiert werden können. |
| **Sprache**                                         | Sprache aus der Dropdown-Liste wählen. |
| **Artikelname**                                     | **Name 1**, **Name 2** oder **Name 3** wählen. Die Namen sind im Tab **Texte** eines Artikels gespeichert. Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge des Artikelnamen beim Export vorgibt. |
| **Vorschautext**                                    | Diese Option ist für dieses Format nicht relevant. |
| **Beschreibung**                                    | Wählen, welcher Text als Beschreibungstext übertragen werden soll.<br/> Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge der Beschreibung beim Export vorgibt.<br/> Option **HTML-Tags entfernen** aktivieren, damit die HTML-Tags beim Export entfernt werden.<br/> Im Feld **Erlaubte HTML-Tags, kommagetrennt (def. Text)** optional die HTML-Tags eingeben, die beim Export erlaubt sind. Wenn mehrere Tags eingegeben werden, mit Komma trennen. |
| **Zielland**                                        | Zielland aus der Dropdown-Liste wählen. |
| **Barcode**                                         | ASIN, ISBN oder eine EAN aus der Dropdown-Liste wählen. Der gewählte Barcode muss mit der oben gewählten Auftragsherkunft verknüpft sein. Andernfalls wird der Barcode nicht exportiert. |
| **Bild**                                            | **Position 0** oder **Erstes Bild** wählen, um dieses Bild zu exportieren.<br/> **Position 0** = Ein Bild mit der Position 0 wird übertragen.<br/> **Erstes Bild** = Das erste Bild wird übertragen. |
| **Bildposition des Energieetiketts**                | Diese Option ist für dieses Format nicht relevant. |
| **Bestandspuffer**                                  | Der Bestandspuffer für Varianten mit der Beschränkung auf den Netto-Warenbestand. |
| **Bestand für Varianten ohne Bestandsbeschränkung** | Der Bestand für Varianten ohne Bestandsbeschränkung. |
| **Bestand für Varianten ohne Bestandsführung**      | Der Bestand für Varianten ohne Bestandsführung. |
| **Währung live umrechnen**                          | Aktivieren, damit der Preis je nach eingestelltem Lieferland in die Währung des Lieferlandes umgerechnet wird. Der Preis muss für die entsprechende Währung freigegeben sein. |
| **Verkaufspreis**                                   | Brutto- oder Nettopreis aus der Dropdown-Liste wählen. |
| **Angebotspreis**                                   | Diese Option ist für dieses Format nicht relevant. |
| **UVP**                                             | Diese Option ist für dieses Format nicht relevant. |
| **Versandkosten**                                   | Aktivieren, damit die Versandkosten aus der Konfiguration übernommen werden. Wenn die Option aktiviert ist, stehen in den beiden Dropdown-Listen Optionen für die Konfiguration und die Zahlungsart zur Verfügung. Option **Pauschale Versandkosten übertragen** aktivieren, damit die pauschalen Versandkosten übertragen werden. Wenn diese Option aktiviert ist, muss im Feld darunter ein Betrag eingegeben werden. |
| **MwSt.-Hinweis**                                   | Diese Option ist für dieses Format nicht relevant. |
| **Artikelverfügbarkeit**                            | Option **überschreiben** aktivieren und in die Felder **1** bis **10**, die die ID der Verfügbarkeit darstellen, Artikelverfügbarkeiten eintragen. Somit werden die Artikelverfügbarkeiten, die im Menü **System » Artikel » Verfügbarkeit** eingestellt wurden, überschrieben. |
       
_Tab. 1: Einstellungen für das Datenformat **Check24DE-Plugin**_

### 2.2 Verfügbare Spalten des Formats Check24DE-Plugin

| **Spaltenbezeichnung** | **Erläuterung** |
| :---                   | :--- |
| id                     | **Pflichtfeld**<br/> Die **SKU** der Variante für Check24.de. |
| manufacturer           | Der **Name des Herstellers** des Artikels. Der **Externe Name** unter **Einstellungen » Artikel »  Hersteller** wird bevorzugt, wenn vorhanden. |
| mpnr                   | Das **Modell** der Variante. |
| ean                    | **Pflichtfeld**<br/> Entsprechend der Formateinstellung **Barcode**. |
| name                   | **Pflichtfeld**<br/> Entsprechend der Formateinstellung **Artikelname**. |
| description            | Entsprechend der Formateinstellung **Beschreibung**. |
| category_path          | Der **Kategoriepfad der Standardkategorie** für den in den Formateinstellungen definierten **Mandanten**. |
| price                  | **Pflichtfeld**<br/> Der **Verkaufspreis**. |
| price_per_unit         | Die **Grundpreisinformation** im Format "Preis / Einheit". (Beispiel: 10,00 EUR / Kilogramm) |
| link                   | **Pflichtfeld**<br/> Der **URL-Pfad** des Artikels abhängig vom gewählten Mandanten in den Formateinstellungen. |
| image_url              | **Erlaubte Dateitypen:** jpg, gif, bmp, png<br/> Der **URL-Pfad** des ersten Artikelbilds entsprechend der Formateinstellung **Bild**. Variantenbilder werden vor Artikelbildern priorisiert. |
| delivery_time          | **Pflichtfeld**<br/> Der **Name der Artikelverfügbarkeit** unter **Einstellungen » Artikel » Artikelverfügbarkeit** oder die Übersetzung gemäß der Formateinstellung **Artikelverfügbarkeit überschreiben**. |
| delivery_cost          | Entsprechend der Formateinstellung **Versandkosten**. |
| pzn                    | Leer. |
| stock                  | Der **Netto-Warenbestand** der Variante. Bei Artikeln, die nicht auf den Netto-Warenbestand beschränkt sind, wird **999** übertragen. |
| weight                 | Das **Gewicht** wie unter **Artikel »  Artikel bearbeiten » Artikel öffnen » Variante öffnen »  Einstellungen »  Maße** definiert. |

_Tab. 2: Spalten des Datenformats **Check24DE-Plugin**_

## 3 Das Format Check24DE Fashion 

### 3.1 Das Format Check24DE Fashion in plentymarkets einrichten

Mit der Installation dieses Plugins erhältst du das Exportformat **Check24DE Fashion**, mit dem du Daten über den elastischen Export zu Check24.de überträgst. Um dieses Format für den elastischen Export nutzen zu können, installiere zunächst das Plugin **Elastic Export** aus dem plentyMarketplace, wenn noch nicht geschehen. 

Sobald beide Plugins in deinem System installiert sind, kann das Exportformat **Check24DE Fashion** erstellt werden. Weitere Informationen findest du auf der Handbuchseite [Elastischer Export](https://knowledge.plentymarkets.com/daten/daten-exportieren/elastischer-export).

Neues Exportformat erstellen:

1. Öffne das Menü **Daten » Elastischer Export**.
2. Klicke auf **Neuer Export**.
3. Nimm die Einstellungen vor. Beachte dazu die Erläuterungen in Tabelle 3.
4. **Speichere** die Einstellungen.<br/>
→ Eine ID für das Exportformat **Check24DE Fashion** wird vergeben und das Exportformat erscheint in der Übersicht **Exporte**.

In der folgenden Tabelle findest du Hinweise zu den einzelnen Formateinstellungen und empfohlenen Artikelfiltern für das Format **Check24DE Fashion**.

| **Einstellung**                                     | **Erläuterung** | 
| :---                                                | :--- |
| **Einstellungen**                                   | |
| **Name**                                            | Name eingeben. Unter diesem Namen erscheint das Exportformat in der Übersicht im Tab **Exporte**. |
| **Typ**                                             | Typ **Artikel** aus der Dropdown-Liste wählen. |
| **Format**                                          | **Check24DE Fashion** wählen. |
| **Limit**                                           | Zahl eingeben. Wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen, wird die Ausgabedatei wird für 24 Stunden nicht noch einmal neu generiert, um Ressourcen zu sparen. Wenn mehr mehr als 9999 Datensätze benötigt werden, muss die Option **Cache-Datei generieren** aktiv sein. |
| **Cache-Datei generieren**                          | Häkchen setzen, wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen. Um eine optimale Performance des elastischen Exports zu gewährleisten, darf diese Option bei maximal 20 Exportformaten aktiv sein. |
| **Bereitstellung**                                  | **URL** wählen. Mit dieser Option kann ein Token für die Authentifizierung generiert werden, damit ein externer Zugriff möglich ist. |
| **Token, URL**                                      | Wenn unter **Bereitstellung** die Option **URL** gewählt wurde, auf **Token generieren** klicken. Der Token wird dann automatisch eingetragen. Die URL wird automatisch eingetragen, wenn unter **Token** der Token generiert wurde. |
| **Dateiname**                                       | Der Dateiname muss auf **.csv** oder **.txt** enden, damit Check24.de die Datei erfolgreich importieren kann. |
| **Artikelfilter**                                   | |
| **Artikelfilter hinzufügen**                        | Artikelfilter aus der Dropdown-Liste wählen und auf **Hinzufügen** klicken. Standardmäßig sind keine Filter voreingestellt. Es ist möglich, alle Artikelfilter aus der Dropdown-Liste nacheinander hinzuzufügen.<br/> **Varianten** = **Alle übertragen** oder **Nur Hauptvarianten übertragen** wählen.<br/> **Märkte** = Einen, mehrere oder **ALLE** Märkte wählen. Die Verfügbarkeit muss für alle hier gewählten Märkte am Artikel hinterlegt sein. Andernfalls findet kein Export statt.<br/> **Währung** = Währung wählen.<br/> **Kategorie** = Aktivieren, damit der Artikel mit Kategorieverknüpfung übertragen wird. Es werden nur Artikel, die dieser Kategorie zugehören, übertragen.<br/> **Bild** = Aktivieren, damit der Artikel mit Bild übertragen wird. Es werden nur Artikel mit Bildern übertragen.<br/> **Mandant** = Mandant wählen.<br/> **Bestand** = Wählen, welche Bestände exportiert werden sollen.<br/> **Markierung 1 - 2** = Markierung wählen.<br/> **Hersteller** = Einen, mehrere oder **ALLE** Hersteller wählen.<br/> **Aktiv** = Nur aktive Varianten werden übertragen. |
| **Formateinstellungen**                             | |
| **Produkt-URL**                                     | Diese Option ist für dieses Format nicht relevant. |
| **Mandant**                                         | Mandant wählen. Diese Einstellung wird zum Filtern gültiger Verkaufspreise verwendet.  |
| **URL-Parameter**                                   | Diese Option ist für dieses Format nicht relevant. |
| **Auftragsherkunft**                                | Auftragsherkunft  aus der Dropdown-Liste wählen. Diese Einstellung wird zum Filtern gültiger Verkaufspreise verwendet. |
| **Marktplatzkonto**                                 | Marktplatzkonto aus der Dropdown-Liste wählen. Die Produkt-URL wird um die gewählte Auftragsherkunft erweitert, damit die Verkäufe später analysiert werden können. |
| **Sprache**                                         | Sprache aus der Dropdown-Liste wählen. |
| **Artikelname**                                     | **Name 1**, **Name 2** oder **Name 3** wählen. Die Namen sind im Tab **Texte** eines Artikels gespeichert. Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge des Artikelnamen beim Export vorgibt. |
| **Vorschautext**                                    | Wählen, welcher Text als Vorschautext übertragen werden soll.<br/> Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge der Beschreibung beim Export vorgibt.<br/> Option **HTML-Tags entfernen** aktivieren, damit die HTML-Tags beim Export entfernt werden.<br/> Im Feld **Erlaubte HTML-Tags, kommagetrennt (def. Text)** optional die HTML-Tags eingeben, die beim Export erlaubt sind. Wenn mehrere Tags eingegeben werden, mit Komma trennen. |
| **Beschreibung**                                    | Wählen, welcher Text als Beschreibungstext übertragen werden soll.<br/> Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge der Beschreibung beim Export vorgibt.<br/> Option **HTML-Tags entfernen** aktivieren, damit die HTML-Tags beim Export entfernt werden.<br/> Im Feld **Erlaubte HTML-Tags, kommagetrennt (def. Text)** optional die HTML-Tags eingeben, die beim Export erlaubt sind. Wenn mehrere Tags eingegeben werden, mit Komma trennen. |
| **Zielland**                                        | Zielland aus der Dropdown-Liste wählen. Diese Einstellung wird zum herausfiltern gültiger Verkaufspreise verwendet.|
| **Barcode**                                         | Eine EAN aus der Dropdown-Liste wählen. Der gewählte Barcode muss mit der oben gewählten Auftragsherkunft verknüpft sein. Andernfalls wird der Barcode nicht exportiert. |
| **Bild**                                            | **Position 0** oder **Erstes Bild** wählen, um dieses Bild zu exportieren.<br/> **Position 0** = Ein Bild mit der Position 0 wird übertragen.<br/> **Erstes Bild** = Das erste Bild wird übertragen. |
| **Bildposition des Energieetiketts**                | Diese Option ist für dieses Format nicht relevant. |
| **Bestandspuffer**                                  | Diese Option ist für dieses Format nicht relevant. |
| **Bestand für Varianten ohne Bestandsbeschränkung** | Diese Option ist für dieses Format nicht relevant. |
| **Bestand für Varianten ohne Bestandsführung**      | Diese Option ist für dieses Format nicht relevant. |
| **Währung live umrechnen**                          | Aktivieren, damit der Preis je nach eingestelltem Lieferland in die Währung des Lieferlandes umgerechnet wird. Der Preis muss für die entsprechende Währung freigegeben sein. |
| **Verkaufspreis**                                   | Diese Option ist für dieses Format nicht relevant. |
| **Angebotspreis**                                   | Diese Option ist für dieses Format nicht relevant. |
| **UVP**                                             | Aktivieren, wenn ein gültiger Verkaufspreis vom Typ **UVP** übertragen werden soll. |
| **Versandkosten**                                   | Diese Option ist für dieses Format nicht relevant. |
| **MwSt.-Hinweis**                                   | Diese Option ist für dieses Format nicht relevant. |
| **Artikelverfügbarkeit**                            | Diese Option ist für dieses Format nicht relevant. |
       
_Tab. 3: Einstellungen für das Datenformat **Check24DE Fashion**_

### 3.2 Verfügbare Spalten des Formats Check24DE Fashion

| **Spaltenbezeichnung**            | **Erläuterung** |
| :---                              | :--- |
| Produktname                       | **Pflichtfeld**<br/> Entsprechend der Formateinstellung **Artikelname** oder Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Produktname**.  |
| Variation-ID                      | **Pflichtfeld**<br/> Die **Parent-SKU** der Variante für Check24 oder eine Zeichenkette gemäß "Parent-SKU"-"Attributs-Wert-ID", wenn ein Farb-Attribut an der Variante hinterlegt ist. |
| Model-ID                          | **Pflichtfeld**<br/> Die **Parent-SKU** der Variante für Check24. |
| Kategorie-ID                      | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal** Verknüpfung: **Kategorie-ID**. |
| Kurzbeschreibung                  | Entsprechend der Formateinstellung **Vorschautext** oder Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Kurzbeschreibung**. Merkmale werden bevorzugt. |
| Ausführliche Beschreibung         | **Pflichtfeld**<br/> Entsprechend der Formateinstellung **Beschreibung** oder Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Ausführliche Beschreibung**. Merkmale werden bevorzugt. |
| Amazon Sales Rank                 | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Amazon Sales Rank**. |
| Unverbindliche Preisempfehlung    | Der **Verkaufspreis** vom Typ **UVP**. |
| EAN                               | **Pflichtfeld**<br/> Entsprechend der Formateinstellung **Barcode** oder ein Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **EAN**. Merkmale werden bevorzugt.|
| ASIN                              | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **ASIN**. |
| MPNR                              | Das **Modell** der Variante oder Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **MPNR**. Merkmale werden bevorzugt. |
| SKU                               | Die **SKU** der Variante für Check24.de. |
| UPC                               | Barcode vom Typ **UPC** oder Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **UPC**. Merkmale werden bevorzugt. |
| Bild-URL #1 - #10                 | **Pflichtfeld**<br/> Der **URL-Pfad** der Artikelbilder entsprechend der Formateinstellung **Bild**. Variantenbilder werden vor Artikelbilder sortiert. |
| Absatzform                        | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Absatzform**. |
| Schuhspitze                       | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Schuhspitze**. |
| Farbe                             | Attribut mit der Attributverknüpfung **Farbe** für Google Shopping oder ein Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Farbe**. Attribute werden bevorzugt. |
| Geschlecht                        | **Pflichtfeld**<br/> Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Geschlecht**. |
| Altersgruppe                      | **Pflichtfeld**<br/> Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Altersgruppe**. |
| Größe                             | **Pflichtfeld**<br/> Attribut mit der Attributverknüpfung **Größe** für Google Shopping oder ein Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Größe**. Attribute werden bevorzugt. |
| Größensystem                      | **Pflichtfeld**<br/> Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Größensystem**. |
| Marke                             | **Pflichtfeld**<br/> Der **Name des Herstellers** des Artikels oder ein Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Marke**. Merkmale werden bevorzugt. Der **Externe Name** unter **Einstellungen » Artikel » Hersteller** wird bevorzugt, wenn vorhanden.|
| Material                          | **Pflichtfeld**<br/> Attribut mit der Attributverknüpfung **Material** für Google Shopping oder Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Material**. Attribute werden bevorzugt.|
| Innenfutter                       | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Innenfutter**. |
| Absatzhöhe                        | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Absatzhöhe**. |
| Sohlenmaterial                    | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Sohlenmaterial**. |
| Passform                          | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Passform**. |
| Verschluss                        | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Verschluss**. |
| Schafthöhe                        | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Schafthöhe**. |
| Schaftweite                       | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Schaftweite**. |
| Weite                             | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Weite**. |
| Muster                            | Attribut mit der Attributverknüpfung **Muster** für Google Shopping oder ein Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Muster**. Attribute werden bevorzugt. |
| Herstellerfarbe                   | **Pflichtfeld**<br/> Attribut mit der Attributverknüpfung **Farbe** für Google Shopping oder ein Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Herstellerfarbe**. Attribute werden bevorzugt.|
| Innensohlenmaterial               | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Innensohlenmaterial**. |
| Anlass                            | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Anlass**.|
| Saison                            | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Saison**. |
| Sonstige                          | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Sonstige**. |
| Applikationen                     | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Applikationen**. |
| Modestil                          | Merkmal des Typs **Text** mit der **Check24 Fashion-Merkmal**-Verknüpfung: **Modestil**. |

_Tab. 4: Spalten des Datenformats **Check24DE Fashion**_

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen findest du in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-check-24-de/blob/master/LICENSE.md).
