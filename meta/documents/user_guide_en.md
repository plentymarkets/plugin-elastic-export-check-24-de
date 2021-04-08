
# Check24.de plugin user guide

<div class="container-toc"></div>

## 1 Registering with Check24.de

Check24.de is an online comparison portal that helps consumers find the right price/quality products. Beside price comparisons, items are also sold on the Check24.de market. 

For further information about this market, refer to the [Check24.de](https://knowledge.plentymarkets.com/en/markets/check24) page of the manual.

## 2 The data format Check24DE-Plugin

### 2.1 Setting up the data format Check24DE-Plugin in plentymarkets

By installing this plugin you will receive the export format **Check24DE-Plugin**. Use this format to exchange data between plentymarkets and Check24.de. It is required to install the Plugin **Elastic Export** from the plentyMarketplace first before you can use the format **Check24DE-Plugin** in plentymarkets.

Once both plugins are installed, you can create the export format **Check24DE-Plugin**. Refer to the [Elastic Export](https://knowledge.plentymarkets.com/en/data/exporting-data/elastic-export) page of the manual for further details about the individual format settings.

Creating a new export format:

1. Go to **Data » Elastic export**.
2. Click on **New export**.
3. Carry out the settings as desired. Pay attention to the information given in table 1.
4. **Save** the settings.<br/>
→ The export format is given an ID and it appears in the overview within the **Exports** tab.

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
| **Order referrer**                                    | Select the order referrer that should be assigned during the order import from the drop-down list. The order referrer is also used to filter valid sales prices and images. The selected referrer is added to the product URL so that sales can be analysed later. |
| **Marketplace account**                               | Select the marketplace account from the drop-down list. |
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

### 2.2 Available columns of the data format Check24DE plugin

| **Column name**        | **Explanation** |
| :---                   | :--- |
| id                     | **Required**<br/> The Check24.de **SKU** with account ID 0 for the variation. |
| manufacturer           | The **name of the manufacturer** of the item. The **external name** within the **Settings » Items » Manufacturer** menu is preferred if existing. |
| mpnr                   | The **model** of the variation. |
| ean                    | **Required**<br/> According to the format setting **Barcode**. |
| name                   | **Required**<br/> According to the format setting **Item name**. |
| description            | According to the format setting **Description**. |
| category_path          | The **category path of the default category** for the chosen **client** in the format settings. |
| price                  | **Required**<br/> The **sales price** of the variation. |
| price_per_unit         | The **base price information** in the format "price / unit". (Example: 10.00 EUR / kilogram) |
| link                   | **Required**<br/> The **URL path** of the item depending on the chosen **client** in the format settings. |
| image_url              | **Allowed file types:** jpg, gif, bmp, png<br/> The **URL path** of the first item image according to the format setting **Image**. Variation images are prioritised over item images. |
| delivery_time          | **Required**<br/> The **name of the item availability** within **Setup » Item » Availability** or the translation according to the format setting **Item availability**. |
| delivery_cost          | According to the format setting **Shipping costs**. |
| pzn                    | Empty. |
| stock                  | The **net stock of the variation**. If the variation is not limited to net stock, then **999** will be set as value. |
| weight                 | The **weight** within **Items » Edit item » Open item » Open variation » Settings » Dimensions**. |

_Tab. 2: Columns of the data format **Check24DE-Plugin**_

## 3 The data format Check24DE Fashion 

### 3.1 Setting up the data format Check24DE Fashion in plentymarkets

By installing this plugin you will receive the export format **Check24DE Fashion**. Use this format to exchange data between plentymarkets and Check24.de. It is required to install the Plugin **Elastic Export** from the plentyMarketplace first before you can use the format **Check24DE Fashion** in plentymarkets.

Once both plugins are installed, you can create the export format **Check24DE Fashion**. Refer to the [Elastic Export](https://knowledge.plentymarkets.com/en/data/exporting-data/elastic-export) page of the manual for further details about the individual format settings.

Creating a new export format:

1. Go to **Data » Elastic export**.
2. Click on **New export**.
3. Carry out the settings as desired. Pay attention to the information given in table 1.
4. **Save** the settings.<br/>
→ The export format is given an ID and it appears in the overview within the **Exports** tab.

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
| **Order referrer**                                    | Select the order referrer that should be assigned during the order import from the drop-down list. The selected referrer is added to the product URL so that sales can be analysed later. |
| **Marketplace account**                               | Select the marketplace account from the drop-down list. |
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

### 3.2 Available columns of the data format Check24DE Fashion

| **Column name**                   | **Explanation** |
| :---                              | :--- |
| Produktname                       | **Required**<br/> According to the format setting **Item name** or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Produktname**. Characteristics will be prioritised.  |
| Variation-ID                      | **Required**<br/> The **parent SKU** of the variation for Check24 or a string of characters according to **"parent SKU"-"attribute value id"** if a colour attribute is linked to the variation. |
| Model-ID                          | **Required**<br/> The **parent SKU** of the variation for Check24. |
| Kategorie-Pfad                    | **Required**<br/> Category path of the default category of the client chosen in the settings above or from a characteristic of the type **text** or **selection** with the **Check24 Fashion Property** link: **Kategorie-Pfad**. |
| Kurzbeschreibung                  | According to the format setting **Preview text** or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Kurzbeschreibung**. Characteristics will be prioritised. |
| Ausführliche Beschreibung         | **Required**<br/> According to the format setting **Description** or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Ausführliche Beschreibung**. Characteristics will be prioritised. |
| Amazon Sales Rank                 | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Amazon Sales Rank**. |
| Unverbindliche Preisempfehlung    | The **Sales Price** of type **RRP**. |
| EAN                               | **Required**<br/> According to the format setting **Barcode** or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **EAN**. Characteristics will be prioritised. |
| ASIN                              | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **ASIN**. |
| MPNR                              | The **model** of the variation or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **MPNR**. Characteristics will be prioritised. |
| SKU                               | The **SKU** of the variation for Check24.de with account ID 0. |
| UPC                               | Barcode of the type **UPC** or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **UPC**. Characteristics will be prioritised. |
| Bild-URL #1 - #20                 | **Required**<br/> The **URL path** of the images according to the format setting **Image**. If color variations exist, only images linked to the variation will be exported. Otherwise all images will be exported. |
| Absatzform                        | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Absatzform**. |
| Schuhspitze                       | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Schuhspitze**. |
| Geschlecht                        | **Required**<br/> Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Geschlecht**. |
| Altersgruppe                      | **Required**<br/> Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Altersgruppe**. |
| Größe                             | **Required**<br/> Attribute with the attribute link **Size** for Google Shopping or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Größe**. Attributes will be prioritised. |
| Größensystem                      | **Required**<br/> Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Größensystem**. |
| Marke                             | **Required**<br/> The **name of the manufacturer** of the item or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Marke**. Characteristics will be prioritised. The **external name** within the **Setup » Items » Manufacturer** menu is preferred if existing. |
| Material                          | **Required**<br/> Attribute with the attribute link **Material** for Google Shopping or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Material**. Attributes will be prioritised. |
| Innenfutter                       | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Innenfutter**. |
| Absatzhöhe                        | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Absatzhöhe**. Please insert the measurement as well as the unit of measurement as the characteristics value at the item. Example: "2 cm"|
| Sohlenmaterial                    | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Sohlenmaterial**. |
| Passform                          | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Passform**. |
| Verschluss                        | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Verschluss**. |
| Schafthöhe                        | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Schafthöhe**. Please insert the measurement as well as the unit of measurement as the characteristics value at the item. Example: "5 cm" |
| Schaftweite                       | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Schaftweite**. Please insert the measurement as well as the unit of measurement as the characteristics value at the item. Example: "5 cm" |
| Weite                             | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Weite**. Please insert the measurement as well as the unit of measurement as the characteristics value at the item. Example: "5 cm" |
| Muster                            | Attribute with the attribute link **Pattern** for Google Shopping or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Muster**. Attributes will be prioritised. |
| Herstellerfarbe                   | **Required**<br/> Attribute with the attribute link **Color** for Google Shopping or from a characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Herstellerfarbe**. Attributes will be prioritised. |
| Innensohlenmaterial               | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Innensohlenmaterial**. |
| Anlass                            | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Anlass**. |
| Saison                            | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Saison**. |
| Sonstige                          | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Sonstige**. |
| Applikationen                     | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Applikationen**. |
| Modestil                          | Characteristic of the type **text** or **selection** with the **Check24 Fashion property** link **Modestil**. |

_Tab. 4: Columns of the data format **Check24DE Fashion**_

## 4 License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-check-24-de/blob/master/LICENSE.md).
