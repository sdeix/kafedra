## 1. Перейдите в директорию deploy
# cd deploy
## 2. Запустите контейнеры Docker в фоновом режиме
# docker compose up -d
## 3. Обновите пакеты Composer
# docker compose run php composer update
## 4. Выполните миграции базы данных с помощью Artisan
# docker compose run artisan migrate
## 5. Заполните базу данных тестовыми данными
# docker compose run artisan db:seed