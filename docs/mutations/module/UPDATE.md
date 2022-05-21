[:back: Back to parent](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/mutations)


### Module update mutation


Simple model update with GraphQL looks like this:

Firstly define the corresponding schema for mutation.
```graphql
type Category{
    id: ID!
    published: Int!
    title: String
    description: String
}

type Mutation {
    updateCategory(
        id: ID!
        title: String
        published: Int
        description: String
    ): Category @update
}
```

For updates we are required to supply unique indentifier which is in our case `id` of the model.


Lets define our update mutation.

```graphql
mutation {
  updateCategory(
    id: 4
    title: "Graphql Category Twill Updated"
    published: 0
    description: "GrapqhQL category update."
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
    "updateCategory": {
      "id": "4",
      "title": "Graphql Category Twill Updated",
      "published": 0,
      "description": "GrapqhQL category update."
    }
  }
}
```


