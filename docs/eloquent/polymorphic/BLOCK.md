[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/eloquent)

### Block

Twill offers great funcionality which are blocks. They are supper handy to use on frontend, and easy to setup for developers on CMS.

To get blocks which are used on Twill custom module, you will need to use `HasBlocks` on that model.

```php
<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Model;

class Category extends Model 
{
    use HasBlocks;

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
    blocks: [Block]!
}
```

Here we defined type for `Categories` which also has its own query definition.  

Now lets query our model in playground.


### All blocks on categories

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
        blocks{
            __typename 
            ... on Block{
                id
                blockable_id
                type
                content
                editor_name
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
            "updated_at": "2022-02-16 00:28:38",
            "blocks": []
        },
        {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-16 00:25:15",
            "blocks": [
                {
                    "__typename": "Block",
                    "id": "9",
                    "blockable_id": "2",
                    "type": "image",
                    "content": "[]",
                    "editor_name": "default"
                },
                {
                    "__typename": "Block",
                    "id": "10",
                    "blockable_id": "2",
                    "type": "quote",
                    "content": "{\"quote\":\"TEST 2\"}",
                    "editor_name": "default"
                }
            ]
        }
        ]
    }
}
```

On first record we dont have any blocks connected so its empty `[]`

Note the `content` here in response on second row. Its JSON scalar type which provides you saved field data on specific block. 
This is useful if you are using on frontend SPA-s to query data from Twill backend and passing data trough props to components.

Last example will show you how to get SSR content which also can be used to render specific block directly on your page.

### Blocks on specific category

```graphql
# Write your query or mutation here
{
    category(id: 2) {
        id
        published
        title
        description
        created_at
        updated_at
        renderBlocks
        blocks{
            __typename 
            ... on Block{
                id
                blockable_id
                type
                content
                editor_name
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
        "id": "2",
        "published": 1,
        "title": "Cars",
        "description": "Cars are awesome.",
        "created_at": "2022-02-08 01:54:21",
        "updated_at": "2022-02-16 00:25:15",
        "blocks": [
            {
            "__typename": "Block",
            "id": "9",
            "blockable_id": "2",
            "type": "image",
            "content": "[]",
            "editor_name": "default"
            },
            {
            "__typename": "Block",
            "id": "10",
            "blockable_id": "2",
            "type": "quote",
            "content": "{\"quote\":\"TEST 2\"}",
            "editor_name": "default"
            }
        ]
        }
    }
}
```

### Get rendered blocks

`resources/views/site/blocks/quote.blade.php`

```php
QUOTE
<div>
{!! $block->input('quote') !!}
</div>
```

If we directly query with Twill's trait method [renderBlocks](https://github.com/area17/twill/blob/c8579dd8e6337154e338610ed45c21ec2aebd44b/src/Models/Behaviors/HasBlocks.php#L54), it will return to us all compiled blocks on specific record (default).

Schema: 
```graphql
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
    medias: [Media]! @morphTo
    blocks: [Block]!
    renderBlocks: String @method
}
```

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
    renderBlocks
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
                "updated_at": "2022-02-16 00:28:38",
                "renderBlocks": ""
            },
            {
                "id": "2",
                "published": 1,
                "title": "Cars",
                "description": "Cars are awesome.",
                "created_at": "2022-02-08 01:54:21",
                "updated_at": "2022-02-16 00:25:15",
                "renderBlocks": "IMAGEQUOTE\r\n<div>\r\nTEST 2\r\n</div>"
            }
        ]
    }
}
```

First record return empty string since no blocks are used there. But on second record we have string scalar type which returns us compiled blade view with appended dynamic data.

### Get specific named blocks

With Lighthouse we are able to access to specific method [renderNamedBlocks](https://github.com/area17/twill/blob/c8579dd8e6337154e338610ed45c21ec2aebd44b/src/Models/Behaviors/HasBlocks.php#L19) from `HasBlocks` trait.

Note: Lighthouse offers us to pass arguments to directives (`@method`).
I dont currently have setup for additional blocks in same form to test this, but you could setup GraphQL query like this.

```graphql
"schema.graphql requires default registration of type"
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
    medias: [Media]! @morphTo
    blocks: [Block]!
    renderNamedBlocks(name: String, renderChilds: Boolean, blockViewMappings: [String], data: [String]): String @method
}
```

Query
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
    renderNamedBlocks(name: "test_editor")
  }
}
```

