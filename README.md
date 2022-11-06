## Install
````
1) git clone
2) composer install
3) cp .env.example .env
4) Создать БД, заполнить .env
5) php yii migrate
6) php yii serve
````

## Cron
### Для парсинга файлов необходимо добавить в планировщик задач
````
* * * * * /usr/bin/php ${путь_к_проекту}/yii queue/process
````

## API

### Получить список проектов
#### GET /api/v1/projects
````

````