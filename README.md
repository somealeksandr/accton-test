Для початку потрібно з клонувати проект на локальну машину, після чого встановити пакети і залежності composer:

```
composer install
```

далі скопіювати env з env.example:

```
cp env env.example
```

якщо потрібно поміняти конфігурацію бд

```
DB_CONNECTION=mysql
#DB_HOST=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=accton
DB_USERNAME=user
DB_PASSWORD=user12345
```

після чого згенерувати ключ застосунку laravel:

```
php artisan key:generate
```

далі розгорнути контейнери docker:

```
docker-compose up -d
```

після чого запустити міграції для нашої бд:

```
php artisan migrate
```

наша база готова для парсингу даних, команда розпарсить дані з апі та збереже їх в бд:

```
php artisan data:parse
```

далі в мене викикли проблеми з бд)
тому в env я міняв хост щоб ендпоінт запрацював)
для того щоб отримати результат без помилок треба в env поміняти хост з

DB_HOST=127.0.0.1

на

DB_HOST=mysql

по наступному роуті можна отримати результат з компаніями:

http://127.0.0.1:8000/api/companies


