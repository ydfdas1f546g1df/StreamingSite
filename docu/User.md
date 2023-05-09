# List
You must use the token which was created before

```GET /api/users```

```
[
  {
    "id": 1,
    "username": "jack_smith",
    "is_admin": false,
    "name": "Jack Smith",
    "bio": "",
    "created_at": "2012-05-23T08:00:58Z",
    "watched": 1,
    "watchlist": 2
  },
  {
    "id": 2,
    "username": "jack_j",
    "is_admin": true,
    "name": "Jack J.",
    "bio": "Im the Real Jack",
    "created_at": "2015-05-23T08:00:58Z",
    "watched": 1,
    "watchlist": 2
  }
]
```

You can also use ?u= to search for users by name, or public email. For example, /users?u=John. When
you search for a:
<ul>
<li>Public email, you must use the full email address to get an exact match. A search might return a partial match. For example, if you search for the email on@example.com, the search can return both on@example.com and jon@example.com.</li>
<li>Name or username, you do not have to get an exact match because this is a fuzzy search.</li>
</ul>
In addition, you can lookup users by username:

```
POST /api/users?u=username
```


```token is saved in Cokkies```

# Register

```
POST /api/register
```

| Attribute | Required |                           Description |
|:----------|:--------:|--------------------------------------:|
| bio       |    No    |                      User’s biography |
| email     |   Yes    |                                 Email |
| username  |   Yes    |                              Username |
| name      |   Yes    |                          Name on Site |

Response Code 200 if OK

else

```
[
    {
        error: `message`
    }
]
```

# Login

```
POST /api/login.php

```

| Attribute | Required |        Description |
|:----------|:--------:|-------------------:|
| Username  |   Yes    |           Username |
| Password  |   Yes    | Password as SHA256 |

```
[
    {
        "token": "token"
    }
]

```


Response Code 200 if OK

else

```
[
    {
        error: `message`
    }
]
```

# Profile Data

```
POST /api/req_user_wl.php

```

| Attribute | Required |      Description |
|:----------|:--------:|-----------------:|
| username  |   yes    | username of user |

```
[
    {
        "name": "Hans Peter",
        "username": "hanspeter",
        "watched": 2,
        "watchlist": 1,
        "bio": "This is the Best Website",
        "admin": 1,
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



