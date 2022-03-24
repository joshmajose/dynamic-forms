<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Models\FormElementType;

class FormElementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        FormElementType::truncate();
        Schema::enableForeignKeyConstraints();
        
        $now = Carbon::now()->toDateTimeString();

        $types = [
            ['name' => 'Text', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Number', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Select', 'created_at' => $now, 'updated_at' => $now]
        ];

        FormElementType::insert($types);
    }
}
