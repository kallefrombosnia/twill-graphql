<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class RevisionTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testGetAllModuleRelatedRevisions(): void
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
            revisions: [Revision]! @hasMany
        }
    
        type Revision {
            id: ID!
            category_id: Int!
            user_id: Int!
            payload: String!
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
                revisions{
                    __typename ... on Revision{
                        id
                        category_id
                        user_id
                        payload
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
                        "revisions" => [
                            [
                                "__typename" => "Revision",
                                "id" => "1",
                                "category_id" => 1,
                                "user_id" => 1,
                                "payload" => '{"title":"TEST","published":true,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}]}'
                            ],
                            [
                                "__typename" => "Revision",
                                "id" => "2",
                                "category_id" => 1,
                                "user_id" => 1,
                                "payload" => '{"title":"TEST","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"single_file[sl]":[{"id":2,"name":"package.json","src":"http:\/\/domain.test\/storage\/uploads\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\/package.json","original":"http:\/\/domain.test\/storage\/uploads\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\/package.json","size":"92 B","filesizeInMb":"0.00","tags":[],"deleteUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/2","updateUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/bulk-delete","disabled":false}]},"browsers":[],"blocks":[],"repeaters":[]}'
                            ]
                        ]
                    ],
                    [
                        "id" => "2",
                        "published" => 1,
                        "title" => "Cars",
                        "description" => "Cars are awesome.",
                        "revisions" => [
                            [
                                "__typename" => "Revision",
                                "id" => "3",
                                "category_id" => 2,
                                "user_id" => 1,
                                "payload" => '{"description":"Cars are awesome.","title":"Cars","slug":null,"tags":"first,second","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
                            ],
                            [
                                "__typename" => "Revision",
                                "id" => "4",
                                "category_id" => 2,
                                "user_id" => 1,
                                "payload" => '{"description":"Cars are awesome.","tags":["first","second"],"title":"Cars","slug":null,"cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
                            ],
                            [
                                "__typename" => "Revision",
                                "id" => "5",
                                "category_id" => 2,
                                "user_id" => 1,
                                "payload" => '{"description":"Cars are awesome.","title":"Cars","slug":null,"tags":"first,second,third","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
                            ],
                            [
                                "__typename" => "Revision",
                                "id" => "6",
                                "category_id" => 2,
                                "user_id" => 1,
                                "payload" => '{"description":"Cars are awesome.","title":"Cars","slug":null,"tags":"first,second","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
                            ],
                            [
                                "__typename" => "Revision",
                                "id" => "7",
                                "category_id" => 2,
                                "user_id" => 1,
                                "payload" => '{"description":"Cars are awesome.","tags":["first","second"],"title":"Cars","slug":null,"cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[{"id":10,"type":"a17-block-quote","editor_name":"default","content":{"quote":"TEST 2"},"medias":[],"browsers":[],"blocks":[]}],"repeaters":[]}'
                            ],
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
        '
        )->assertExactJson([
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
