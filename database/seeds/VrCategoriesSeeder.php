<?php

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use Illuminate\Database\Seeder;

class VrCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $categories = [
            ["id" => "virtual_room"],
        ];

        $categoriesTranslations = [
            ["name" => "Virtualus kambariai","language_code" => "lt", "record_id" => "virtual_room"],
            ["name" => "Virtual rooms","language_code" => "en", "record_id" => "virtual_room"],
            ["name" => "Виртуальные номера","language_code" => "ru", "record_id" => "virtual_room"],
            ["name" => "Virtuelle Räume","language_code" => "de", "record_id" => "virtual_room"],
            ["name" => "Salles virtuelles","language_code" => "fr", "record_id" => "virtual_room"],

        ];

        DB::beginTransaction();
        try {
            foreach ($categories as $category) {
                $record = VrCategories::find($category['id']);
                if (!$record) {
                    VrCategories::create($category);
                }
            }

            foreach ($categoriesTranslations as $categoriesTranslation) {
                $record = VrCategoriesTranslations::where('record_id', $categoriesTranslation ['record_id'])
                                                    ->where('language_code', $categoriesTranslation ['language_code'])
                                                    ->first();
                if (!$record) {
                    VrCategoriesTranslations::create($categoriesTranslation);
                }
            }

        } catch (Exception $e) {
            DB::rollback();
            echo 'Point of failure ' . $e->getCode() . ' ' . $e->getMessage();
            throw new Exception($e);
        }
        DB::commit();
    }
}
