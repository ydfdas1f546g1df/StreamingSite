# List

## For Administrative Users

You must use the token which was created before

```POST /api/users```

```
[
  {
    "id": 1,
    "username": "jack_smith",
    "is_admin": false,
    "name": "Jack Smith",
    "bio": "",
    "created_at": "2012-05-23T08:00:58Z",
    "avatar_url": "http://localhost.com/dist/pic/e32131cd8.jpeg",
    "web_url": "http://localhost/jack_smith"
  },
  {
    "id": 2,
    "username": "jack_j",
    "is_admin": true,
    "name": "Jack J.",
    "bio": "Im the Real Jack",
    "created_at": "2015-05-23T08:00:58Z",
    "avatar_url": "http://localhost.com/dist/pic/e32131cd8.jpeg",
    "web_url": "http://localhost/jack_smith"
  }
]
```

You can also use ?search= to search for users by name, username, or public email. For example, /users?search=John. When
you search for a:
<ul>
<li>Public email, you must use the full email address to get an exact match. A search might return a partial match. For example, if you search for the email on@example.com, the search can return both on@example.com and jon@example.com.</li>
<li>Name or username, you do not have to get an exact match because this is a fuzzy search.</li>
</ul>
In addition, you can lookup users by username:

```
POST /api/users?username=:username
```
| Atrribute | Required |              Description |
|:----------|:--------:|-------------------------:|
| token     |   Yes    | Is Used to Identify User |

```token is saved in Cokkies```

# Register

```
POST /api/register
```

| Atrribute | Required |                           Description |
|:----------|:--------:|--------------------------------------:|
| token     |   Yes    | Is Used to Identify User is in Cookie |
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
POST /api/login

```

| Atrribute | Required |        Description |
|:----------|:--------:|-------------------:|
| Username  |   Yes    |           Username |
| Password  |   Yes    | Password as SHA256 |

```
[
    {
        "token" : ":token"
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