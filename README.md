# E-Shop
A simple API to manage E-Shop Cart
## Features
1. Visitors can register/login either as merchants or end consumers.
2. Merchants can set their store name.
3. Merchants can decide if the VAT is included in the products price or should be calculated from the products price.
4. Merchants can optionally set shipping cost
5. Merchants can set VAT percentage in case the VAT isn’t included in the product’s price.
6. Merchants can add products with multilingual names and descriptions and prices.
7. Merchants and end-consumers can add products to their carts.
8. Calculate the cart’s total.
## Installation steps for local development
1. Install composer packages
    ```
    composer install
    ```
2. Copy .env.example to .env
    ```
    cp .env.example .env
    ```
3. Set the app Key
    ```
    php artisan key:generate
    ```
4. Start the server
    ```
    php artisan serve
    ```
## Docs
You would find a postman collection in the project root directory named as [E-Shop.postman_collection.json](E-Shop.postman_collection.json)