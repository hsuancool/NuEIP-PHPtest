## Laradock Environment
* PHP Version: 7.3.15
* Laravel Framework Version: 6.17.1
* Database: MySQL 5.7

## Getting Started
### Prerequisites

- Download and install [Docker for Mac](https://download.docker.com/mac/stable/Docker.dmg)

### Step 1 - Clone repository
    git clone https://github.com/hsuancool/NuEIP-PHPtest.git
    
### Step 2 - Submodule
    git submodule init
    git submodule update
  
### Step 4 - Setting env
    cp env.example .env
   setup .env DATABASE from laradock .env
   
    cd laradock
    cp env-example .env

### Step 5 - Run docker
    cd laradock
    docker-compose up -d nginx mysql
    docker-compose exec workspace bash

### Step 6 - Setting data
    composer install
    php artisan migrate
    php artisan db:seed
    
### Step 7 - Done
- [Test page](http://localhost)
