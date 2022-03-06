<?php

namespace Twill\Graphql\Tests\Schema;

class FileTest extends TestCase
{

    protected $schema = /** @lang GraphQL */ '
    type Query{
        categories: [Category] @all
    }
    
    type Category{
        id: ID!
        published: Int!
        title: String
        description: String
        files: [File]! @morphTo
    }
    type File {
        id: ID!
        filename: String!
        uuid: String!
        size: String!
        filepivot: FilePivot
    }
      
    type FilePivot {
        role: String
        locale: String
    }
    ';
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testGetAllModuleRelatedFiles(): void
    {

        $this->mockResolver('foo');

        $response = $this->graphQL(/** @lang GraphQL */ '
        {
            categories {
                id
                published
                title
                description
                files{
                    __typename ... on File {
                        filename
                        uuid
                    }
                }
            }
        }
        ');

        dd($response);
    }
}