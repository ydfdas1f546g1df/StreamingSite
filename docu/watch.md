# Add to Watchlist

```
POST /api/add_watchlist.php

```

| Attribute | Required | Description |
|:----------|:--------:|------------:|
| token     |   Yes    |  user token |
| name      |   Yes    | Series name |

Response Code 200 if OK
```
[
    {
        "error": "message"
    }
]

```
# Remove from Watchlist

```
POST /api/remove_watchlist.php

```

| Attribute | Required | Description |
|:----------|:--------:|------------:|
| token     |   Yes    |  user token |
| name      |   Yes    | Series name |

Response Code 200 if OK
```
[
    {
        "error": "message"
    }
]

```
# User Watchlist

```
POST /api/req_user_wl.php

```

| Attribute | Required |      Description |
|:----------|:--------:|-----------------:|
| username  |   yes    | username of user |

```
[
    {
        "name": "vinland-saga",
        "showName": "Vinland Saga",
    },    
    {
        "name": "demon-slayer",
        "showName": "Demon Slayer",
    },
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
# User Watched

```
POST /api/req_user_wd.php

```

| Attribute | Required |      Description |
|:----------|:--------:|-----------------:|
| username  |   yes    | username of user |

```
[
    {
        "name": "vinland-saga",
        "showName": "Vinland Saga",
        "episodes": 3,
        "episode": 1,
        "seasons": 2,
        "season": 1,
    },    
    {
        "name": "demon-slayer",
        "showName": "Demon Slayer",
        "episodes": 5,
        "episode": 2,
        "seasons": 3,
        "season": 2,
    },
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