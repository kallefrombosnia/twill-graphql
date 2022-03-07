<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use A17\Twill\Models\File;

class FileSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // File 1
        $file = new File();
        $file->deleted_at = null;
        $file->uuid = '78c18b36-6d6a-4fa1-8724-41c6b49a5157/testbench.yaml';
        $file->filename = 'testbench.yaml';
        $file->size = 23;

        $file->save();

        // File 2
        $file = new File();
        $file->deleted_at = null;
        $file->uuid = 'a05cc377-4e44-49e0-8a1a-4d83e517d05d/package.json';
        $file->filename = 'package.json';
        $file->size = 92;

        $file->save();

        // File 3
        $file = new File();
        $file->deleted_at = null;
        $file->uuid = '98f7f3c2-8f70-43e5-bdf4-59ed75b10384/apoteka.jpg';
        $file->filename = 'apoteka.jpg';
        $file->size = 213255;

        $file->save();

        // File 4
        $file = new File();
        $file->deleted_at = null;
        $file->uuid = '98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image.jpg';
        $file->filename = 'image.jpg';
        $file->size = 65075;

        $file->save();

        // File 5
        $file = new File();
        $file->deleted_at = null;
        $file->uuid = '98f7f3c2-8f70-43e5-bdf4-59ed75b10384/image-(1).jpg';
        $file->filename = 'image-(1).jpg';
        $file->size = 117936;

        $file->save();

    }
}
