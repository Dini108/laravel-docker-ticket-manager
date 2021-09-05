## Laravel MySQL Docker JQuery DataTable Event-Manager

### Description
### How to run this project

To run this project you need to have docker and docker-compose installed in your machine.

Take the following steps:

- clone repository: 'git clone https://github.com/Dini108/laravel-docker-event-manager'
- change directory: 'cd laravel-docker-event-manager'
- 'docker-compose build'
- 'docker-compose up -d'
- 'docker exec -it event-manager-app bash'
- 'composer install'
- 'npm install'
- 'npm run dev'

- create an '.env' file from '.env.example'

- 'php artisan key:generate'
- 'php artisan migrate'
- 'php artisan db:seed'

Webpage path: http://localhost

Example User: user@example.com/password, or you can create one at http://localhost/register.