<h1>Dynamic Form</h1>

Steps to setup:
1. `.env` is already included, just need to create a database with name `cp360` in the server. Or modify `.end` according to needs.
2. Run following commands in the artisan: `composer install`, `php artisan migrate`, `php artisan db:seed`, `php artisan serve`
3. Open the link in browser, and login using `login` in navbar. Username: `admin@cp360.com`, Password: `password`.
4. Logged in user can create/edit/delete fields by clicking on `fields` in the navbar.
5. Logged in user can view submitted forms by clicking on `forms` in the navbar.
6. Logged in user can logout by clicking on `logout` in the navbar.
7. Guest users can fill the form on the homepage (can also go by clicking on the navbar brand `Dynamic Form`).

Notes:
1. Registration Code is there, but disabled. 
2. Field types available now: `text`, `number`, `password`, `email`, `select`, `checkbox`

Thank you!
