# Requirements
* git
* php 8
* composer
* nodejs

# Install Instructions

1. `git clone git@github.com:shaheenfawzy/album-manager`
2. `cd album-manager`
3. `composer install`
4. `cp .env.example .env`
5. `php artisan key:generate`
6. `php artisan migrate`
7. `npm install`
8. `npm run build`
9. `php artisan serve`
10. visit [localhost:8000](http://localhost:8000)
11. Register a new user & navigate to albums page
