# All users

```
POST /api/admin_rm_user.php

```

| Atrribute | Required |        Description |
|:----------|:--------:|-------------------:|
| token     |   Yes    |    Token from user |

```
[
    {
        "id": 1,
        "name": "Hans Peter",
        "username": "hanspeter",
        "admin": 1,
        "email": "hans.peter@gmail.com",
    }
]

```

else

```
[
    {
        error: `message`
    }
]
```

# Edit User

```
POST /api/admin_edit_user.php

```

| Atrribute | Required |                Description |
|:----------|:--------:|---------------------------:|
| token     |   Yes    |            Token from user |
| id        |   Yes    |       id of to delete user |
| username  |   Yes    | username of to delete user |
| name      |   Yes    |     name of to delete user |
| email     |   Yes    |    email of to delete user |
| admin     |   Yes    |    admin of to delete user |



```
[
    {
        error: `message`
    }
]
```