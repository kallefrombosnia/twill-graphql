<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class TagsTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testGetAllModuleRelatedTags(): void
    {

        $this->schema =
            /** @lang GraphQL */
            '
        type Query{
            categories: [Category] @all
        }
        
        type Category{
            id: ID!
            published: Int!
            title: String
            description: String
            tags: [Tag] @morphMany
        }
    
        type Tag {
            id: ID!
            namespace: String!
            slug: String!
            name: String!
            count: Int!
        }
        ';

        $this->graphQL(
            /** @lang GraphQL */
            '
        {
            categories {
                id
                published
                title
                description
                tags{
                    __typename ... on Tag {
                        id
                        name
                        slug
                        namespace
                    }
                }
            }
        }
        '
        )->assertExactJson([
            "data" => [
                "categories" => [
                    [
                        "id" => "1",
                        "published" => 1,
                        "title" => "Books",
                        "description" => "Just a plain description of the books category",
                        "tags" => []
                    ],
                    [
                        "id" => "2",
                        "published" => 1,
                        "title" => "Cars",
                        "description" => "Cars are awesome.",
                        "tags" => [
                            [
                                "__typename" => "Tag",
                                "id" => "1",
                                "name" => "first",
                                "slug" => "first",
                                "namespace" => "Twill\Graphql\Tests\Utils\Models\Category"
                            ],
                            [
                                "__typename" => "Tag",
                                "id" => "2",
                                "name" => "second",
                                "slug" => "second",
                                "namespace" => "Twill\Graphql\Tests\Utils\Models\Category"
                            ],
                            [
                                "__typename" => "Tag",
                                "id" => "3",
                                "name" => "third",
                                "slug" => "third",
                                "namespace" => "Twill\Graphql\Tests\Utils\Models\Category"
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }


    public function testGetSpecificModuleRelatedTags(): void
    {

        $this->schema =
            /** @lang GraphQL */
            '
        type Query{
            category(id: Int! @eq): Category @find
        }
        
        type Category{
            id: ID!
            published: Int!
            title: String
            description: String
            tags: [Tag] @morphMany
        }
    
        type Tag {
            id: ID!
            namespace: String!
            slug: String!
            name: String!
            count: Int!
        }
        ';

        $this->graphQL(
            /** @lang GraphQL */
            '
        {
            category(id: 2) {
                id
                published
                title
                description
                tags{
                    __typename ... on Tag {
                        id
                        name
                        slug
                        namespace
                    }
                }
            }
        }
        '
        )->assertExactJson([
            "data" => [
                "category" => [
                    "id" => "2",
                    "published" => 1,
                    "title" => "Cars",
                    "description" => "Cars are awesome.",
                    "tags" => [
                        [
                            "__typename" => "Tag",
                            "id" => "1",
                            "name" => "first",
                            "slug" => "first",
                            "namespace" => "Twill\Graphql\Tests\Utils\Models\Category"
                        ],
                        [
                            "__typename" => "Tag",
                            "id" => "2",
                            "name" => "second",
                            "slug" => "second",
                            "namespace" => "Twill\Graphql\Tests\Utils\Models\Category"
                        ],
                        [
                            "__typename" => "Tag",
                            "id" => "3",
                            "name" => "third",
                            "slug" => "third",
                            "namespace" => "Twill\Graphql\Tests\Utils\Models\Category"
                        ]
                    ]
                ]
            ]
        ]);
    }
}
