[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/mutations)


### Module delete mutation


Firstly define the corresponding schema for mutation.
```graphql
type Category{
    id: ID!
    published: Int!
    title: String
    description: String
}

type Mutation {
    deleteCategory(
        id: ID!
    ): Category @delete
}
```

Lets define our delete mutation.

```graphql
mutation {
  deleteCategory(
    id: 4
  ) {
    id
  }
}
```

Returned data:

```json
{
  "data": {
    "deleteCategory": {
      "id": "4"
    }
  }
}
```

