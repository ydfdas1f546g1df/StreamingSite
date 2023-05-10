# Create Series

```
POST /api/createSeries.php

```

| Attribute | Required |                Description |
|:----------|:--------:|---------------------------:|
| token     |   Yes    |            Token from user |
| Series    |   Yes    | The showName of the Series |

```
[
    {
        error: `message`
    }
]
```

# Create Season

```
POST /api/createSeason.php

```

| Attribute | Required |      Description |
|:----------|:--------:|-----------------:|
| token     |   Yes    |  Token from user |
| Series    |   Yes    |   name of Series |
| season    |   Yes    | number of Season |




```
[
    {
        error: `message`
    }
]
```

# Upload Episode

```
POST /api/uploadFile.php

```

| Attribute | Required |      Description |
|:----------|:--------:|-----------------:|
| token     |   Yes    |  Token from user |
| Series    |   Yes    |   name of Series |
| season    |   Yes    | number of Season |
| name      |   Yes    |  Name of Episode |




```
[
    {
        error: `message`
    }
]
```