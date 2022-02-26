[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/eloquent)

### Tags

Twill uses third-party composer packages for tags - `cartalyst/tags`

Per default we dont need to include any traits since `TaggableTrait` in included in defult `Model`, so with extending base Twill `Module` we get access to the `tags` method which retrives all tags related to spefic module.


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
    tags: [Tag] @morphMany
}
```

Here we defined type for `Categories` which also has its own query definition.  

Note here field `files`. That name should stay same and its connected to the Twills trait method [files()](https://github.com/area17/twill/blob/fe27672e8ba432b3d6b111df79b4827d0f2e7d03/src/Models/Behaviors/HasFiles.php#L15).

Now lets query our model in playground.

**All categories**
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
        tags{
            __typename ... on Tag{
                name
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
            "tags": []
        },
        {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-26 01:00:32",
            "tags": [
            {
                "__typename": "Tag",
                "id": "4",
                "name": "first",
                "slug": "first",
                "namespace": "App\\Models\\Category"
            },
            {
                "__typename": "Tag",
                "id": "5",
                "name": "second",
                "slug": "second",
                "namespace": "App\\Models\\Category"
            },
            {
                "__typename": "Tag",
                "id": "6",
                "name": "third",
                "slug": "third",
                "namespace": "App\\Models\\Category"
            }
            ]
        }
        ]
    }
}
```

### Specific category tags

```graphql
{
    category(id: 2) {
        id
        published
        title
        description
        created_at
        updated_at
        tags{
            __typename ... on Tag{
                id
                name
                slug
                namespace
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
        "updated_at": "2022-02-26 01:00:32",
        "tags": [
            {
            "__typename": "Tag",
            "id": "4",
            "name": "first",
            "slug": "first",
            "namespace": "App\\Models\\Category"
            },
            {
            "__typename": "Tag",
            "id": "5",
            "name": "second",
            "slug": "second",
            "namespace": "App\\Models\\Category"
            },
            {
            "__typename": "Tag",
            "id": "6",
            "name": "third",
            "slug": "third",
            "namespace": "App\\Models\\Category"
            }
        ]
        }
    }
}
```

Tags are also availble on `Files` and `Media` default models, since `Media Library` provides tag input for every file.