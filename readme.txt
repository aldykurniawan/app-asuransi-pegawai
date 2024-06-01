# requirement
1. php 8.1
2. nodejs v18 (min)
3. mysql

# command after clone

1. composer install
2. npm install
3. cp .env.example .env
4. open .env 
5. edit field DB_DATABASE={nama database}
6. php artisan key:generate
7. php artisan migrate:fresh --seed
8. php artisan serve 
9. npm run dev (run bersamaan php artisan serve)
10. login username: superadmin/admin | password: admin123