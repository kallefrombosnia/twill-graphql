<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class CreateMutationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testCreateCategory(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Mutation {
            createCategory(
                title: String!
                published: Int!
                description: String
            ): Category @create
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
            createCategory(
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
                "createCategory" => [
                    "id" => "3", 
                    "title" => "Graphql Category Twill", 
                    "published" => 1, 
                    "description" => "GrapqhQL category." 
                ] 
            ] 
        ]);
    }

}
