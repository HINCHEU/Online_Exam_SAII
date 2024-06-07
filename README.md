### git

1. Clone From Github
    url: git clone

2. Install Vendor by using composer
    cmd: composer install --ignore-platform-reqs
    
    cmd: cp .env.example .env
    
    cmd: php artisan key:generate

3. Connect Project to database (.env)

4. Migrate Database
    cmd: php artisan migrate:fresh --seed

5. Have fun
    cmd: php artisan serve