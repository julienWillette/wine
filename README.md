# wine

If You want clone the projet, i explain how step by step

Step 1
you clone the project

Step 2
rm -rf .git

Step 3
Create a new repository on github

Step 4
composer install

Step 5
Yarn install

Step 6
create the .env.local

Step 7
create you database
php bin/console doctrine:database:create

Step 8 
make migration
php bin/console make:migration
php bin/console doctrine:migrations:migrate

Step 9 
symfony server:start

Step 10 
yarn encore dev --watch


the trello: https://drive.google.com/file/d/14IpZOUAkkzr2wrBX1V6RcaVKBwArOulP/view?usp=sharing

the database: https://drive.google.com/file/d/1bj7R04i7BwVKnxvkUNUiBRaRnWTinr_k/view?usp=sharing

