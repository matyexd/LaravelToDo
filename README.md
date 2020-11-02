# Документация к API

## Списки дел
### Создание списка дел

При создании списка необходимо передать его имя через **?name=Имя_списка**

Метод POST

``` 
http://laravel1/api/list_of_case/create?name=Имя_списка
```

Пример вывода сущности списка дел

```
{
    "name": "Имя_списка",
    "created_at": "2020-10-22T11:58:29.000000Z",
    "updated_at": "2020-10-22T11:58:29.000000Z",
    "id": 26
}
```

Ошибка

```
{
    "name": [
        "The name field is required."
    ]
}
```



### Редактировать список
Метод PUT

``` 
http://laravel1/api/list_of_case/edit/"id_списка"?name=Имя_списка2
```
Ответ в виде:
``` 
{
    "name": "Имя_списка",
    "created_at": "2020-10-22T11:58:29.000000Z",
    "updated_at": "2020-10-22T11:58:29.000000Z",
    "id": 26
}
```

Ошибка

```
{
    "name": [
        "The name field is required."
    ]
}
```

### Удалить список
Метод DELETE
```
http://laravel1/api/list_of_case/delete/16
```

Ответ:
```
1
```
Если запись не найдена
```
{
    "Error": true,
    "message": "Not found"
}
```

### Просмотреть все списки дел

Метод POST

``` 
http://laravel1/api/list_of_lists/get
```

Функция сортировки **sort**: 1 - по дате создания, 2 - по дате обновления, 3 - по имени, Если не указано - по id  
``` 
http://laravel1/api/list_of_lists/get?sort=3
```

Количество списков - **count**. По умолчанию - 10. Если указано больше 100 - тогда выводится 10 списков
``` 
http://laravel1/api/list_of_lists/get?count=3
```

### Посмотреть все дела определенного списка

Функция сортировки **sort**: 1 - по дате создания, 2 - по дате обновления, 3 - по имени, Если не указано - по id
``` 
http://laravel1/api/list_of_case/get/{id}
```

## Дела

### Создание дела
Метод POST
```
http://laravel1/api/case/create/?name="Имя_дела"&discription="Описание_дела"&urgency="Важность_задания(1-5)"&list_id="id_списка_которому_будет_принадлежать_дело"
```
**name** - обязательный параметр

**discription** - обязательный параметр

**list_id** - обязательный параметр

**urgency** - обязательный параметр

**status** задается автоматически как **False**

Пример вывода:

```
{
    "id": 3,
    "name": "Имя дела",
    "discription": "Описание",
    "urgency": "Срочность(1-5)",
    "status": false,
    "list_id": "ID списка дел",
    "created_at": "Дата создания",
    "updated_at": "Дата обновление дела"
}
```
Ошибка:
```
{
    "Объект": [
        "Сообщение об ошибке"
    ]
}
```

### Показать дело
Метод GET
```
http://laravel1/api/case/get/{id}
```

Пример вывода:

```
{
    "id": 3,
    "name": "Имя дела",
    "discription": "Описание",
    "urgency": "Срочность(1-5)",
    "status": false-true,
    "list_id": "ID списка дел",
    "created_at": "Дата создания",
    "updated_at": "Дата обновление дела"
}
```

Ошибка:

```
{
    "Error": true,
    "message": "Not found"
}
```

### Редактирование дела
Метод PUT
```
http://laravel1/api/case/edit/{id}?name="Имя_дела"&discription="Описание_дела"&urgency="Важность_задания(1-5)"&list_id="id_списка_которому_будет_принадлежать_дело"&status="True_или_False"
```

Пример успешного ответа

``` 
true
```

Пример ошибки:
```
{
    "Объект": [
        "Сообщение об ошибке"
    ]
}
```

Если запись не найдена
```
{
    "Error": true,
    "message": "Not found"
}
```



### Удалить дело
Метод DELETE
```
http://laravel1/api/case/delete/{id}
```

Ответ:
```
1
```
Если запись не найдена
```
{
    "Error": true,
    "message": "Not found"
}
```

### Пометить дело как сделанное
Метод GET
```
http://laravel1/api/case/mark-done/{id}
```

Ответ:
```
[
    "Done"
]
```
Если запись не найдена
```
{
    "Error": true,
    "message": "Not found"
}
```


