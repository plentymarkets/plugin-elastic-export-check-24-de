
# Check24.de plugin user guide

<div class="container-toc"></div>

## 1 Registering with Check24.de

Check24.de is an online comparison portal that helps consumers find the right price/quality products. Beside price comparisons, items are also sold on the Check24.de market. 

For further information about this market, refer to the [Setting up Check24.de](https://knowledge.plentymarkets.com/en/omni-channel/multi-channel/check24) page of the manual.

## 2 The data format Check24DE-Plugin

###2.1 Setting up the data format Check24DE-Plugin in plentymarkets

By installing this plugin you will receive the export format **Check24DE-Plugin**. Use this format to exchange data between plentymarkets and Check24.de. It is required to install the Plugin **Elastic Export** from the plentyMarketplace first before you can use the format **Check24DE-Plugin** in plentymarkets.

Once both plugins are installed, you can create the export format **Check24DE-Plugin**. Refer to the [Elastic Export](https://knowledge.plentymarkets.com/en/basics/data-exchange/elastic-export) page of the manual for further details about the individual format settings.

Creating a new export format:

1. Go to **Data » Elastic export**.
2. Click on **New export**.
3. Carry out the settings as desired. Pay attention to the information given in table 1.
4. **Save** the settings.
→ The export format will be given an ID and it will appear in the overview within the **Exports** tab.

The following table lists details for settings, format settings and recommended item filters for the format **Check24DE-Plugin**.

| **Setting**                                           | **Explanation** | 
| :---                                                  | :--- |
| **Settings**                                          | |
| **Name**                                              | Enter a name. The export format will be listed under this name in the overview within the **Exports** tab. |
| **Type**                                              | Select the type **Item** from the drop-down list. |
| **Format**                                            | Select **Check24DE-Plugin**. |
| **Limit**                                             | Enter a number. If you want to transfer more than 9,999 data records to the price search engine, then the output file will not be generated again for another 24 hours. This is to save resources. If more than 9,999 data records are necessary, the setting **Generate cache file** has to be active. |
| **Generate cache file**                               | Place a check mark if you want to transfer more than 9,999 data records to the price search engine. The output file will not be generated again for another 24 hours. We recommend not to activate this setting for more than 20 export formats. This is to save resources. |
| **Provisioning**                                      | Select **URL**. This option generates a token for authentication in order to allow external access. |
| **Token, URL**                                        | If you have selected the option **URL** under **Provisioning**, then click on **Generate token**. The token will be entered automatically. When the token is generated under **Token**, the URL is entered automatically. |
| **File name**                                         | The file name must have the ending **.csv** or **.txt** for Check24.de to be able to import the file successfully. |
| **Item filters**                                      | |
| **Add item filters**                                  | Select an item filter from the drop-down list and click on **Add**. There are no filters set in default. It is possible to add multiple item filters from the drop-down list one after the other.<br/> **Variations** = Select **Transfer all** or **Only transfer main variations**.<br/> **Markets** = Select one market, several or **ALL**.<br/> The availability for all markets selected here has to be saved for the item. Otherwise, the export will not take place.<br/> **Currency** = Select a currency.<br/> **Category** = Activate to transfer the item with its category link. Only items belonging to this category will be exported.<br/> **Image** = Activate to transfer the item with its image. Only items with images will be transferred.<br/> **Client** = Select client.<br/> **Stock** = Select which stocks you want to export.<br/> **Flag 1 - 2** = Select the flag.<br/> **Manufacturer** = Select one, several or **ALL** manufacturers.<br/> **Active** = Only active variations will be exported. |
| **Format settings**                                   | |
| **Product URL**                                       | Choose which URL should be transferred to the price comparison portal, the item’s URL or the variation’s URL. Variation SKUs can only be transferred in combination with the Ceres store. |
| **Client**                                            | Select a client. This setting is used for the URL structure and to filter valid sales prices. |
| **URL parameter**                                     | Enter a suffix for the product URL if this is required for the export. If you have activated the transfer option for the product URL further up, then this character string will be added to the product URL. |
| **Order referrer**                                    | Choose the order referrer that should be assigned during the order import from the drop-down list. It will also be used to filter valid sales prices and images. |
| **Marketplace account**                               | Select the marketplace account from the drop-down list. The selected referrer is added to the product URL so that sales can be analysed later. |
| **Language**                                          | Select the language from the drop-down list. |
| **Item name**                                         | Select **Name 1**, **Name 2** or **Name 3**. These names are saved in the **Texts** tab of the item. Enter a number into the **Maximum number of characters (def. Text)** field if desired. This specifies how many characters should be exported for the item name. |
| **Preview text**                                      | This option does not affect this format. |
| **Description**                                       | Select the text that you want to transfer as description.<br/> Enter a number into the **Maximum number of characters (def. text)** field if desired. This specifies how many characters should be exported for the description.<br/> Activate the option **Remove HTML tags** if you want HTML tags to be removed during the export. If you only want to allow specific HTML tags to be exported, then enter these tags into the field **Permitted HTML tags, separated by comma (def. Text)**. Use commas to separate multiple tags. |
| **Target country**                                    | Select the target country from the drop-down list. |
| **Barcode**                                           | Select the ASIN, ISBN or an EAN from the drop-down list. The barcode has to be linked to the order referrer selected above. If the barcode is not linked to the order referrer it will not be exported. |
| **Image**                                             | Select **Position 0** or **First image** to export this image.<br/> **Position 0** = An image with position 0 will be transferred.<br/> **First image** = The first image will be transferred. |
| **Image position of the energy efficiency label**     | This option does not affect this format. |
| **Stockbuffer**                                       | The stock buffer for variations with the limitation to the net stock. |
| **Stock for variations without stock limitation**     | The stock for variations without stock limitation. |
| **Stock for variations with no stock administration** | The stock for variations without stock administration. |
| **Retail price**                                      | Select gross price or net price from the drop-down list. |
| **Offer price**                                       | This option does not affect this format. |
| **RRP**                                               | This option does not affect this format. |
| **Shipping costs**                                    | Activate this option if you want to use the shipping costs that are saved in a configuration. If this option is activated, then you will be able to select the configuration and the payment method from the drop-down lists.<br/> Activate the option **Transfer flat rate shipping charge** if you want to use a fixed shipping charge. If this option is activated, a value has to be entered in the line underneath. |
| **VAT Note**                                          | This option does not affect this format. |
| **Item availability**                                 | Activate the **overwrite** option and enter item availabilities into the fields **1** to **10**. The fields represent the IDs of the availabilities. This will overwrite the item availabilities that are saved in the menu **System » Item » Availability**. |
       
_Tab. 1: Settings for the data format **Check24DE-Plugin**_

### 2.2 Available columns of the data format Check24DE-Plugin.

| **Column name**        | **Explanation** |
| :---                   | :--- |
| id                     | **Required**<br/> The Check24.de **SKU** for the variation. |
| manufacturer           | The **name of the manufacturer** of the item. The **external name** within the menu **Settings » Items » Manufacturer** will be preferred if existing. |
| mpnr                   | The **model** of the variation. |
| ean                    | **Required**<br/> According to the format setting **Barcode**. |
| name                   | **Required**<br/> According to the format setting **Item name**. |
| description            | According to the format setting **Description**. |
| category_path          | The **category path of the default category** for the chosen **client** in the format settings. |
| price                  | **Required**<br/> The **sales price** of the variation. |
| price_per_unit         | The **base price information** in the format "price / unit". (Example: 10.00 EUR / kilogram) |
| link                   | **Required**<br/> The **URL path** of the item depending on the chosen **client** in the format settings. |
| image_url              | **Allowed file types:** jpg, gif, bmp, png<br/> The **URL path** of the first item image according to the format setting **Image**. Variation images are prioritised over item images. |
| delivery_time          | **Required**<br/> The **name of the item availability** within **Settings » Item » Item availability** or the translation according to the format setting **Item availability**. |
| delivery_cost          | According to the format setting **Shipping costs**. |
| pzn                    | Empty. |
| stock                  | The **net stock of the variation**. If the variation is not limited to net stock, then **999** will be set as value. |
| weight                 | The **weight** within **Items » Edit item » Open item » Open variation » Settings » Dimensions**. |

_Tab. 2: Columns of the data format **Check24DE-Plugin**_

## 3 The data format Check24DE Fashion 

###3.1 Setting up the data format Check24DE Fashion in plentymarkets

By installing this plugin you will receive the export format **Check24DE Fashion**. Use this format to exchange data between plentymarkets and Check24.de. It is required to install the Plugin **Elastic Export** from the plentyMarketplace first before you can use the format **Check24DE Fashion** in plentymarkets.

Once both plugins are installed, you can create the export format **Check24DE Fashion**. Refer to the [Elastic Export](https://knowledge.plentymarkets.com/en/basics/data-exchange/elastic-export) page of the manual for further details about the individual format settings.

Creating a new export format:

1. Go to **Data » Elastic export**.
2. Click on **New export**.
3. Carry out the settings as desired. Pay attention to the information given in table 1.
4. **Save** the settings.
→ The export format will be given an ID and it will appear in the overview within the **Exports** tab.

The following table lists details for settings, format settings and recommended item filters for the format **Check24DE Fashion**.

| **Setting**                                           | **Explanation** | 
| :---                                                  | :--- |
| **Settings**                                          | |
| **Name**                                              | Enter a name. The export format will be listed under this name in the overview within the **Exports** tab. |
| **Type**                                              | Select the type **Item** from the drop-down list. |
| **Format**                                            | Select **Check24DE Fashion**. |
| **Limit**                                             | Enter a number. If you want to transfer more than 9,999 data records to the price search engine, then the output file will not be generated again for another 24 hours. This is to save resources. If more than 9,999 data records are necessary, the setting **Generate cache file** has to be active. |
| **Generate cache file**                               | Place a check mark if you want to transfer more than 9,999 data records to the price search engine. The output file will not be generated again for another 24 hours. We recommend not to activate this setting for more than 20 export formats. This is to save resources. |
| **Provisioning**                                      | Select **URL**. This option generates a token for authentication in order to allow external access. |
| **Token, URL**                                        | If you have selected the option **URL** under **Provisioning**, then click on **Generate token**. The token will be entered automatically. When the token is generated under **Token**, the URL is entered automatically. |
| **File name**                                         | The file name must have the ending **.csv** or **.txt** for Check24.de to be able to import the file successfully. |
| **Item filters**                                      | |
| **Add item filters**                                  | Select an item filter from the drop-down list and click on **Add**. There are no filters set in default. It is possible to add multiple item filters from the drop-down list one after the other.<br/> **Variations** = Select **Transfer all** or **Only transfer main variations**.<br/> **Markets** = Select one market, several or **ALL**.<br/> The availability for all markets selected here has to be saved for the item. Otherwise, the export will not take place.<br/> **Currency** = Select a currency.<br/> **Category** = Activate to transfer the item with its category link. Only items belonging to this category will be exported.<br/> **Image** = Activate to transfer the item with its image. Only items with images will be transferred.<br/> **Client** = Select client.<br/> **Stock** = Select which stocks you want to export.<br/> **Flag 1 - 2** = Select the flag.<br/> **Manufacturer** = Select one, several or **ALL** manufacturers.<br/> **Active** = Only active variations will be exported. |
| **Format settings**                                   | |
| **Product URL**                                       | This option does not affect this format. |
| **Client**                                            | Select a client. This setting is used for the URL structure. |
| **URL parameter**                                     | Enter a suffix for the product URL if this is required for the export. If you have activated the transfer option for the product URL further up, then this character string will be added to the product URL. |
| **Order referrer**                                    | Choose the order referrer that should be assigned during the order import from the drop-down list. |
| **Marketplace account**                               | Select the marketplace account from the drop-down list. The selected referrer is added to the product URL so that sales can be analysed later. |
| **Language**                                          | Select the language from the drop-down list. |
| **Item name**                                         | Select **Name 1**, **Name 2** or **Name 3**. These names are saved in the **Texts** tab of the item. Enter a number into the **Maximum number of characters (def. Text)** field if desired. This specifies how many characters should be exported for the item name. |
| **Preview text**                                      | Select the text that you want to transfer as preview text.<br/> Enter a number into the **Maximum number of characters (def. text)** field if desired. This specifies how many characters should be exported for the description.<br/> Activate the option **Remove HTML tags** if you want HTML tags to be removed during the export. If you only want to allow specific HTML tags to be exported, then enter these tags into the field **Permitted HTML tags, separated by comma (def. Text)**. Use commas to separate multiple tags. |
| **Description**                                       | Select the text that you want to transfer as description.<br/> Enter a number into the **Maximum number of characters (def. text)** field if desired. This specifies how many characters should be exported for the description.<br/> Activate the option **Remove HTML tags** if you want HTML tags to be removed during the export. If you only want to allow specific HTML tags to be exported, then enter these tags into the field **Permitted HTML tags, separated by comma (def. Text)**. Use commas to separate multiple tags. |
| **Target country**                                    | Select the target country from the drop-down list. This setting is used to filter valid sales prices. |
| **Barcode**                                           | Select an EAN from the drop-down list. The barcode has to be linked to the order referrer selected above. If the barcode is not linked to the order referrer it will not be exported. |
| **Image**                                             | Select **Position 0** or **First image** to export this image.<br/> **Position 0** = An image with position 0 will be transferred.<br/> **First image** = The first image will be transferred. |
| **Image position of the energy efficiency label**     | This option does not affect this format. |
| **Stockbuffer**                                       | This option does not affect this format. |
| **Stock for variations without stock limitation**     | This option does not affect this format. |
| **Stock for variations with no stock administration** | This option does not affect this format. |
| **Retail price**                                      | This option does not affect this format. |
| **Offer price**                                       | This option does not affect this format. |
| **RRP**                                               | Activate if an valid sales price of type **RRP** should be exported. |
| **Shipping costs**                                    | This option does not affect this format. |
| **VAT Note**                                          | This option does not affect this format. |
| **Item availability**                                 | This option does not affect this format. |
       
_Tab. 3: Settings for the data format **Check24DE Fashion**_

### 3.2 Available columns of the data format Check24DE Fashion .

| **Column name**                   | **Explanation** |
| :---                              | :--- |
| Produktname                       | **Required**<br/> According to the format setting **Item name** or from a characteristic with the **Check24 Fashion Property** link: **Produktname**. Characteristics will be prioritized.  |
| Variation-ID                      | **Required**<br/> The variations variation ID or from a characteristic with the **Check24 Fashion Property** link: **Variation-ID**. Characteristics will be prioritized. |
| Model-ID                          | **Required**<br/> Die **Variantennummer** der Variante or from a characteristic with the **Check24 Fashion Property** link: **Model-ID**. Characteristics will be prioritized. |
| Kategorie-ID                      | Characteristic with the **Check24 Fashion Property** link: **Kategorie-ID**. |
| Kurzbeschreibung                  | According to the format setting **Preview text** or from a characteristic with the **Check24 Fashion Property** link: **Kurzbeschreibung**. Characteristics will be prioritized. |
| Ausführliche Beschreibung         | **Required**<br/> According to the format setting **Description** or from a characteristic with the **Check24 Fashion Property** link: **Ausführliche Beschreibung**. Characteristics will be prioritized. |
| Amazon Sales Rank                 | Characteristic with the **Check24 Fashion Property** link: **Amazon Sales Rank**. |
| Unverbindliche Preisempfehlung    | The **Sales Price** of type **RRP**. |
| EAN                               | **Required**<br/> According to the format setting **Barcode** or from a characteristic with the **Check24 Fashion Property** link: **EAN**. Characteristics will be prioritized. |
| ASIN                              | Characteristic with the **Check24 Fashion Property** link: **ASIN**. |
| MPNR                              | The variants **Model** or from a characteristic with the **Check24 Fashion Property** link: **MPNR**. Characteristics will be prioritized. |
| SKU                               | The variants **SKU** for Check24.de. |
| UPC                               | Barcode of type **UPC** or from a characteristic with the **Check24 Fashion Property** link: **UPC**. Characteristics will be prioritized. |
| Bild-URL #1 - #10                 | **Required**<br/> The **URL path** of the images according to the format setting **Image**. Variation images are prioritised over item images. |
| (Attribut) Absatzform             | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Absatzform**. |
| (Attribut) Schuhspitze            | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Schuhspitze**. |
| (Attribut) Farbe                  | Attribute with the attribute link **Color** for Google Shopping or from a characteristic with the **Check24 Fashion Property** link: **Farbe**. Attributes will be prioritized. |
| (Attribut) Geschlecht             | **Required**<br/> Characteristic with the **Check24 Fashion Property** link: **(Attribut) Geschlecht**. |
| (Attribut) Altersgruppe           | **Required**<br/> Characteristic with the **Check24 Fashion Property** link: **(Attribut) Altersgruppe**. |
| (Attribut) Größe                  | **Required**<br/> Attribute with the attribute link **Size** for Google Shopping or from a characteristic with the **Check24 Fashion Property** link: **Größe**. Attributes will be prioritized. |
| (Attribut) Größensystem           | **Required**<br/> Characteristic with the **Check24 Fashion Property** link: **(Attribut) Größensystem**. |
| (Attribut) Marke                  | **Required**<br/> The **name of the manufacturer** of the item or from a characteristic with the **Check24 Fashion Property** link: **Marke**. Characteristics will be prioritized. The **external name** within the menu **Settings » Items » Manufacturer** will be preferred if existing. |
| (Attribut) Material               | **Required**<br/> Attribute with the attribute link **Material** for Google Shopping or from a characteristic with the **Check24 Fashion Property** link: **Material**. Attributes will be prioritized. |
| (Attribut) Innenfutter            | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Innenfutter**. |
| (Attribut) Absatzhöhe             | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Absatzhöhe**. |
| (Attribut) Sohlenmaterial         | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Sohlenmaterial**. |
| (Attribut) Passform               | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Passform**. |
| (Attribut) Verschluss             | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Verschluss**. |
| (Attribut) Schafthöhe             | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Schafthöhe**. |
| (Attribut) Schaftweite            | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Schaftweite**. |
| (Attribut) Weite                  | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Weite**. |
| (Attribut) Muster                 | Attribute with the attribute link **Pattern** for Google Shopping or from a characteristic with the **Check24 Fashion Property** link: **Muster**. Attributes will be prioritized. |
| (Attribut) Herstellerfarbe        | **Required**<br/> Attribute with the attribute link **Color** for Google Shopping or from a characteristic with the **Check24 Fashion Property** link: **Herstellerfarbe**. Attributes will be prioritized. |
| (Attribut) Innensohlenmaterial    | Characteristic with the **Check24 Fashion Property** link: **(Attribut) Innensohlenmaterial**. |
| (Tag) Anlass                      | Characteristic with the **Check24 Fashion Property** link: **(Tag) Anlass**. |
| (Tag) Saison                      | Characteristic with the **Check24 Fashion Property** link: **(Tag) Saison**. |
| (Tag) Sonstige                    | Characteristic with the **Check24 Fashion Property** link: **(Tag) Sonstige**. |
| (Tag) Applikationen               | Characteristic with the **Check24 Fashion Property** link: **(Tag) Applikationen**. |
| (Tag) Modestil                    | Characteristic with the **Check24 Fashion Property** link: **(Tag) Modestil**. |

_Tab. 4: Columns of the data format **Check24DE Fashion**_

## 4 License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-check-24-de/blob/master/LICENSE.md).
