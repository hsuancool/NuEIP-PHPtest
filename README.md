### Step 1 - Install Docker on Mac

- Download and install [Docker for Mac](https://download.docker.com/mac/stable/Docker.dmg)

### Step 2 - Composer
    composer install
    composer dump-autoload
    
### Step 3 - Run docker
    cd laradock
    docker-compose up -d nginx mysql

### Step 4 - Run seeder
    php artisan db:seed
    
### Step 5 - Done
- [Test page](http://localhost)