<p align="center"><img src="https://uc-itcom.ru/themes/custom/itcom2/img/logo.svg" /></p>
<p align="center"><img src="https://scrutinizer-ci.com/g/nikserg/itcom-public-api/badges/quality-score.png?b=main" />
<img src="https://scrutinizer-ci.com/g/nikserg/itcom-public-api/badges/code-intelligence.svg?b=main" />
<img src="http://poser.pugx.org/nikserg/itcom-public-api/require/php)](https://packagist.org/packages/nikserg/itcom-public-api" /></p>

# Публичный API для работы с CRM Айтиком

## Установка

`composer require nikserg/itcom-public-api`

## Использование

В API есть два режима авторизации:

- Как пользователь, с использованием bearer-токена пользователя. В таком случае API имеет доступ ко всем заявкам, к
  которым имеет доступ пользователь.
- Для доступа только к одной заявке, с использованием ее ID и токена доступа. В таком случае, создание новых заявок
  будет недоступно, и доступ будет только к одной заявке.

Для первого режима используется класс `UserClient`, для второго - `IndividualRequestClient`.

Пример использования с авторизацией как пользователь:
```php
$client = new \nikserg\ItcomPublicApi\BaseClient('<bearer token>');
$createdCertificate = $client->createOrUpdate(['EPGU']);
echo $createdCertificate->id; //ID созданной заявки

$client->createOrUpdate(['EPGU'], $createdCertificate->id, 'new name'); //Обновление заявки
```

## Тестирование

Чтобы система не отправляла реальные запросы, можно вместо класса `\nikserg\ItcomPublicApi\UserClient` использовать
класс `\nikserg\ItcomPublicApi\MockUserClient`.

@todo Сделать аналогичное для `IndividualRequestClient`.
