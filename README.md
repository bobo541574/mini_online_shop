## Mini Online Shop

These following steps are needed for fresh installation project.

- git clone https://github.com/bobo541574/mini_online_shop.git
- cd mini_online_shop/
- php artisan key:generate
- cp .env.example .env
- DB_DATABASE=your_database_name => eg, online_shop
- DB_USERNAME=username => eg, root
- DB_PASSWORD=password => eg,
- php artisan migrate
- php artisan permission:fresh
- php artisan permission:assign
- php artisan db:seed
