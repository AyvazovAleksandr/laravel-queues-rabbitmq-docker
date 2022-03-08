# Начало работы

## Клонировать репозиторий
```
git clone https://github.com/AyvazovAleksandr/laravel-queues-rabbitmq-docker.git
```

## Перейти в каталог
```
cd laravel-queues-rabbitmq-docker
```

## Переменное окружение (.env), копируем .env.example и переименовываем в .env
### Т.к. это тестовое задание, то файл .env уже настроен, для быстрого запуска

## Запуск контейнеров
```
docker-compose up -d --build
```
---
# Laravel 8
## Переменное окружение (.env), копируем .env.example и переименовываем в .env
### Т.к. это тестовое задание, то файл .env уже настроен, для быстрого запуска


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