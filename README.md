![PHPUnit](https://github.com/artem-prozorov/FFA/workflows/PHPUnit/badge.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/artem-prozorov/FFA/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/artem-prozorov/FFA/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/artem-prozorov/FFA/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

# FFA

Диаграмма сущностей - https://docs.google.com/drawings/d/1A8X6MKnxCS1rBP19upB2uSX4XvWfTg7CfL97f1Q8eoA

## Как развернуть локально
```
make build
make prepare-app
```

Команды Makefile:
`build` - собрать контейнеры
`up` - запустить контейнеры
`down` - остановить контейнеры
`migrate` - применить миграции
`run-tests` - запустить тесты PHPUnit

Теперь проект будет доступен по адресу http://localhost
