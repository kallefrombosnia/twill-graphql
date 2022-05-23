<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class UpsertMutationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testUpsertEditCategory(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Mutation {
            upsertCategory(
                id: ID!
                title: String
                published: Int
                description: String
            ): Category @upsert
        }

        type Category{
            id: ID!
            published: Int!
            title: String
            description: String
        }

        type Query{
            categories: [Category] @all
        }
        ';

        $response = $this->graphQL(
        /** @lang GraphQL */
        '
        mutation($title: String!, $published: Int!, $description: String!) {
            upsertCategory(
                id: 2
                title:  $title
                published: $published
                description: $description
              ) {
                id
                title
                published
                description
              }
        }
        ',
        [
            'title' => "Graphql Category Twill",
            'published' => 1,
            'description' => "GrapqhQL category."
        ]
        );

        $response->assertExactJson([
            "data" => [
                "upsertCategory" => [
                    "id" => "2", 
                    "title" => "Graphql Category Twill", 
                    "published" => 1, 
                    "description" => "GrapqhQL category." 
                ] 
            ] 
        ]);
    }

    public function testUpsertNewCategory(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Mutation {
            upsertCategory(
                id: ID!
                title: String
                published: Int
                description: String
            ): Category @upsert
        }

        type Category{
            id: ID!
            published: Int!
            title: String
            description: String
        }

        type Query{
            categories: [Category] @all
        }
        ';

        $response = $this->graphQL(
        /** @lang GraphQL */
        '
        mutation($title: String!, $published: Int!, $description: String!) {
            upsertCategory(
                id: 3
                title:  $title
                published: $published
                description: $description
              ) {
                id
                title
                published
                description
              }
        }
        ',
        [
            'title' => "Graphql Category Twill",
            'published' => 1,
            'description' => "GrapqhQL category."
        ]
        );

        $response->assertExactJson([
            "data" => [
                "upsertCategory" => [
                    "id" => "3", 
                    "title" => "Graphql Category Twill", 
                    "published" => 1, 
                    "description" => "GrapqhQL category." 
                ] 
            ] 
        ]);
    }

}
