# Release Notes for Elastic Export Check24.de

## v1.3.0 (2022-05-26)

### Changed
- UPDATE - Additional updates to ensure compatibility with PHP 8.

## v1.2.9 (2021-10-12)

### Changed
- Small structural adjustments.

## v1.2.8 (2021-04-08)

### Fixed
Format **Check24DE Fashion**:
- During export, it was not recognised that a SKU already existed for Check24 with the account ID 0 if a different referrer was selected in the format setting.

## v1.2.7 (2021-03-29)

### Fixed
Format **Check24DE Fashion**:
- The account ID from the format settings is now ignored when generating SKU. It is currently not possible to create multiple accounts. As a result, the settings could lead to errors. The account ID is 0 by default.
- It will no longer result in an error if the model of a variation is empty.

## v1.2.6 (2021-01-21)

### Changed
- The performance of the export format was improved.

## v1.2.5 (2019-12-16)

### Changed
- The user guide for the **Check24DE Fashion** format was adjusted.

## v1.2.4 (2019-10-17)

### Fixed
Format **Check24DE Fashion**:
- Correction of typo in user guide chapter **"3.2 Available columns of the data format Check24DE Fashion"**.
The column name and property link **Kategoriepfad** were wrong. The correct value is **Kategorie-Pfad**.

## v1.2.3 (2019-09-20)

### Fixed
Format **Check24DE Fashion**:
- If an error occurs while creating or updating a SKU for a variation, that error will now be logged and the variation will still be exported.

## v1.2.2 (2019-09-17)

### Changed
Format **Check24DE Fashion**:
- If images are linked to the variation, only these images will be exported. Otherwise all images will be exported.

### Fixed
Format **Check24DE Fashion**:
- Images are now exported in order according to their position.

## v1.2.1 (2019-09-16)

### Changed
Format **Check24DE Fashion**:
- Instead of only exporting images linked to the variation, this will now only apply for variations with a color attribute. For other variations, all images will be exported.

## v1.2.0 (2019-09-10)

### Added
- The format **Check24DE Fashion** was added. The format can be used to create products for the **Fashion** category on Check24. Further information about this format is available in the **description** of the **User Guide**.

## v1.1.9 (2019-08-23)

### Fixed
- Shipping costs will no longer be exported empty if the variation is free of shipping costs.

## v1.1.8 (2019-02-14)

### Fixed
- Image positions will be considered when transferring the image URL.

## v1.1.7 (2019-01-21)

### Changed
- An incorrect link in the user guide was corrected.

## v1.1.6 (2018-07-11)

### Changed
- An incorrect link in the user guide was corrected.

## v1.1.5 (2018-05-04)

### Added
- The tables in the user guide were extended.
- Information about the price comparison portal was added.

## v1.1.4 (2018-04-30)

### Changed
- Laravel 5.5 update.

## v1.1.3 (2018-03-28)

### Changed
- The class FiltrationService is responsible for the filtration of all variations.
- Preview images updated.

## v1.1.2 (2018-02-16)

### Changed
- Updated plugin short description.

## v1.1.1 (2018-01-23)

### Fixed
- An issue was fixed, which caused the shipping costs not to be exported.

## v1.1.0 (2017-12-28)

### Added
- The plugin takes the new fields "Stockbuffer", "Stock for variations without stock limitation" and "Stock for variations with not stock administration" into account.

## v1.0.7 (2017-09-27)

### Changed
- The user guides was updated.
- The performance was improved.

## v1.0.6 (2017-07-11)

### Changed
- The plugin Elastic Export is now required to use the plugin format Check24DE.

### Fixed
- An issue was fixed which caused elastic search to ignore the set referrers for the barcodes.
- An issue was fixed which caused the stock filter not to be correctly evaluated.
- An issue was fixed which caused the variations not to be exported in the correct order.
- An issue was fixed which caused the export format to export texts in the wrong language.

## v1.0.5 (2017-03-22)

### Fixed
- We now use a different value to get the image URLs for plugins working with elastic search.

## v1.0.4 (2017-03-20)

### Changed
- Changed the call to point to the correct ItemDataLayer class.

## v1.0.3 (2017-03-13)

### Added
- Added marketplace name.

### Changed
- Changed plugin icons.

## v1.0.2 (2017-03-03)

### Changed
- Adjustment for the ResultField, so the imageMutator does not affect the image outcome anymore if the referrer "ALL" is set.

## v1.0.1 (2017-03-01)

### Changed
- Screenshot updated.

## v1.0.0 (2017-02-20)

### Added
- Added initial plugin files.
