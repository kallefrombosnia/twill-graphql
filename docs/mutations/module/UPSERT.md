[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/mutations)


### Module upsert mutation


Lighthouse will try to fetch the model by its primary key, just like `@update`. If the model doesn't exist, it will be newly created with a given id. In case no id is specified, an auto-generated fresh ID will be used instead.

Firstly define the corresponding schema for mutation.
```graphql
type Category{
    id: ID!
    published: Int!
    title: String
    description: String
}

type Mutation {
    upsertCategory(
        id: ID!
        title: String
        published: Int
        description: String
    ): Category @upsert
}
```


Lets define our update mutation.

```graphql
mutation {
  upsertCategory(
    id: 4
    title: "Graphql Category Twill Upsert"
    published: 1
    description: "GrapqhQL category upsert."
  ) {
    id
    title
    published
    description
  }
}
```

Returned data:

```json
{
  "data": {
    "upsertCategory": {
      "id": "4",
      "title": "Graphql Category Twill Upsert",
      "published": 1,
      "description": "GrapqhQL category upsert."
    }
  }
}
```

As we can see no new models are created, instead it just updated existing record with the new data.
Let's test with the non existing record.

```graphql
mutation {
  upsertCategory(
    id: 5
    title: "Graphql Category Twill UpsertV2"
    published: 1
    description: "GrapqhQL category upsertV2."
  ) {
    id
    title
    published
    description
  }
}
```

Returned data:

```json
{
  "data": {
    "upsertCategory": {
      "id": "5",
      "title": "Graphql Category Twill UpsertV2",
      "published": 1,
      "description": "GrapqhQL category upsertV2."
    }
  }
}
```

It returns us new model record for `upsert` mutation.


