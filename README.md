# Hackathon Project
Created by team ***Nagarro Oryx***.

## Short Project Description
Imagine a world where product creation is as effortless as uploading a photo. Introducing **AI-Powered Image-to-Product Data Generator** that revolutionizes product onboarding, saving time, reducing errors, and boosting efficiency.

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

## Setup:

1. clone the repository in your local
	```php
    git clone git@github.com:spryker-community/ai-image-to-product.git
    ```
2. clone docker sdk 
    ```php
     git clone https://github.com/spryker/docker-sdk.git --single-branch docker
    ```
3. bootstrap the project
    ```php
    docker/sdk bootstrap deploy.dev.yml
    ```
4. start the project
 ```php
        docker/sdk up
 ```
if you come across any installation error, please run following command:
```php
        docker/sdk reset
 ```
caution:  if you run this command, all the data stored in your spryker docker volumes will be destroyed. 
### Capabilities:

- Generate Product using Image only
- Custom Data Importer to Import product using image

### How to use:
1. Login to backoffice and go to catalog > Product
2. On products section, on top right corner **Gen Ai Product** button is there. click on it.
![backoffice-1](https://github.com/user-attachments/assets/d753c92b-0477-4330-aba6-f016bf2ccf77)
3.Fill the required information:
![genai-2](https://github.com/user-attachments/assets/6d2176cc-3ac6-49cf-91ed-cab23fab1ee7)
4. click on save which will create a new product and redirect you on product edit page.  If sku already exist, it will throw the error message that Sku already exist.
![genai-4](https://github.com/user-attachments/assets/7cae01f4-17c5-42f4-ba35-871903033eea)

