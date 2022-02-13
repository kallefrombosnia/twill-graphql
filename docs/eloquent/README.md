# Eloquent usage with Twill CMS

Documentation
-----
- [Eloquent relathionships](#eloquent-relathionships)
- [Polymorphic relathionships](#polymorphic-relathionships)
    - [File](#file)
    - [Media](#media)
- [Twill methods](#twill-methods)



## Eloquent relathionships




## Polymorphic relathionships

Since Twill CMS uses polymorphic relathionships for some of the models, we can also uses their relations to show specific fields in response.

They achived this trough `Traits`, and some of the models have behaviour traits for polymorphic relathionships.

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


### Media

If we want to use `Media` relathionship with our Twill module, we will need to include `HasMedias` trait.

```php
<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;

class Category extends Model 
{
    use HasMedias;

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
    medias: [Media]! @morphTo
}
```

Here we defined type for `Categories` which also has its own query definition.  

Note here field `medias`. That name should stay same and its connected to the Twills trait method [medias()](https://github.com/area17/twill/blob/fe27672e8ba432b3d6b111df79b4827d0f2e7d03/src/Models/Behaviors/HasMedias.php#L35).

Now lets query our model in playground.


### All categories

```graphql
# Write your query or mutation here
{
    categories {
        id
        published
        title
        description
        created_at
        updated_at
        medias{
        __typename
        ... on Media {
            filename
            uuid
        }
        }
    }
}
```

Result `data`:
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
            "updated_at": "2022-02-13 17:30:34",
            "medias": [
            {
                "__typename": "Media",
                "filename": "2020-12-19.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
            },
            {
                "__typename": "Media",
                "filename": "2020-12-19.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
            },
            {
                "__typename": "Media",
                "filename": "20210827_123315.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
            },
            {
                "__typename": "Media",
                "filename": "20210827_123315.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
            },
            {
                "__typename": "Media",
                "filename": "2021-09-29.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
            },
            {
                "__typename": "Media",
                "filename": "2021-09-29.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
            },
            {
                "__typename": "Media",
                "filename": "2020-08-05.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
            },
            {
                "__typename": "Media",
                "filename": "2020-08-05.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
            }
            ]
        },
        {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-13 17:28:16",
            "medias": [
            {
                "__typename": "Media",
                "filename": "xlsx.png",
                "uuid": "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png"
            },
            {
                "__typename": "Media",
                "filename": "xlsx.png",
                "uuid": "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png"
            },
            {
                "__typename": "Media",
                "filename": "image (7).png",
                "uuid": "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png"
            },
            {
                "__typename": "Media",
                "filename": "image (7).png",
                "uuid": "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png"
            }
            ]
        }
        ]
    }
}
```

### Specific category

```graphql
# Write your query or mutation here
{
    category(id: 1) {
        id
        published
        title
        description
        created_at
        updated_at
        medias{
        __typename
        ... on Media {
            filename
            uuid
        }
        }
    }
}
```

Result `data`:

```json
{
  "data": {
        "category": {
            "id": "1",
            "published": 1,
            "title": "Books",
            "description": "Just a plain description of the books category",
            "created_at": "2022-02-06 18:49:16",
            "updated_at": "2022-02-13 17:30:34",
            "medias": [
                {
                    "__typename": "Media",
                    "filename": "2020-12-19.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "2020-12-19.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "20210827_123315.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "20210827_123315.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "2021-09-29.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "2021-09-29.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "2020-08-05.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
                },
                {
                    "__typename": "Media",
                    "filename": "2020-08-05.jpg",
                    "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
                }
            ]
        }
    }
}
```

Results with `pivot` mediable fields:

```graphql
# Write your query or mutation here
{
    categories {
        id
        published
        title
        description
        created_at
        updated_at
        medias{
        __typename
        ... on Media {
            filename
            uuid
            pivot{
                crop
                role
                crop_w
                crop_h
                crop_x
                crop_y
                lqip_data
                ratio
                metadatas
            }
        }
        }
    }
}
```

Result `data`:

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
            "updated_at": "2022-02-13 17:30:34",
            "medias": [
            {
                "__typename": "Media",
                "filename": "2020-12-19.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg",
                "pivot": {
                    "crop": "default",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "default",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "2020-12-19.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg",
                "pivot": {
                    "crop": "mobile",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "mobile",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "20210827_123315.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg",
                "pivot": {
                    "crop": "default",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "default",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "20210827_123315.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg",
                "pivot": {
                    "crop": "mobile",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "mobile",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "2021-09-29.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg",
                "pivot": {
                    "crop": "default",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "default",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "2021-09-29.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg",
                "pivot": {
                    "crop": "mobile",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "mobile",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "2020-08-05.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg",
                "pivot": {
                    "crop": "default",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "default",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "2020-08-05.jpg",
                "uuid": "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg",
                "pivot": {
                    "crop": "mobile",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "mobile",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
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
            "updated_at": "2022-02-13 17:28:16",
            "medias": [
            {
                "__typename": "Media",
                "filename": "xlsx.png",
                "uuid": "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png",
                "pivot": {
                    "crop": "default",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "default",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "xlsx.png",
                "uuid": "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png",
                "pivot": {
                    "crop": "mobile",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "mobile",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "image (7).png",
                "uuid": "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png",
                "pivot": {
                    "crop": "default",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "default",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            },
            {
                "__typename": "Media",
                "filename": "image (7).png",
                "uuid": "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png",
                "pivot": {
                    "crop": "mobile",
                    "role": "cover",
                    "crop_w": null,
                    "crop_h": null,
                    "crop_x": null,
                    "crop_y": null,
                    "lqip_data": null,
                    "ratio": "mobile",
                    "metadatas": "{\"caption\":null,\"altText\":null,\"video\":null}"
                }
            }
            ]
        }
        ]
    }
}
```




