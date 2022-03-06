<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
{
    //use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testGetAllModuleRelatedFiles(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Query{
            categories: [Category] @all
        }
        
        type Category{
            id: ID!
            published: Int!
            title: String
            description: String
            files: [File]! @morphMany
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

        $this->graphQL(/** @lang GraphQL */ '
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
        ')->assertExactJson([
            "data" => [
                "categories" => [
                    [
                        "id" => "1", 
                        "published" => 1, 
                        "title" => "Books", 
                        "description" => "Just a plain description of the books category", 
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

    
    public function testGetSpecificModuleRelatedFiles(): void
    {

        $this->schema = /** @lang GraphQL */ '
        type Query{
            category(id: Int! @eq): Category @find
        }
        
        type Category{
            id: ID!
            published: Int!
            title: String
            description: String
            files: [File]! @morphMany
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
        
        $this->graphQL(/** @lang GraphQL */ '
        {
            category(id: 2) {
                id
                published
                title
                description
                files{
                    __typename
                    ... on File {
                        filename
                        uuid
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
        ]);
    }
    
}