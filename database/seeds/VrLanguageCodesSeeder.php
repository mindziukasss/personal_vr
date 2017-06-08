<?php

use App\Models\VrLanguageCodes;
use Illuminate\Database\Seeder;

class VrLanguageCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language_codes = [
            ["id" => "en", "language_code" => "en", "name" => "English"],
            ["id" => "lt", "language_code" => "lt", "name" => "Lietuvių"],
            ["id" => "ru", "language_code" => "ru", "name" => "Русский"],
            ["id" => "de", "language_code" => "de", "name" => "Deutsch"],
            ["id" => "fr", "language_code" => "fr", "name" => "Français"],




        ];
        DB::beginTransaction();
        try {
            foreach ($language_codes as $item) {
                $record = VrLanguageCodes::find($item['id']);
                if (!$record) {
                    VrLanguageCodes::create($item);
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            echo 'Point of failure '. $e->getCode() . ' ' . $e->getMessage();
            throw new Exception($e);
        }
        DB::commit();
    }
}
