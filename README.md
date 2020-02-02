# FFA
Experiment

Диаграмма сущностей - https://docs.google.com/drawings/d/1A8X6MKnxCS1rBP19upB2uSX4XvWfTg7CfL97f1Q8eoA

Для разворачивания проекта нужно склонить репозиторий.

Запустить composer install в папке с проектом.

Затем нужно копировать файл .env.example сюда же и переименовать в .env. Заменить в нем настроки для БД sqlite.

Затем нужно применить миграции командой - php artisan migrate
