
# User Guide für das Elastic Export Check24.de Plugin

<div class="container-toc"></div>

## 1 Bei Check24.de registrieren

Check24.de ist ein Online-Vergleichsportal, das Verbrauchern bei der Suche nach dem für sie passenden Preis-/Leistungsumfang hilft. Auch Sie können auf dem Marktplatz Check24.de Ihre Artikel verkaufen.

Auf dem Marktplatz Check24 bieten Sie Ihre Artikel zum Verkauf an. Weitere Informationen zu diesem Marktplatz finden Sie auf der Handbuchseite [Check24 einrichten](https://knowledge.plentymarkets.com/omni-channel/multi-channel/check24). Um das Plugin für Check24.de einzurichten, registrieren Sie sich zunächst als Händler.

## 2 Das Format Check24DE-Plugin in plentymarkets einrichten

Mit der Installation dieses Plugins erhalten Sie das Exportformat **Check24DE-Plugin**, mit dem Sie Daten über den elastischen Export zu Check24.de übertragen. Um dieses Format für den elastischen Export nutzen zu können, installieren Sie zunächst das Plugin **Elastic Export** aus dem plentyMarketplace, wenn noch nicht geschehen. 

Sobald beide Plugins in Ihrem System installiert sind, kann das Exportformat **Check24DE-Plugin** erstellt werden. Mehr Informationen finden Sie auch auf der Handbuchseite [Datenformate für Preissuchmaschinen exportieren](https://knowledge.plentymarkets.com/basics/datenaustausch/export-import/daten-exportieren#30).

Neues Exportformat erstellen:

1. Öffnen Sie das Menü **Daten » Elastischer Export**.
2. Klicken Sie auf **Neuer Export**.
3. Nehmen Sie die Einstellungen vor. Beachten Sie dazu die Erläuterungen in Tabelle 1.
4. **Speichern** Sie die Einstellungen.
→ Eine ID für das Exportformat **Check24DE-Plugin** wird vergeben und das Exportformat erscheint in der Übersicht **Exporte**.

In der folgenden Tabelle finden Sie Hinweise zu den einzelnen Formateinstellungen und empfohlenen Artikelfiltern für das Format **Check24DE-Plugin**.

| **Einstellung**                                     | **Erläuterung** | 
| :---                                                | :--- |
| **Einstellungen**                                   | |
| **Name**                                            | Name eingeben. Unter diesem Namen erscheint das Exportformat in der Übersicht im Tab **Exporte**. |
| **Typ**                                             | Typ **Artikel** aus der Dropdown-Liste wählen. |
| **Format**                                          | **Check24DE-Plugin** wählen. |
| **Limit**                                           | Zahl eingeben. Wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen, wird die Ausgabedatei wird für 24 Stunden nicht noch einmal neu generiert, um Ressourcen zu sparen. Wenn mehr mehr als 9999 Datensätze benötigt werden, muss die Option **Cache-Datei generieren** aktiv sein. |
| **Cache-Datei generieren**                          | Häkchen setzen, wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen. Um eine optimale Performance des elastischen Exports zu gewährleisten, darf diese Option bei maximal 20 Exportformaten aktiv sein. |
| **Bereitstellung**                                  | **URL** wählen. Mit dieser Option kann ein Token für die Authentifizierung generiert werden, damit ein externer Zugriff möglich ist. |
| **Token, URL**                                      | Wenn unter **Bereitstellung** die Option **URL** gewählt wurde, auf **Token generieren** klicken. Der Token wird dann automatisch eingetragen. Die URL wird automatisch eingetragen, wenn unter **Token** der Token generiert wurde. |
| **Dateiname**                                       | Der Dateiname muss auf **.csv** oder **.txt** enden, damit Check24.de die Datei erfolgreich importieren kann. |
| **Artikelfilter**                                   | |
| **Artikelfilter hinzufügen**                        | Artikelfilter aus der Dropdown-Liste wählen und auf **Hinzufügen** klicken. Standardmäßig sind keine Filter voreingestellt. Es ist möglich, alle Artikelfilter aus der Dropdown-Liste nacheinander hinzuzufügen.<br/> **Varianten** = **Alle übertragen** oder **Nur Hauptvarianten übertragen** wählen.<br/> **Märkte** = Einen, mehrere oder **ALLE** Märkte wählen. Die Verfügbarkeit muss für alle hier gewählten Märkte am Artikel hinterlegt sein. Andernfalls findet kein Export statt.<br/> **Währung** = Währung wählen.<br/> **Kategorie** = Aktivieren, damit der Artikel mit Kategorieverknüpfung übertragen wird. Es werden nur Artikel, die dieser Kategorie zugehören, übertragen.<br/> **Bild** = Aktivieren, damit der Artikel mit Bild übertragen wird. Es werden nur Artikel mit Bildern übertragen.<br/> **Mandant** = Mandant wählen.<br/> **Bestand** = Wählen, welche Bestände exportiert werden sollen.<br/> **Markierung 1 - 2** = Markierung wählen.<br/> **Hersteller** = Einen, mehrere oder **ALLE** Hersteller wählen.<br/> **Aktiv** = Nur aktive Varianten werden übertragen. |
| **Formateinstellungen**                             | |
| **Produkt-URL**                                     | Wählen, ob die URL des Artikels oder der Variante an das Preisportal übertragen wird. Varianten URLs können nur in Kombination mit dem Ceres Webshop übertragen werden. |
| **Mandant**                                         | Mandant wählen. Diese Einstellung wird für den URL-Aufbau verwendet. |
| **URL-Parameter**                                   | Suffix für die Produkt-URL eingeben, wenn dies für den Export erforderlich ist. Die Produkt-URL wird dann um die eingegebene Zeichenkette erweitert, wenn weiter oben die Option **übertragen** für die Produkt-URL aktiviert wurde. |
| **Auftragsherkunft**                                | Aus der Dropdown-Liste die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll. |
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

## 3 Verfügbare Spalten der Exportdatei

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

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-check-24-de/blob/master/LICENSE.md).
