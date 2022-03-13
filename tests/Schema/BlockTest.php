<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class BlockTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testGetAllModuleRelatedBlocks(): void
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
            blocks: [Block]! @morphMany
        }
    
        type Block {
            id: ID!
            blockable_id: String
            blockable_type: String
            position: Int!
            content: String
            type: String
            child_key: String
            parent_id: Int
            editor_name: String
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
                blocks{
                    __typename ... on Block {
                        id
                        blockable_id
                        type
                        content
                        editor_name
                    }
                }
            }
        }
        ')->assertExactJson([
            "data" => [
                "categories" => [
                    [
                        "id" => "1",
                        "published" => 1,
                        "title" => "Books",
                        "description" => "Just a plain description of the books category",
                        "blocks" => []
                    ],
                    [
                        "id" => "2",
                        "published" => 1,
                        "title" => "Cars",
                        "description" => "Cars are awesome.",
                        "blocks" => [
                            [
                                "__typename" => "Block",
                                "id" => "1",
                                "blockable_id" => "2",
                                "type" => "quote",
                                "content" => '{"quote":"TEST 2"}',
                                "editor_name" => "default"
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function testGetSpecificModuleRelatedBlocks(): void
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
            blocks: [Block]! @morphMany
        }
    
        type Block {
            id: ID!
            blockable_id: String
            blockable_type: String
            position: Int!
            content: String
            type: String
            child_key: String
            parent_id: Int
            editor_name: String
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
                blocks{
                    __typename ... on Block {
                        id
                        blockable_id
                        type
                        content
                        editor_name
                    }
                }
            }
        }
        ')->assertExactJson([
            "data" => [
                "category" => [
                    "id" => "2",
                    "published" => 1,
                    "title" => "Cars",
                    "description" => "Cars are awesome.",
                    "blocks" => [
                        [
                            "__typename" => "Block",
                            "id" => "1",
                            "blockable_id" => "2",
                            "type" => "quote",
                            "content" => '{"quote":"TEST 2"}',
                            "editor_name" => "default"
                        ]
                    ]   
                ]
            ]
        ]);
    }
}
