<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class DeleteMutationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testDeleteCategory(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Mutation {
            deleteCategory(
                id: ID!
            ): Category @delete
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
        mutation($id: ID!) {
            deleteCategory(
                id: $id
              ) {
                id
              }
        }
        ',
        [
            'id' => 2,
        ]
        );

        $response->assertExactJson([
            "data" => [
                "deleteCategory" => [
                    "id" => "2", 
                ] 
            ] 
        ]);
    }

}
