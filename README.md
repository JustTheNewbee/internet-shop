# internet-shop
Internet shop with api

### Api specification

| Method | URI | Parameters | Description |
| ------ | --- | ---------- | ----------- |
| GET | api/categories | No parameters | Shows all categories |
| POST | api/categories | <ul><li> name* &ndash; category name;</li><li> description &ndash; category description;</li><li>key* &ndash; category unique key;</li><li>is_active &ndash; category "on/off" status</li></ul>| Create new category. Request has validation on **name** and **key** parameters. Name is required and has max length 30 symbols, key is required and has unique value in `categories` table. If validation fails redirects back, else creates new category.|
| GET | api/categories/{categoryId} | categoryId &ndash; category id from `categories` table | Shows category details |
| PUT | api/categories/{categoryId} | <ul><li>categoryId &ndash; category id from `categories` table</li><li> name* &ndash; category name;</li><li> description &ndash; category description;</li><li>key* &ndash; category unique key;</li><li>is_active &ndash; category "on/off" status</li></ul> | Updates category by id. Request has same validation as create category |
| DELETE | api/categories/{categoryId} |  categoryId &ndash; category id from `categories` table | Soft remove category by id |
| GET | api/products | category_id &ndash; product category id| Shows all products. If  **category_id** specified, filter products by category id|
| POST | api/products | <ul><li> name* &ndash; product name;</li><li> description &ndash; product description;</li><li>price* &ndash; price per unit;</li><li>quantity* &ndash; quantity of exist products</li><li>category_id - category of product</li><li>is_active &ndash; product "on/off" status </li></ul>| Create new product. Request has validation on **name**, **price** and **quantity** parameters. Name is required and has max length 50 symbols, price is required and has minimum value 0, quantity is required and has minimum value 0. If validation fails redirects back, else creates new product.|
| GET | api/products/{productId} | productId &ndash; product id from `products` table | Shows product details |
| PUT | api/products/{productId} | <ul><li>productId &ndash; product id from `products` table</li><li> name* &ndash; product name;</li><li> description &ndash; product description;</li><li>price* &ndash; price per unit;</li><li>quantity* &ndash; quantity of exist products</li><li>category_id - category of product</li><li>is_active &ndash; product "on/off" status </li></ul> | Updates product by id. Request has same validation as create product |
| DELETE | api/products/{productId} |  productId &ndash; product id from `products` table | Soft remove product by id |
| POST | api/order | <ul><li>product_id* - id of ordering product</li><li>quantity* - quantity if ordering product position</li></ul> | Makes order for product if product exist, active and has price
 *\* - required parameters<br>For testing PUT or DELETE method you can use POST request with additional body parameter **_method=PUT** or **_method=DELETE** accordingly.*
