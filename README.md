# About

    Online Exam System is a system that allow teacher to create exam for doing with student.
    This is laravel 10 intergrate with laravel breez 
***




## Git Clone

1. Clone From Github
    ```cmd
     git clone https://github.com/HINCHEU/Online_Exam_SAII.git
    ```

    

2. Install Vendor by using composer
    ```cmd: 
    composer install --ignore-platform-reqs
    ```
    
    ```cmd: 
    cp .env.example .env
    ```
    ```cmd: 
    php artisan key:generate
    ```
    ```npm
    npm install
    ```

3. Connect Project to database (.env)

4. Migrate Database

    (create mysql database name : online_exam_db )
    ```cmd: 
    php artisan migrate:fresh --seed
    ```
    ```npm run dev
     npm run dev
    ```
    

5. Have fun
    ```cmd: 
    php artisan serve
    ```
 ---
# Code Document   
### ERROR MESSAGE ALTER
```php
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </section>
```


