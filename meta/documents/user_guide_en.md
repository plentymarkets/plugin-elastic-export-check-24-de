
# Check24.de plugin user guide

<div class="container-toc"></div>

## 1 Registering with Check24.de

Check24.de is an online comparison portal that helps consumers find the right price/quality products. Beside price comparison, items are also sold on the Check24.de market. 

For further information about this market, refer to the [Setting up Check24.de](https://knowledge.plentymarkets.com/en/omni-channel/multi-channel/check24) page of the manual.

## 2 Setting up the data format Check24DE-Plugin in plentymarkets

The plugin Elastic Export is required to use this format.

Refer to the [Exporting data formats for price search engines](https://knowledge.plentymarkets.com/en/basics/data-exchange/exporting-data#30) page of the manual for further details about the individual format settings.

The following table lists details for settings, format settings and recommended item filters for the format **Check24DE-Plugin**.

<table>
    <tr>
        <th>
            Settings
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Settings
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            Choose <b>Check24DE-Plugin</b>.
        </td>        
    </tr>
    <tr>
        <td>
            Provisioning
        </td>
        <td>
            Choose <b>URL</b>.
        </td>        
    </tr>
    <tr>
        <td>
            File name
        </td>
        <td>
            The file name must have the ending <b>.csv</b> or <b>.txt</b> for Check24.de to be able to import the file successfully.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Item filter
        </td>
    </tr>
    <tr>
        <td>
            Active
        </td>
        <td>
            Choose <b>active</b>.
        </td>        
    </tr>
    <tr>
        <td>
            Markets
        </td>
        <td>
            Choose one or multiple order referrer. The chosen order referrer has to be active at the variation for the item to be exported.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Format settings
        </td>
    </tr>
    <tr>
        <td>
            Order referrer
        </td>
        <td>
            Choose the order referrer that should be assigned during the order import.
        </td>        
    </tr>
    <tr>
    	<td>
    		Stockbuffer
    	</td>
    	<td>
    		The stock buffer for variations with the limitation to the netto stock.
    	</td>        
    </tr>
    <tr>
    	<td>
    		Stock for Variations without stock limitation
    	</td>
    	<td>
    		The stock for variations without stock limitation.
    	</td>        
    </tr>
    <tr>
    	<td>
    		The stock for variations with not stock administration
    	</td>
    	<td>
    		The stock for variations without stock administration.
    	</td>        
    </tr>
    <tr>
        <td>
            Preview text
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
    <tr>
        <td>
            Offer price
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
    <tr>
        <td>
            VAT note
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
</table>

## 3 Overview of available columns

<table>
    <tr>
        <th>
            Column name
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
		<td>
			id
		</td>
		<td>
		    <b>Required</b><br>
			The Check24.de <b>SKU</b> for the variation.
		</td>        
	</tr>
	<tr>
		<td>
			manufacturer
		</td>
		<td>
		    The <b>name of the manufacturer</b> of the item. The <b>external name</b> from the menu <b>Settings » Items » Manufacturer</b> will be preferred if existing.
		</td>        
	</tr>
	<tr>
		<td>
			mpnr
		</td>
		<td>
		    The <b>Model</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			ean
		</td>
		<td>
		    <b>Required</b><br>
		    According to the format setting <b>Barcode</b>.
		</td>        
	</tr>
	<tr>
		<td>
			name
		</td>
		<td>
		    <b>Required</b><br>
		    According to the format setting <b>Item Name</b>.
		</td>        
	</tr>
	<tr>
		<td>
			description
		</td>
		<td>
		    According to the format setting <b>Description</b>.
		</td>        
	</tr>
	<tr>
		<td>
			category_path
		</td>
		<td>
		    The <b>category path of the default cateogory</b> for the chosen <b>client</b> in the format settings.
		</td>        
	</tr>
	<tr>
		<td>
			price
		</td>
		<td>
		    <b>Required</b><br>
		    The <b>sales price</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			price_per_unit
		</td>
		<td>
		    The <b>base price information</b> in the format "price / unit". (Example: 10,00 EUR / kilogram)
		</td>        
	</tr>
	<tr>
		<td>
			link
		</td>
		<td>
		    <b>Required</b><br>
		    The <b>URL path</b> of the item depending on the chosen <b>client</b> in the format settings.
		</td>        
	</tr>
	<tr>
		<td>
			image_url
		</td>
		<td>
            <b>Allowed file types:</b> jpg, gif, bmp, png.<br>
            The <b>URL path</b> of the first item image according to the format setting <b>image</b>. Variation images are prioritizied over item images.
		</td>        
	</tr>
	<tr>
		<td>
			delivery_time
		</td>
		<td>
		    <b>Required</b><br>
			<The <b>name of the item availability</b> under <b>Settings » Item » Item availability</b> or the translation according to the format setting <b>Item availability</b>.
		</td>        
	</tr>
	<tr>
		<td>
			delivery_cost
		</td>
		<td>
			According to the format setting <b>Shipping costs</b>.
		</td>        
	</tr>
	<tr>
		<td>
			pzn
		</td>
		<td>
			No content.
		</td>        
	</tr>
	<tr>
		<td>
			stock
		</td>
		<td>
			The <b>net stock of the variation</b>. If the variation is not limited to net stock, then <b>999</b> will be set as value.
		</td>        
	</tr>
	<tr>
		<td>
			weight
		</td>
		<td>
			<b>Content:</b> The <b>weight</b> within <b>Items » Edit item » Open item » Open variation » Settings » Dimensions</b>.
		</td>        
	</tr>
</table>

## 4 License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-check-24-de/blob/master/LICENSE.md).
