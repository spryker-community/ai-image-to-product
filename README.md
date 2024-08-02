# Hackathon Project
Created by team ***Nagarro Oryx***.

## Short Project Description
Imagine a world where product creation is as effortless as uploading a photo. Introducing AI-Powered Image-to-Product Data Generator that revolutionizes product onboarding, saving time, reducing errors, and boosting efficiency.


## Pre-requisite:
1. To generate Gemini Api key [click here](https://aistudio.google.com/app/apikey)
2. Setup env variable: 

	- GEMINI_API_KEY with key or add key in **config/shared/config_default.php** 
	```php
	$config[ImageToTextConstants::GEMINI_API_KEY]  = 'api_key';
	```
	
	- GEMINI_HOST_ENDPOINT with API endpoint or add key in **config/shared/config_default.php** 
    
    ```php
    $config[ImageToTextConstants::GEMINI_HOST_ENDPOINT]  = 'host_url';
	```

## Modules and path:

  *config/Shared/config_default.php has two configuration:*
   
    $config[ImageToTextConstants::GEMINI_HOST_ENDPOINT] = getenv('GEMINI_HOST_ENDPOINT') ? : 'host_url';
```php
$config[ImageToTextConstants::GEMINI_API_KEY] = getenv('GEMINI_API_KEY') ? : 'api_key';
```

- src/Pyz/**Zed**/AIImageToProductDataImport
- src/Pyz/**Zed**/AIImageToProductGui
- src/Pyz/**Client**/ImageToText
- src/Pyz/**Zed/DataImport**/DataImportDependencyProvider.php
- src/Pyz/**Shared/ImageToText**/ImageToTextConstants.php
- src/Pyz/**Zed/ProductManagement**/Presentation/Index/index.twig
**Data-import path**
- data/import/common/**EU/ai_image_to_product.csv**
- data/import/common/**ai_image_to_product_EU.yml**

### Capabilities:

- Generate Product using Image only
- Custom Data Importer to Import product using image

### How to use:
