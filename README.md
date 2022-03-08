# Начало работы

## Переменное окружение (.env), копируем .env.example и переименовываем в .env
### Windows
```
copy .env.example .env
```
### Linux
```
cp .env.example .env
```

### Пример
```yaml
# Configuration
PROJECT_PREFIX_DEV=project_dev
# MYSQL Password
DB_ROOT_PASSWORD_DEV=secret
# Connection DB
DB_CONNECTION_DEV=mysql
DB_HOST_DEV=127.0.0.1
DB_PORT_DEV=3306
DB_DATABASE_DEV=database
DB_USERNAME_DEV=username
DB_PASSWORD_DEV=secret
# Network
NETWORK_NAME_DEV=project_network_dev
NETWORK_IP_DEV="172.20.300.0/24"
NGINX_NETWORK_IP_DEV="172.20.300.10"
# для локальной разработки ставить 0.0.0.0
EXTERNAl_IP_DEV=0.0.0.0
# NGINX
# разделитель пробел
NGINX_CONF_SERVER_NAMES_DEV='example.com www.example.com'
```

## Запуск контейнеров
```
docker-compose up -d --build
```

## Устанока Laravel 8 версии 
```
docker-compose run --rm composer create-project laravel/laravel=8.6.11 .
```

## Установка библиотеки для работы с rabbitmq
```
docker-compose run --rm composer require vladimir-yuldashev/laravel-queue-rabbitmq=11.3.0
```

## Проверить очередь в rabbitmq
```
docker exec -it project_dev_rabbitmq rabbitmqctl list_queues
```

## Запуск работы rabbitmq с очередями
```
docker-compose run --rm artisan queue:work rabbitmq --queue=high,middle,low
```

---
# Доступы к сервисам
## Rabbit-manager
http://rabbitmq.local:15672/


# Сборка для работы Laravel в Docker

## Список сервисов
* nginx
* mysql
* phpmyadmin
* php
* composer
* npm
* artisan

---
## Порты
Порты используемые в проекте:

| Сервис | Порт |
|--------|----- |
| **nginx** | 80 (внешний) |
| **nginx** | 443 (внешний) |
| **phpmyadmin** | 8081 (внешний) |
| **mysql** | 3306 (внутренний) |
| **php** | 9000 (внутренний) |
| **xdebug** (только в dev) | 9001 (внешний) |
| **redis** | 6379 (внутренний) |

---
## Как работать

Для начала убедитесь, что у вас есть [Docker installed](https://docs.docker.com/) в вашей системе и [Docker Compose](https://docs.docker.com/compose/install/), а затем клонировать этот репозиторий.

1. Клонировать этот проект:

   ```sh
   git clone https://github.com/AyvazovAleksandr/docker-laravel-environment.git
   ```

2. Внутри каталога `docker-laravel-environment` создать файл `.env` для создания докера с помощью следующей команды:

   ```sh
   cp .env.example .env
   ```

3. Вам нужно **Создать** или **Скопировать** ваш проект в папку **www**


4. Соберите проект с помощью следующих команд:

   ```sh
   docker-compose -f docker-compose.dev.yml up -d --build
   ```

---

## Помните

Конфигурация базы данных **должно быть одинаково с обеих сторон** .

```dotenv
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password
DB_ROOT_PASSWORD=secret
```

```dotenv
# source/.env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password
```

Единственным изменением является `DB_HOST` в `source/.env` где вызывается контейнер `mysql`:

```dotenv
# source/.env
DB_HOST=mysql
```

---

## Особые случаи
В примерах указывается dev среда.

В проекте есть три среды:
* PROD ***docker-compose.prod.yml***
* BETA ***docker-compose.beta.yml***
* DEV ***docker-compose.dev.yml***

### Установка нового проекта (в примере устанавливаем версию Laravel 8.6.11)
```sh
docker-compose -f docker-compose.dev.yml run --rm composer create-project laravel/laravel=8.6.11 .
```
### Установить библиотеки из Composer
```sh
docker-compose -f docker-compose.dev.yml run --rm composer install
```

### Установить библиотеки с Node

```sh
docker-compose -f docker-compose.dev.yml run --rm npm install
```

### Чтобы отключить и удалить тома, мы используем следующую команду:

```sh
docker-compose -f docker-compose.dev.yml down -v
```

### Обновить композитор:

```sh
docker-compose -f docker-compose.dev.yml run --rm composer update
```

### Запустить компилятор (Webpack.mix.js) или показать компилятор представления в узле:

```sh
docker-compose -f docker-compose.dev.yml run --rm npm run dev
```

### Выполнить все миграции:

```sh
docker-compose -f docker-compose.dev.yml run --rm artisan migrate
```

### Очистка кэша проекта

```sh
docker-compose run --rm artisan clear:data
docker-compose run --rm artisan cache:clear
docker-compose run --rm artisan view:clear
docker-compose run --rm artisan route:clear
docker-compose run --rm artisan clear-compiled
docker-compose run --rm artisan config:cache
docker-compose run --rm artisan storage:link
```
---

## Надо обязательно сделать после первого запуска нового проекта

### Сгенерировать ключи

```sh
docker-compose run --rm artisan key:generate
```

### Запустить миграции с данными

```sh
docker-compose -f docker-compose.dev.yml run --rm artisan migrate --seed
```

### Запуск паспорта (необязательно)

```sh
docker-compose -f docker-compose.dev.yml run --rm artisan passport:install
```

----------------------------------------------------------------


---


---




