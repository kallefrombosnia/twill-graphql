<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RevisionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Revision 1
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 1, 
            'payload' => '{"title":"TEST","published":true,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}]}'
        ]);

        // Revision 2
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 1, 
            'payload' => '{"title":"TEST","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"single_file[sl]":[{"id":2,"name":"package.json","src":"http:\/\/domain.test\/storage\/uploads\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\/package.json","original":"http:\/\/domain.test\/storage\/uploads\/a05cc377-4e44-49e0-8a1a-4d83e517d05d\/package.json","size":"92 B","filesizeInMb":"0.00","tags":[],"deleteUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/2","updateUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/file-library\/files\/bulk-delete","disabled":false}]},"browsers":[],"blocks":[],"repeaters":[]}'
        ]);

        // Revision 3
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 2, 
            'payload' => '{"description":"Cars are awesome.","title":"Cars","slug":null,"tags":"first,second","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
        ]);

        // Revision 4
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 2, 
            'payload' => '{"description":"Cars are awesome.","tags":["first","second"],"title":"Cars","slug":null,"cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
        ]);

        // Revision 5
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 2, 
            'payload' => '{"description":"Cars are awesome.","title":"Cars","slug":null,"tags":"first,second,third","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
        ]);

        // Revision 6
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 2, 
            'payload' => '{"description":"Cars are awesome.","title":"Cars","slug":null,"tags":"first,second","cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[],"repeaters":[]}'
        ]);

        // Revision 7
        DB::table('category_revisions')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'user_id' => 1,
            'category_id' => 2, 
            'payload' => '{"description":"Cars are awesome.","tags":["first","second"],"title":"Cars","slug":null,"cmsSaveType":"update","published":true,"public":false,"publish_start_date":null,"publish_end_date":null,"languages":[{"shortlabel":"SL","label":"Slovenian","value":"sl","disabled":false,"published":true}],"parent_id":0,"medias":{"cover":[{"id":2,"name":"xlsx.png","thumbnail":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png","medium":"\/twill.test\/img\/7da9c919-2f63-41e7-b4ad-f41514bf2161\/xlsx.png?fm=jpg&q=80&fit=max&h=430","width":872,"height":96,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Xlsx","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}},{"id":1,"name":"image (7).png","thumbnail":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=60&fit=max&dpr=1&h=256","original":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png","medium":"\/twill.test\/img\/3f07596e-c964-4804-bbf8-8be0bd43521d\/image-7.png?fm=jpg&q=80&fit=max&h=430","width":2412,"height":197,"tags":[],"deleteUrl":null,"updateUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/single-update","updateBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-update","deleteBulkUrl":"http:\/\/twill.test\/zadmin\/media-library\/medias\/bulk-delete","metadatas":{"default":{"caption":null,"altText":"Image 7","video":null},"custom":{"caption":null,"altText":null,"video":null}},"crops":{"default":{"name":"default","width":null,"height":null,"x":null,"y":null},"mobile":{"name":"mobile","width":null,"height":null,"x":null,"y":null}}}]},"browsers":[],"blocks":[{"id":10,"type":"a17-block-quote","editor_name":"default","content":{"quote":"TEST 2"},"medias":[],"browsers":[],"blocks":[]}],"repeaters":[]}'
        ]);

    }
}
