# Тестовое задание
1) Распределить классы, при работе системы на три группы и добавить их в очередь
* high
* middle
* low
2) Выполнить все отложенные работы, согласно последовательность очередей high,middle,low
3) В качестве сервиса хранения очередей, использовать RabbitMQ
4) Сделать сборку докера, для запуска задания
---
# Начало работы

## Клонировать репозиторий
```sh
git clone https://github.com/AyvazovAleksandr/laravel-queues-rabbitmq-docker.git
```

## Перейти в каталог
```sh
cd laravel-queues-rabbitmq-docker
```

## Переменное окружение (.env), копируем .env.example и переименовываем в .env
### Т.к. это тестовое задание, то файл .env уже настроен, для быстрого запуска

## Запуск контейнеров
```sh
docker-compose up -d --build
```
---
# Laravel 8
## Переменное окружение (.env), копируем .env.example и переименовываем в .env
### Т.к. это тестовое задание, то файл .env уже настроен, для быстрого запуска


## Добавьте в hosts запись
```sh
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
```sh
docker exec -it project_dev_rabbitmq rabbitmqctl list_queues
```
## Результат, видно, что мы мы сгенерировали 123 записи в каждой очереди, суммарно 369
```sh
Timeout: 60.0 seconds ...
Listing queues for vhost / ...
name    messages
low     123
middle  123
high    123
```

## Запуск работ rabbitmq с очередями
```sh
docker-compose run --rm artisan queue:work rabbitmq --queue=high,middle,low
```
## Результат, показан список выполненных работ
```sh
Creating laravel-queues-rabbitmq-docker_artisan_run ... done
[2022-03-08 17:31:01][acbc78cc-27c6-48e8-bdf3-714d8b7dfeb8] Processing: App\Jobs\ProcessPriority
[2022-03-08 17:31:16][acbc78cc-27c6-48e8-bdf3-714d8b7dfeb8] Processed:  App\Jobs\ProcessPriority
[2022-03-08 17:31:16][17581104-767f-4ac8-9814-abab3c2c3520] Processing: App\Jobs\ProcessPriority
```

## Финальный результат
### В ходе работы мы занесли в БД в таблицу random_counters записи и соблюдаем приоритете очередей

| id  | queue_random | created_at          | updated_at          |
| --- | ------------ | ------------------- | ------------------- |
| 11  | high - 12    | 2022-03-08 16:48:09 | 2022-03-08 16:48:09 |
| 12  | high - 14    | 2022-03-08 16:48:23 | 2022-03-08 16:48:23 |
| 13  | high - 6     | 2022-03-08 16:48:29 | 2022-03-08 16:48:29 |
| 14  | high - 5     | 2022-03-08 16:50:11 | 2022-03-08 16:50:11 |
| 15  | high - 13    | 2022-03-08 16:50:24 | 2022-03-08 16:50:24 |
| 16  | high - 10    | 2022-03-08 16:50:34 | 2022-03-08 16:50:34 |
| 17  | high - 5     | 2022-03-08 16:50:39 | 2022-03-08 16:50:39 |
| 18  | high - 12    | 2022-03-08 16:50:51 | 2022-03-08 16:50:51 |
| 19  | high - 13    | 2022-03-08 16:51:04 | 2022-03-08 16:51:04 |
| 20  | high - 10    | 2022-03-08 16:51:11 | 2022-03-08 16:51:11 |
| 21  | high - 3     | 2022-03-08 16:51:14 | 2022-03-08 16:51:14 |
| 22  | high - 3     | 2022-03-08 16:51:17 | 2022-03-08 16:51:17 |
| 23  | high - 14    | 2022-03-08 17:31:16 | 2022-03-08 17:31:16 |
| 24  | high - 11    | 2022-03-08 17:31:27 | 2022-03-08 17:31:27 |
| 25  | high - 14    | 2022-03-08 17:31:41 | 2022-03-08 17:31:41 |
| 26  | high - 14    | 2022-03-08 17:31:55 | 2022-03-08 17:31:55 |
| 27  | high - 10    | 2022-03-08 17:32:05 | 2022-03-08 17:32:05 |
| 28  | high - 15    | 2022-03-08 17:32:20 | 2022-03-08 17:32:20 |
| 29  | high - 9     | 2022-03-08 17:32:29 | 2022-03-08 17:32:29 |
| 30  | high - 4     | 2022-03-08 17:32:33 | 2022-03-08 17:32:33 |
| 31  | high - 9     | 2022-03-08 17:32:42 | 2022-03-08 17:32:42 |
| 32  | high - 7     | 2022-03-08 17:32:49 | 2022-03-08 17:32:49 |
| 33  | high - 14    | 2022-03-08 17:33:03 | 2022-03-08 17:33:03 |
| 34  | high - 10    | 2022-03-08 17:33:13 | 2022-03-08 17:33:13 |
| 35  | high - 12    | 2022-03-08 17:33:25 | 2022-03-08 17:33:25 |
| 36  | high - 7     | 2022-03-08 17:33:32 | 2022-03-08 17:33:32 |
| 37  | high - 3     | 2022-03-08 17:33:35 | 2022-03-08 17:33:35 |
| 38  | high - 6     | 2022-03-08 17:33:41 | 2022-03-08 17:33:41 |
| 39  | high - 13    | 2022-03-08 17:33:54 | 2022-03-08 17:33:54 |
| 40  | high - 6     | 2022-03-08 17:34:00 | 2022-03-08 17:34:00 |
| 41  | high - 7     | 2022-03-08 17:34:07 | 2022-03-08 17:34:07 |
| 42  | high - 12    | 2022-03-08 17:34:19 | 2022-03-08 17:34:19 |