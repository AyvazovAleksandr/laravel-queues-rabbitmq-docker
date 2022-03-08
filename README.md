# Начало работы

## Клонировать репозиторий
```
git clone https://github.com/AyvazovAleksandr/laravel-queues-rabbitmq-docker.git
```

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
---
# Laravel 8
## Т.к. это тестовое задание, то файл .env уже настроен, для быстрого запуска

## Добавьте в hosts запись
```
127.0.0.1 rabbitmq.local
```


## Установка библиотек
```
docker-compose run --rm composer install
```
## Сгенерировать ключи

```sh
docker-compose run --rm artisan key:generate
```

## Запустить миграции с данными

```sh
docker-compose run --rm artisan migrate
```
---
# Команды для работы

## Сгенерировать задания, перейти по ссылке

http://rabbitmq.local/rabbitmq

## Проверить очередь в rabbitmq
```
docker exec -it project_dev_rabbitmq rabbitmqctl list_queues
```

## Запуск работ rabbitmq с очередями
```
docker-compose run --rm artisan queue:work rabbitmq --queue=high,middle,low
```