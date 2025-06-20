<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Tes',
                'template' => 'Template 1',
            ],
            [
                'name' => 'Testing',
                'template' => 'Template 2',
            ],
        ];

        foreach ($data as $template) {
            Template::firstOrCreate(
                ['name' => $template['name']],
                $template
            );
        }
    }
}
