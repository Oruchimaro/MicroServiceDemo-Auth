# Message Service

## Setup

### regular setup
```bash
    git clone <Message Repo> auth

    cd auth && cp .env.example .env

    composer install

    php artisan key:generate

    php artisan migrate --seed

    php artisan passport:install --force

    php artisan serve --port=3000
```

### using docker

```bash
    git clone <Message Repo> auth

    cd auth && cp .env.example .env
    
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

    sail up -d

    sail artisan migrate --seed

    sail artisan passport:install --force
```


## Usage

- Login endpoint : `` POST http://localhost:3000/api/auth/login ``
    - headers
        - Accept: application/json
        - Content-Type: application/json
    - body params :
        - mobile (string)
        - password (string)

    - response :
        - status : 200
        - body 
            - server_time
            - data: {
                - user : {
                    "id"
                    "name"
                    "uuid"
                    "mobile"
                }
                - token
            }
            
        - status : 404
        - body :
            - server_time
            - message


- Logout endpoint : `` POST http://localhost:3000/api/auth/logout ``
    - headers
        - Accept: application/json
        - Content-Type: application/json
        - Authorization: Bearer <token>

    - response :
        - status : 200
        - body 
            - server_time
            - message