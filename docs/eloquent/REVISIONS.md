[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/eloquent)

### Revisions

If we want to use `Revison` relathionship with our Twill module, we will need to include `HasRevisions` trait.

```php
<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Category extends Model 
{
    use HasRevisions;

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
    revisions: [Revision]! @hasMany
}
```

Here we defined type for `Categories` which also has its own query definition for `revisions`.  

Note here field `revisions`. That name should stay same and its connected to the Twills trait method [revisions()](https://github.com/area17/twill/blob/7a6d2015448bbe1b894ae014f8ab35e06f305771/src/Models/Behaviors/HasRevisions.php#L7-L15).

Now lets query our model in playground.

**All categories revisions**
```graphql
{
  categories {
    id
    published
    title
    description
    created_at
    updated_at
    revisions{
      __typename ... on Revision{
        id
        category_id
        user_id
        payload
        created_at
        updated_at
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
        "updated_at": "2022-02-16 00:28:38",
        "revisions": [
          {
            "__typename": "Revision",
            "id": "2",
            "category_id": 1,
            "user_id": 1,
            "payload": "{\"title\":\"TEST\",\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"single_file[sl]\":[{\"id\":2,\"name\":\"package.json\",\"src\":\"http:\\/\\/domain.test\\/storage\\/uploads\\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\\/package.json\",\"original\":\"http:\\/\\/domain.test\\/storage\\/uploads\\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\\/package.json\",\"size\":\"92 B\",\"filesizeInMb\":\"0.00\",\"tags\":[],\"deleteUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/2\",\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/bulk-delete\",\"disabled\":false}]},\"browsers\":[],\"blocks\":[],\"repeaters\":[]}",
            "created_at": "2022-02-06 18:49:26",
            "updated_at": "2022-02-06 18:49:26"
          },
          {
            "__typename": "Revision",
            "id": "1",
            "category_id": 1,
            "user_id": 1,
            "payload": "{\"title\":\"TEST\",\"published\":true,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}]}",
            "created_at": "2022-02-06 18:49:16",
            "updated_at": "2022-02-06 18:49:16"
          }
        ]
      },
      {
        "id": "2",
        "published": 1,
        "title": "Cars",
        "description": "Cars are awesome.",
        "created_at": "2022-02-08 01:54:21",
        "updated_at": "2022-03-01 19:39:33",
        "revisions": [
          {
            "__typename": "Revision",
            "id": "38",
            "category_id": 2,
            "user_id": 1,
            "payload": "{\"description\":\"Cars are awesome.\",\"tags\":[\"first\",\"second\"],\"title\":\"Cars\",\"slug\":null,\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"cover\":[{\"id\":2,\"name\":\"xlsx.png\",\"thumbnail\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png\",\"medium\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=80&fit=max&h=430\",\"width\":872,\"height\":96,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Xlsx\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}},{\"id\":1,\"name\":\"image (7).png\",\"thumbnail\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png\",\"medium\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=80&fit=max&h=430\",\"width\":2412,\"height\":197,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Image 7\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}}]},\"browsers\":[],\"blocks\":[{\"id\":10,\"type\":\"a17-block-quote\",\"editor_name\":\"default\",\"content\":{\"quote\":\"TEST 2\"},\"medias\":[],\"browsers\":[],\"blocks\":[]}],\"repeaters\":[]}",
            "created_at": "2022-03-01 19:39:33",
            "updated_at": "2022-03-01 19:39:33"
          },
          {
            "__typename": "Revision",
            "id": "37",
            "category_id": 2,
            "user_id": 1,
            "payload": "{\"description\":\"Cars are awesome.\",\"title\":\"Cars\",\"slug\":null,\"tags\":\"first,second\",\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"cover\":[{\"id\":2,\"name\":\"xlsx.png\",\"thumbnail\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png\",\"medium\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=80&fit=max&h=430\",\"width\":872,\"height\":96,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Xlsx\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}},{\"id\":1,\"name\":\"image (7).png\",\"thumbnail\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png\",\"medium\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=80&fit=max&h=430\",\"width\":2412,\"height\":197,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Image 7\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}}]},\"browsers\":[],\"blocks\":[],\"repeaters\":[]}",
            "created_at": "2022-02-27 01:34:14",
            "updated_at": "2022-02-27 01:34:14"
          },
          {
            "__typename": "Revision",
            "id": "36",
            "category_id": 2,
            "user_id": 1,
            "payload": "{\"description\":\"Cars are awesome.\",\"title\":\"Cars\",\"slug\":null,\"tags\":\"first,second,third\",\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"cover\":[{\"id\":2,\"name\":\"xlsx.png\",\"thumbnail\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png\",\"medium\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=80&fit=max&h=430\",\"width\":872,\"height\":96,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Xlsx\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}},{\"id\":1,\"name\":\"image (7).png\",\"thumbnail\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png\",\"medium\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=80&fit=max&h=430\",\"width\":2412,\"height\":197,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Image 7\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}}]},\"browsers\":[],\"blocks\":[],\"repeaters\":[]}",
            "created_at": "2022-02-27 01:30:05",
            "updated_at": "2022-02-27 01:30:05"
          },
          {
            "__typename": "Revision",
            "id": "35",
            "category_id": 2,
            "user_id": 1,
            "payload": "{\"description\":\"Cars are awesome.\",\"tags\":[\"first\",\"second\"],\"title\":\"Cars\",\"slug\":null,\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"cover\":[{\"id\":2,\"name\":\"xlsx.png\",\"thumbnail\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png\",\"medium\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=80&fit=max&h=430\",\"width\":872,\"height\":96,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Xlsx\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}},{\"id\":1,\"name\":\"image (7).png\",\"thumbnail\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png\",\"medium\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=80&fit=max&h=430\",\"width\":2412,\"height\":197,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Image 7\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}}]},\"browsers\":[],\"blocks\":[],\"repeaters\":[]}",
            "created_at": "2022-02-27 00:46:24",
            "updated_at": "2022-02-27 00:46:24"
          },
          {
            "__typename": "Revision",
            "id": "15",
            "category_id": 2,
            "user_id": 1,
            "payload": "{\"description\":\"Cars are awesome.\",\"title\":\"Cars\",\"slug\":null,\"tags\":\"first,second\",\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"cover\":[{\"id\":2,\"name\":\"xlsx.png\",\"thumbnail\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png\",\"medium\":\"\\/twill.test\\/img\\/7da9c919-2f63-41e7-b4ad-f41514bf2161\\/xlsx.png?fm=jpg&q=80&fit=max&h=430\",\"width\":872,\"height\":96,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Xlsx\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}},{\"id\":1,\"name\":\"image (7).png\",\"thumbnail\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256\",\"original\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png\",\"medium\":\"\\/twill.test\\/img\\/3f07596e-c964-4804-bbf8-8be0bd43521d\\/image-7.png?fm=jpg&q=80&fit=max&h=430\",\"width\":2412,\"height\":197,\"tags\":[],\"deleteUrl\":null,\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/media-library\\/medias\\/bulk-delete\",\"metadatas\":{\"default\":{\"caption\":null,\"altText\":\"Image 7\",\"video\":null},\"custom\":{\"caption\":null,\"altText\":null,\"video\":null}},\"crops\":{\"default\":{\"name\":\"default\",\"width\":null,\"height\":null,\"x\":null,\"y\":null},\"mobile\":{\"name\":\"mobile\",\"width\":null,\"height\":null,\"x\":null,\"y\":null}}}]},\"browsers\":[],\"blocks\":[],\"repeaters\":[]}",
            "created_at": "2022-02-26 23:45:35",
            "updated_at": "2022-02-26 23:45:35"
          }
        ]
      }
    ]
  }
}
```

### Specific category revisions

```graphql
{
  category(id: 1) {
    id
    published
    title
    description
    created_at
    updated_at
    revisions{
      __typename ... on Revision{
        id
        category_id
        user_id
        payload
        created_at
        updated_at
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
      "id": "1",
      "published": 1,
      "title": "Books",
      "description": "Just a plain description of the books category",
      "created_at": "2022-02-06 18:49:16",
      "updated_at": "2022-02-16 00:28:38",
      "revisions": [
        {
          "__typename": "Revision",
          "id": "2",
          "category_id": 1,
          "user_id": 1,
          "payload": "{\"title\":\"TEST\",\"cmsSaveType\":\"update\",\"published\":true,\"public\":false,\"publish_start_date\":null,\"publish_end_date\":null,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}],\"parent_id\":0,\"medias\":{\"single_file[sl]\":[{\"id\":2,\"name\":\"package.json\",\"src\":\"http:\\/\\/domain.test\\/storage\\/uploads\\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\\/package.json\",\"original\":\"http:\\/\\/domain.test\\/storage\\/uploads\\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\\/package.json\",\"size\":\"92 B\",\"filesizeInMb\":\"0.00\",\"tags\":[],\"deleteUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/2\",\"updateUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/single-update\",\"updateBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/bulk-update\",\"deleteBulkUrl\":\"http:\\/\\/twill.test\\/zadmin\\/file-library\\/files\\/bulk-delete\",\"disabled\":false}]},\"browsers\":[],\"blocks\":[],\"repeaters\":[]}",
          "created_at": "2022-02-06 18:49:26",
          "updated_at": "2022-02-06 18:49:26"
        },
        {
          "__typename": "Revision",
          "id": "1",
          "category_id": 1,
          "user_id": 1,
          "payload": "{\"title\":\"TEST\",\"published\":true,\"languages\":[{\"shortlabel\":\"SL\",\"label\":\"Slovenian\",\"value\":\"sl\",\"disabled\":false,\"published\":true}]}",
          "created_at": "2022-02-06 18:49:16",
          "updated_at": "2022-02-06 18:49:16"
        }
      ]
    }
  }
}
```
