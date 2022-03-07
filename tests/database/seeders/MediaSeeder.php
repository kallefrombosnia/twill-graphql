<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use A17\Twill\Models\Media;

class MediaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Media 1
        $file = new Media();
        $file->deleted_at = null;
        $file->uuid = '3f07596e-c964-4804-bbf8-8be0bd43521d/image-7.png';
        $file->filename = 'image (7).png';
        $file->alt_text = 'Image 7';
        $file->width = 2412;
        $file->height = 197;
        $file->caption = null;

        $file->save();

        // Media 2
        $file = new Media();
        $file->deleted_at = null;
        $file->uuid = '7da9c919-2f63-41e7-b4ad-f41514bf2161/xlsx.png';
        $file->filename = 'xlsx.png';
        $file->alt_text = 'Xlsx';
        $file->width = 872;
        $file->height = 96;
        $file->caption = null;

        $file->save();

        // Media 3
        $file = new Media();
        $file->deleted_at = null;
        $file->uuid = '437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-12-19.jpg';
        $file->filename = '2020-12-19.jpg';
        $file->alt_text = '2020 12 19';
        $file->width = 408;
        $file->height = 306;
        $file->caption = null;

        $file->save();

        // Media 4
        $file = new Media();
        $file->deleted_at = null;
        $file->uuid = '437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2021-09-29.jpg';
        $file->filename = '2021-09-29.jpg';
        $file->alt_text = '2021 09 29';
        $file->width = 408;
        $file->height = 306;
        $file->caption = null;

        $file->save();

        // Media 5
        $file = new Media();
        $file->deleted_at = null;
        $file->uuid = '437ab87f-cf22-4bb5-9465-7b179b4c4bf5/20210827-123315.jpg';
        $file->filename = '20210827_123315.jpg';
        $file->alt_text = '20210827 123315';
        $file->width = 408;
        $file->height = 544;
        $file->caption = null;

        $file->save();

        // Media 6
        $file = new Media();
        $file->deleted_at = null;
        $file->uuid = '437ab87f-cf22-4bb5-9465-7b179b4c4bf5/2020-08-05.jpg';
        $file->filename = '2020-08-05.jpg';
        $file->alt_text = '2020 08 05';
        $file->width = 426;
        $file->height = 240;
        $file->caption = null;

        $file->save();

    }
}
