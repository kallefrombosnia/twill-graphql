[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/eloquent)

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