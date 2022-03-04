# Twill CMS GraphQL :telescope:

## WIP - not stable

Twill GraphQL provides easy access to query-specific fields from Twill CMS modules and user-defined modules with GraphQL.

The project is heavily inspired by [twill-api](https://github.com/area17/twill-api)


Currently, only queries are supported, `mutations` will come after `@guard` implementation

### Documentation

Check the [documentation.](https://github.com/kallefrombosnia/twill-graphql/tree/master/docs)

### Technologies 

This package uses [nuwave/lighthouse](https://github.com/nuwave/lighthouse) and [mll-lab/laravel-graphql-playground](https://github.com/mll-lab/laravel-graphql-playground) for providing easy access to models and playground UI for exploring server schemas and testing.

Big props to them and Twill developers for creating such amazing projects.

Per default graphql endpoint serves on `/graphql` and playground is available on `/graphql-playground`

### Install package

**From composer**

```sh
The package is not yet submitted and is a matter of change.
For development, you could manually download it and load it up in composer as dev-master  
After that composer update should be run.
```


### Configuration  

Deploy default graphql schema
```sh
$ php artisan twill:graphql:deploy
```

Deploy `lighthouse` config
```sh
$ php artisan vendor:publish --tag=lighthouse-config
```

> This is not hardcoded into our config since lighthouse is constantly changing their codebase

After deploying lighthouse config, find it in the `./config/lighthouse.php`

Find `namespaces` which should look like this.

```php
'namespaces' => [
    'models' => ['App', 'App\\Models'],
    'queries' => 'App\\GraphQL\\Queries',
    'mutations' => 'App\\GraphQL\\Mutations',
    'subscriptions' => 'App\\GraphQL\\Subscriptions',
    'interfaces' => 'App\\GraphQL\\Interfaces',
    'unions' => 'App\\GraphQL\\Unions',
    'scalars' => 'App\\GraphQL\\Scalars',
    'directives' => ['App\\GraphQL\\Directives'],
    'validators' => ['App\\GraphQL\\Validators'],
],
```

At the moment only config option needed for us is `models`
Change it like this to load default Twill modules into it (make sure you have Twill CMS installed).

```php
    'namespaces' => [
        'models' => ['A17\\Twill\\Models', 'App', 'App\\Models'],
        ...
    ],
```

This will autoload all package models first so make sure your Laravel models and Twill custom models are not named the same as Twill CMS modules.  

Reserved: `Feature`, `Block`, `File`, `Media`, `Setting`, `Tag`, `User`.  

And you are ready to go.

### Project roadmap

- [x] Create wrapper around Twill default models for relations
- [x] Add examples
- [ ] Write tests
- [ ] Create composer package (publish)
- [ ] Create guards example
- [ ] Create mutations
- [ ] More tests
- [ ] TBA

### Query on Twill custom user models 

For example, we have the `Category` model which is located in `app\Models`
By `lighthouse` configuration this model is also loaded.

```php
// app/Models/Category.php
<?php

namespace App\Models;

use A17\Twill\Models\Model;

class Category extends Model 
{
  
    protected $fillable = [
        'published',
        'title',
        'description',
    ];
    
}

```

Edit `graphql/schema.graphql`

```graphql
scalar DateTime @scalar(class: "Nuwave\\Lighthouse\\Schema\\Types\\Scalars\\DateTime")  

type Query {

  "Query on Category module"
  categories: [Category!]! @all @softDeletes
  category(id: Int! @eq): Category @find

} 

type Category {
  id: ID!
  published: Int!
  title: String
  description: String
  created_at: DateTime
  updated_at: DateTime
}

```

Let's load Graphql playground and test it.

All categories  

```graphql
{
    categories {
        id
        published
        title
        description
        created_at
        updated_at
    }
}
```

Result

```graphql
{
    "data": {
        "categories": [
        {
            "id": "1",
            "published": 1,
            "title": "Books",
            "description": "Just a plain description of the books category",
            "created_at": "2022-02-06 18:49:16",
            "updated_at": "2022-02-06 18:58:10"
        },
        {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-08 01:54:35"
        }
        ]
    }
}
```

Query specific category by id

```graphql
{
    category(id: 2) {
        id
        published
        title
        description
        created_at
        updated_at
    }
}
```

Result

```graphql
{
    "data": {
        "category": {
            "id": "2",
            "published": 1,
            "title": "Cars",
            "description": "Cars are awesome.",
            "created_at": "2022-02-08 01:54:21",
            "updated_at": "2022-02-08 01:54:35"
        }
    }
}
```

### LICENSE
[MIT](https://github.com/kallefrombosnia/twill-graphql/blob/master/LICENSE.md) 

### AUTHOR
Izet Mulalić

    