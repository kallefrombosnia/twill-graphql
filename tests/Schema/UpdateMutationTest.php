<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class UpdateMutationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testUpdateCategory(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Mutation {
            updateCategory(
                id: ID!
                title: String
                published: Int
                description: String
            ): Category @update
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
            updateCategory(
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
                "updateCategory" => [
                    "id" => "2", 
                    "title" => "Graphql Category Twill", 
                    "published" => 1, 
                    "description" => "GrapqhQL category." 
                ] 
            ] 
        ]);
    }

}
