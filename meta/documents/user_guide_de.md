
# User Guide für das Elastic Export Check24.de Plugin

<div class="container-toc"></div>

## 1 Bei Check24.de registrieren

Check24.de ist ein Online-Vergleichsportal, das Verbrauchern bei der Suche nach dem für sie passenden Preis- /Leistungsumfang hilft. Auch Sie können auf dem Marktplatz Check24.de Ihre Artikel zum verkaufen.

Auf dem Marktplatz Check24 bieten Sie Ihre Artikel zum Verkauf an. Weitere Informationen zu diesem Marktplatz finden Sie auf der Handbuchseite [Check24 einrichten](https://knowledge.plentymarkets.com/omni-channel/multi-channel/check24). Um das Plugin für Check24.de einzurichten, registrieren Sie sich zunächst als Händler.

## 2 Elastic Export Check24DE-Plugin in plentymarkets einrichten

Um dieses Format nutzen zu können, benötigen Sie das Plugin Elastic Export.

Auf der Handbuchseite [Daten exportieren](https://knowledge.plentymarkets.com/basics/datenaustausch/daten-exportieren#30) werden die einzelnen Formateinstellungen beschrieben.

In der folgenden Tabelle finden Sie Hinweise zu den Einstellungen, Formateinstellungen und empfohlenen Artikelfiltern für das Format **Check24DE-Plugin**.
<table>
    <tr>
        <th>
            Einstellung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Einstellungen
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            <b>Check24DE-Plugin</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Bereitstellung
        </td>
        <td>
            <b>URL</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Dateiname
        </td>
        <td>
            Der Dateiname muss auf <b>.csv</b> oder <b>.txt</b> enden, damit Check24.de die Datei erfolgreich importieren kann.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Artikelfilter
        </td>
    </tr>
    <tr>
        <td>
            Aktiv
        </td>
        <td>
            <b>Aktiv</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Märkte
        </td>
        <td>
            Eine oder mehrere Auftragsherkünfte wählen. Die gewählten Auftragsherkünfte müssen an der Variante aktiviert sein, damit der Artikel exportiert wird.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Formateinstellungen
        </td>
    </tr>
    <tr>
        <td>
            Auftragsherkunft
        </td>
        <td>
            Die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll.
        </td>        
    </tr>
    <tr>
		<td>
			Vorschautext
		</td>
		<td>
			Diese Option ist für dieses Format nicht relevant.
		</td>        
	</tr>
    <tr>
        <td>
            UVP
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>        
    </tr>
    <tr>
        <td>
            MwSt.-Hinweis
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>        
    </tr>
</table>


## 3 Übersicht der verfügbaren Spalten

<table>
    <tr>
        <th>
            Spaltenbezeichnung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
		<td>
			id
		</td>
		<td>
		    <b>Pflichtfeld</b><br>
			<b>Inhalt:</b> Die <b>SKU</b> für Check24.de der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			manufacturer
		</td>
		<td>
		    <b>Inhalt:</b> Der <b>Name des Herstellers</b> des Artikels. Der <b>Externe Name</b> unter <b>Einstellungen » Artikel » Hersteller</b> wird bevorzugt, wenn vorhanden.
		</td>        
	</tr>
	<tr>
		<td>
			mpnr
		</td>
		<td>
		    <b>Inhalt:</b> Das <b>Model</b> der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			ean
		</td>
		<td>
		    <b>Pflichtfeld</b><br>
		    <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Barcode</b>.
		</td>        
	</tr>
	<tr>
		<td>
			name
		</td>
		<td>
		    <b>Pflichtfeld</b><br>
		    <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Artikelname</b>.
		</td>        
	</tr>
	<tr>
		<td>
			description
		</td>
		<td>
		    <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Beschreibung</b>.
		</td>        
	</tr>
	<tr>
		<td>
			category_path
		</td>
		<td>
		    <b>Inhalt:</b> Der <b>Kategoriepfad der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
		</td>        
	</tr>
	<tr>
		<td>
			price
		</td>
		<td>
		    <b>Pflichtfeld</b><br>
		    <b>Inhalt:</b> Der <b>Verkaufspreis</b>.
		</td>        
	</tr>
	<tr>
		<td>
			price_per_unit
		</td>
		<td>
		    <b>Inhalt:</b> Die <b>Grundpreisinformation</b> im Format "Preis / Einheit". (Beispiel: 10,00 EUR / Kilogramm)
		</td>        
	</tr>
	<tr>
		<td>
			link
		</td>
		<td>
		    <b>Pflichtfeld</b><br>
		    <b>Inhalt:</b> Der <b>URL-Pfad</b> des Artikels abhängig vom gewählten <b>Mandanten</b> in den Formateinstellungen.
		</td>        
	</tr>
	<tr>
		<td>
			image_url
		</td>
		<td>
            <b>Erlaubte Dateitypen:</b> jpg, gif, bmp, png.<br>
            <b>Inhalt:</b> Der <b>URL-Pfad</b> des ersten Artikelbilds entsprechend der Formateinstellung <b>Bild</b>. Variantenbilder werden vor Artikelbilder priorisiert.
		</td>        
	</tr>
	<tr>
		<td>
			delivery_time
		</td>
		<td>
		    <b>Pflichtfeld</b><br>
		    <b>Inhalt:</b> Der <b>Name der Artikelverfügbarkeit</b> unter <b>Einstellungen » Artikel » Artikelverfügbarkeit</b> oder die Übersetzung gemäß der Formateinstellung <b>Artikelverfügbarkeit überschreiben</b>.
		</td>        
	</tr>
	<tr>
		<td>
			delivery_cost
		</td>
		<td>
		    <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Versandkosten</b>.
		</td>        
	</tr>
	<tr>
		<td>
			pzn
		</td>
		<td>
			Leer.
		</td>        
	</tr>
	<tr>
		<td>
			stock
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Netto-Warenbestand der Variante</b>. Bei Artikeln, die nicht auf den Netto-Warenbestand beschränkt sind, wird <b>999</b> übertragen.
		</td>        
	</tr>
	<tr>
		<td>
			weight
		</td>
		<td>
		    <b>Inhalt:</b> Das <b>Gewicht</b> wie unter <b>Artikel » Artikel bearbeiten » Artikel öffnen » Variante öffnen » Einstellungen » Maße</b> definiert.
		</td>        
	</tr>
</table>

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-check-24-de/blob/master/LICENSE.md).
