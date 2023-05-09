# All Series

```
POST /api/all_series.php

```

| Attribute | Required |         Description |
|:----------|:--------:|--------------------:|
| nothing   |    no    | nothing is required |

```
[
    {
        "name": "vinland-saga",
        "showName": "Vinland Saga",
        "watchlist": 4,
        "watched": 9,
        "language": "german",
        "regisseur": "Hans Peter",
    }
]

```

else

```
[
    {
        "error": "message",
    }
]
```
# Popular Series

```
POST /api/popular_series.php

```

| Attribute | Required |  Description |
|:----------|:--------:|-------------:|
| series    |    no    |  series name |

```
[
    {
        "name": "vinland-saga",
        "showName": "Vinland Saga",
        "watched": 1,
        "watchlist": 2,
        "desc": "description",
    }
]

```

else

```
[
    {
        "error": "message",
    }
]
```

# Latest Uploads

```
POST /api/latest_upload.php

```

| Attribute | Required |         Description |
|:----------|:--------:|--------------------:|
| nothing   |    no    | nothing is required |

```
[
    {
        "name": "vinland-saga",
        "upload": "22-01-2007",
        "showName": "Vinland Saga",
        "episode": 1,
        "season": 2,
    }
]

```

else

```
[
    {
        "error": "message",
    }
]
```