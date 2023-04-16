## Генерация номеров карты

- Реализовать api метод generateCard – описание ниже.
- Реализовать нагрузочный (и проверяющий) тест на этот метод.
- Тест должен генерить, например 1000 одновременных запросов – и
  проверять, что номера карт не перемешались.

## Описание endpoints

### GET /api/generate_card/{bin} - генерация одного серийного номера карты, с указанием кода предприятия.

- bin - заданное начало номера карты, шести значное число.

**Responses**:

**_status 200_**

```
{   
    "status": 200,
    "messages": "Запрос успешно выполнен",
    "data": $cardRecord
    "data": [
        {
            "id": 8,
            "bin_card": "123456",
            "number_card": "0000000001",
            "full_number_card": "1234560000000001",
            "created_at": "2022-11-03T12:50:32.000000Z"
            "updated_at": "2022-11-03T12:50:32.000000Z"
        }
    ]    
}
```

## Запуск тестов

```
php artisan test
```


## Общие требования к работе метода

Реализуемый api метод должен генерировать новый номер карты для пользователя по
заданному началу номера карты и сохранять полученный результат в базу (формат
таблицы – на усмотрение разработчика)

Требования к номеру карты

- Общая длина номера карты должна составлять 16 символов
- Номер карты содержит только цифры
- Все номера карт одного предприятия начинаются на один и тот же БИН – первые 6
  цифр номера


При вызове api метода – решение должно генерировать строго последовательные
номера карт.

Важно помнить, что метод генерации номера карты может вызываться одновременно
несколькими пользователями, при этом – все равно необходимо добиться того, чтобы
номера карт не повторялись и шли строго последовательно.


