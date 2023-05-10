# Upload
```
POST /api/upload_Complete
```

| Attribute   | Required | Description                   |
|-------------|:--------:|:------------------------------|
| token       |   Yes    | Is Used to Identify User      |
| series      |   Yes    |                               |
| episode     |   Yes    | Episode                       |
| season      |   Yes    | Season                        |
| showName    |   Yes    | Is the name shown to the user |
| description |    No    | Description                   |
| language    |   Yes    | Language                      |

Response Code 200 if OK

**else**

```
[
    {
        error: `message`
    }
]
```

```
POST /api/uploadFile
```
| Attribute   | Required | Description                   |
|:------------|:--------:|:------------------------------|
| token       |   Yes    | Is Used to Identify User      |
| series      |   Yes    |                               |
| episode     |   Yes    | Episode                       |
| season      |   Yes    | Season                        |

Response Code 200 if OK

else

```
[
    {
        error: `message`
    }
]
```

# Edit Episode

```
POST /api/update
```

| Attribute   | Required |                   Description |
|:------------|:--------:|------------------------------:|
| token       |   Yes    |      Is Used to Identify User |
| name        |   Yes    |                               |
| showName    |    No    | Is the name shown to the user |
| description |    No    |                   Description |
| language    |    No    |                      Language |


Response Code 200 if OK

else

```
[
    {
        error: `message`
    }
]
```

# List

## List Series

```GET /api/series```

```
[
  {
    "id": 1,
    "name": "xy",
    "showName" : "X Y",
    "description": "",
    "seasons": 2,
    "episodes": {
        "1": 5,
        "2": 5
    }
    "regisseur": "xy"
    
  }
]
```

You can also use ?search= to search for users by name. For example, /videos?search=x. When
you search for a:
<ul>
<li>Name, you do not have to get an exact match because this is a fuzzy search.</li>
</ul>

## List Episodes

```GET /api/episodes?series=:series&season=:season&episode=:season```

```
[
  {
    "id": 1,
    "name": "xy",
    "showName" : "X Y",
    "description": "",
    "season": 2,
    "episode": 5,
    "regisseur": "xy",
    "watchcount": 10,
    "upload": 2023-03-27
  }
]
```

You can also use ?search= to search for users by name. For example, /videos?search=x. When
you search for a:
<ul>
<li>Name, you do not have to get an exact match because this is a fuzzy search.</li>
</ul>

# Create series

```
POST /api/create
```

| Atrribute   | Required |                   Description |
|:------------|:--------:|------------------------------:|
| token       |   Yes    |      Is Used to Identify User |
| name        |   Yes    |                               |
| showName    |    No    | Is the name shown to the user |
| description |    No    |                   Description |
| regisseur   |    No    |                     Regisseur |
| genre       |    No    |                         Genre |
| language    |    No    |                      Language |

Response Code 200 if OK

else

```
[
    {
        error: `message`
    }
]
```

# Edit Series
```
POST /api/updateS
```

| Atrribute   | Required |                   Description |
|:------------|:--------:|------------------------------:|
| token       |   Yes    |      Is Used to Identify User |
| name        |   Yes    |                               |
| showName    |    No    | Is the name shown to the user |
| description |    No    |                   Description |
| regisseur   |    No    |                     Regisseur |
| genre       |    No    |                         Genre |
| language    |    No    |                      Language |


Response Code 200 if OK

else

```
[
    {
        error: `message`
    }
]
```