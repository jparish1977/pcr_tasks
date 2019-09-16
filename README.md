# pcr_tasks
This site was built under the Laraven homestead environment running under Windows 10

The ,env.example specifies a database named "pcr_tasks" this schema must be created

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

