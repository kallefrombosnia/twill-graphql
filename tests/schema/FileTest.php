<?php

namespace Twill\Graphql\Tests\Schema;

class FileTest extends TestCase
{
    
    // Set example schema for File
    protected $schema = /** @lang GraphQL */ '
    type Query{
        categories: [Category!]! @all @mock
        category(id: Int! @eq): Category @find @mock
    }
    
    type Category{
        id: ID!
        published: Int!
        title: String
        description: String
        created_at: DateTime
        updated_at: DateTime
        files: [File]! @morphTo
    }

    type File {
        id: ID!
        filename: String!
        uuid: String!
        size: String!
        created_at: DateTime
        updated_at: DateTime
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
        // Init mocker resolver for this method
        $this->mockResolver('categories');

        // Define query
        $this->graphQL(/** @lang GraphQL */ '
        {
            categories {
                id
                published
                title
                description
                created_at
                updated_at
                files{
                    __typename ... on File {
                        filename
                        uuid
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
                        "created_at" => "2022-02-06 18:49:16", 
                        "updated_at" => "2022-02-06 18:58:10", 
                        "files" => [
                            [
                                "__typename" => "File", 
                                "filename" => "testbench.yaml", 
                                "uuid" => "78c18b36-6d6a-4fa1-8724-41c6b49a5157/testbench.yaml" 
                            ] 
                        ] 
                    ], 
                    [
                        "id" => "2", 
                        "published" => 1, 
                        "title" => "Cars", 
                        "description" => "Cars are awesome.", 
                        "created_at" => "2022-02-08 01:54:21", 
                        "updated_at" => "2022-02-13 13:58:21", 
                        "files" => [
                            [
                                "__typename" => "File", 
                                "filename" => "package.json", 
                                "uuid" => "a05cc377-4e44-49e0-8a1a-4d83e517d05d/package.json" 
                            ], 
                            [
                                "__typename" => "File", 
                                "filename" => "apoteka.jpg", 
                                "uuid" => "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/apoteka.jpg" 
                            ], 
                            [
                                "__typename" => "File", 
                                "filename" => "image.jpg", 
                                "uuid" => "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image.jpg" 
                            ], 
                            [
                                "__typename" => "File", 
                                "filename" => "image-(1).jpg", 
                                "uuid" => "98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image-(1).jpg" 
                            ] 
                        ] 
                    ] 
                ] 
             ] 
        ]);
    }
}