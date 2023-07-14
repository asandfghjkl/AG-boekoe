# Boekoe.
A bookstore website, using laravel framework, bootstrap and mysql.


## features
- login, register
- show all books and each details
- cart
- show books by categories or authors
- search book
- check out cart and make order
- check order details
- admin dashboard
  
### role
 - admin
     - manage books, categories, authors, orders, reviews
     - admin dashboard (only admin can access)
            
 - user
     - search books by name, author or categories
     - order the book(s) and view their order details
     - submit reviews
     - cart feature
 
 ### Development
 
 This project developed with
 - [Laravel](https://laravel.com/)
 - [Bootstrap-4](https://getbootstrap.com/docs/4.3/getting-started/introduction/)
 - SB-Admin-2
 - JavaScript, jQuery
 - MySql
 - [Laravel ShoppingCart](https://github.com/bumbummen99/LaravelShoppingcart)
 
### How to run
- setup .env file (check database and port of the localhost)
- composer update
- php artisan key:generate
- php artisan migrate (to migrate database)
- php artisan db:seed 
- php artisan serve
