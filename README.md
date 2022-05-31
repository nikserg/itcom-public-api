# nikserg/itcom-public-api

Публичный API для работы с CRM Айтиком

## Установка

`composer require nikserg/itcom-public-api`

## Использование

```php
$client = new \nikserg\ItcomPublicApi\Client('<bearer token>');
$createdCertificate = $client->createOrUpdate(['EPGU']);
echo $createdCertificate->id; //ID созданной заявки

$client->createOrUpdate(['EPGU'], $createdCertificate->id, 'new name'); //Обновление заявки
```

## Тестирование

Чтобы система не отправляла реальные запросы, можно вместо класса `\nikserg\ItcomPublicApi\Client` использовать
класс `\nikserg\ItcomPublicApi\MockClient`