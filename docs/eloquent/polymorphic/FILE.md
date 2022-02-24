[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/eloquent)

### File

If we want to use `File` relathionship with our Twill module, we will need to include `HasFiles` trait.

```php
<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Model;

class Category extends Model 
{
    use HasFiles;

    ...
```

Lets head to `graphql.schema` to define query

```graphql
#import twill.graphql

type Query{
    categories: [Category!]! @all
    category(id: Int! @eq): Category @find
}

type Category{
    id: ID!
    published: Int!
    title: String
    description: String
    created_at: DateTime
    updated_at: DateTime
    files: [File]! @morphTo
}
```

Here we defined type for `Categories` which also has its own query definition.  

Note here field `files`. That name should stay same and its connected to the Twills trait method [files()](https://github.com/area17/twill/blob/fe27672e8ba432b3d6b111df79b4827d0f2e7d03/src/Models/Behaviors/HasFiles.php#L15).

Now lets query our model in playground.

**All categories**
```graphql
{
    categories {
        id
        published
        title
        description
        created_at
        updated_at
        files{
        __typename
        ... on File {
            filename
            uuid
        }
        }
    }
}
```

Response `data`:

```json
{
    "data": {
        "categories": [
        {
            "id": "1",
            "published": 1,
            "title": "Books",
            "description": "Just a plain description of the books category",
            "created_at": "2022-02-06 18:49:16",
            "updated_at": "2022-02-06 18:58:10",
            "files": [
            {
                "__typename": "File",
                "filename": "testbench.yaml",
                "uuid": "78c18b36-6d6a-4fa1-8724-41c6b49a5157/testbench.yaml"
            }
            ]
        },
        {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-13 13:58:21",
            "files": [
            {
                "__typename": "File",
                "filename": "package.json",
                "uuid": "a05cc377-4e44-49e0-8a1a-4d83e517d05d/package.json"
            },
            {
                "__typename": "File",
                "filename": "apoteka.jpg",
                "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/apoteka.jpg"
            },
            {
                "__typename": "File",
                "filename": "image.jpg",
                "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image.jpg"
            },
            {
                "__typename": "File",
                "filename": "image-(1).jpg",
                "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image-(1).jpg"
            }
            ]
        }
        ]
    }
}
```

### Specific category

```graphql
{
    category(id: 2) {
        id
        published
        title
        description
        created_at
        updated_at
        files{
            __typename
            ... on File {
                filename
                uuid
            }
        }
    }
}
```

Response `data`:

```json
{
    "data": {
        "category": {
        "id": "2",
        "published": 1,
        "title": "Cars",
        "description": "Cars are awesome.",
        "created_at": "2022-02-08 01:54:21",
        "updated_at": "2022-02-13 13:58:21",
        "files": [
            {
            "__typename": "File",
            "filename": "package.json",
            "uuid": "a05cc377-4e44-49e0-8a1a-4d83e517d05d/package.json"
            },
            {
            "__typename": "File",
            "filename": "apoteka.jpg",
            "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/apoteka.jpg"
            },
            {
            "__typename": "File",
            "filename": "image.jpg",
            "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image.jpg"
            },
            {
            "__typename": "File",
            "filename": "image-(1).jpg",
            "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image-(1).jpg"
            }
        ]
        }
    }
}
```

If need `pivot` data from `fileables` add `pivot` to query.

```graphql
{
    categories {
        id
        published
        title
        description
        created_at
        updated_at
        files{
        __typename
            ... on File {
                filename
                uuid
                pivot{
                role
                locale
                }
            }
        }
    }
}
```

Result with `pivot`

```json
{
  "data": {
        "categories": [
        {
            "id": "1",
            "published": 1,
            "title": "Books",
            "description": "Just a plain description of the books category",
            "created_at": "2022-02-06 18:49:16",
            "updated_at": "2022-02-06 18:58:10",
            "files": [
            {
                "__typename": "File",
                "filename": "testbench.yaml",
                "uuid": "78c18b36-6d6a-4fa1-8724-41c6b49a5157/testbench.yaml",
                "pivot": {
                    "role": "single_file",
                    "locale": "sl"
                }
            }
            ]
        },
        {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-13 16:24:17",
            "files": [
            {
                "__typename": "File",
                "filename": "apoteka.jpg",
                "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/apoteka.jpg",
                "pivot": {
                    "role": "single_file",
                    "locale": "sl"
                }
            },
            {
                "__typename": "File",
                "filename": "image.jpg",
                "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image.jpg",
                "pivot": {
                    "role": "single_file",
                    "locale": "sl"
                }
            },
            {
                "__typename": "File",
                "filename": "image-(1).jpg",
                "uuid": "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image-(1).jpg",
                "pivot": {
                    "role": "single_file",
                    "locale": "sl"
                }
            }
            ]
        }
        ]
  }
}
```