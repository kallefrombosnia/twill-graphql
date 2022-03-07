<?php

namespace Twill\Graphql\Tests\Schema;

use Twill\Graphql\Tests\TestCase;

class MediaTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestSchema();
    }

    public function testGetAllModuleRelatedMedias(): void
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
            medias: [Media]! @morphMany
        }
    
        type Media {
            id: ID!
            uuid: String!
            alt_text: String
            width: Int!
            height: Int!
            caption: String
            filename: String!
            pivot: MediaPivot
        }
          
        type MediaPivot {
            crop: String
            role: String
            crop_w: Int
            crop_h: Int
            crop_x: Int
            crop_y: Int
            lqip_data: String
            ratio: String
            metadatas: String
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
                medias{
                    __typename ... on Media {
                        filename
                        uuid
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
                        "medias" => [
                            [
                                "__typename" => "Media",
                                "filename" => "2020-12-19.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2020-12-19.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "20210827_123315.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "20210827_123315.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2021-09-29.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2021-09-29.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2020-08-05.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2020-08-05.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
                            ]
                        ]
                    ],
                    [
                        "id" => "2",
                        "published" => 1,
                        "title" => "Cars",
                        "description" => "Cars are awesome.",
                        "medias" => [
                            [
                                "__typename" => "Media",
                                "filename" => "xlsx.png",
                                "uuid" => "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "xlsx.png",
                                "uuid" => "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "image (7).png",
                                "uuid" => "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png"
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "image (7).png",
                                "uuid" => "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png"
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }


    public function testGetSpecificModuleRelatedMedias(): void
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
            medias: [Media]! @morphMany
        }
    
        type Media {
            id: ID!
            uuid: String!
            alt_text: String
            width: Int!
            height: Int!
            caption: String
            filename: String!
            pivot: MediaPivot
        }
          
        type MediaPivot {
            crop: String
            role: String
            crop_w: Int
            crop_h: Int
            crop_x: Int
            crop_y: Int
            lqip_data: String
            ratio: String
            metadatas: String
        }
        ';

        $this->graphQL(
            /** @lang GraphQL */
            '
        {
            category(id: 1) {
                id
                published
                title
                description
                medias{
                    __typename
                    ... on Media {
                        filename
                        uuid
                    }
                }
            }
        }
        '
        )->assertExactJson([
            "data" => [
                "category" => [
                    "id" => "1",
                    "published" => 1,
                    "title" => "Books",
                    "description" => "Just a plain description of the books category",
                    "medias" => [
                        [
                            "__typename" => "Media",
                            "filename" => "2020-12-19.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "2020-12-19.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "20210827_123315.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "20210827_123315.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "2021-09-29.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "2021-09-29.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "2020-08-05.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
                        ],
                        [
                            "__typename" => "Media",
                            "filename" => "2020-08-05.jpg",
                            "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg"
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function testGetAllModuleRelatedMediasWithPivot(): void
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
            medias: [Media]! @morphMany
        }
    
        type Media {
            id: ID!
            uuid: String!
            alt_text: String
            width: Int!
            height: Int!
            caption: String
            filename: String!
            pivot: MediaPivot
        }
          
        type MediaPivot {
            crop: String
            role: String
            crop_w: Int
            crop_h: Int
            crop_x: Int
            crop_y: Int
            lqip_data: String
            ratio: String
            metadatas: String
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
                medias{
                    __typename ... on Media {
                        filename
                        uuid
                        pivot{
                            crop
                            role
                            crop_w
                            crop_h
                            crop_x
                            crop_y
                            lqip_data
                            ratio
                            metadatas
                        }
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
                        "medias" => [
                            [
                                "__typename" => "Media",
                                "filename" => "2020-12-19.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg",
                                "pivot" => [
                                    "crop" => "default",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "default",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2020-12-19.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg",
                                "pivot" => [
                                    "crop" => "mobile",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "mobile",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "20210827_123315.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg",
                                "pivot" => [
                                    "crop" => "default",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "default",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "20210827_123315.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg",
                                "pivot" => [
                                    "crop" => "mobile",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "mobile",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2021-09-29.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg",
                                "pivot" => [
                                    "crop" => "default",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "default",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2021-09-29.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg",
                                "pivot" => [
                                    "crop" => "mobile",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "mobile",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2020-08-05.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg",
                                "pivot" => [
                                    "crop" => "default",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "default",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "2020-08-05.jpg",
                                "uuid" => "437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg",
                                "pivot" => [
                                    "crop" => "mobile",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "mobile",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ]
                        ]
                    ],
                    [
                        "id" => "2",
                        "published" => 1,
                        "title" => "Cars",
                        "description" => "Cars are awesome.",
                        "medias" => [
                            [
                                "__typename" => "Media",
                                "filename" => "xlsx.png",
                                "uuid" => "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png",
                                "pivot" => [
                                    "crop" => "default",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "default",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "xlsx.png",
                                "uuid" => "7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png",
                                "pivot" => [
                                    "crop" => "mobile",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "mobile",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "image (7).png",
                                "uuid" => "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png",
                                "pivot" => [
                                    "crop" => "default",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "default",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ],
                            [
                                "__typename" => "Media",
                                "filename" => "image (7).png",
                                "uuid" => "3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png",
                                "pivot" => [
                                    "crop" => "mobile",
                                    "role" => "cover",
                                    "crop_w" => null,
                                    "crop_h" => null,
                                    "crop_x" => null,
                                    "crop_y" => null,
                                    "lqip_data" => null,
                                    "ratio" => "mobile",
                                    "metadatas" => '{"caption":null,"altText":null,"video":null}'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}
