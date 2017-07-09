<?php

use App\Models\VrMenu;
use App\Models\VrMenuTranslations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VrMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            ["id" => "about", "new_window" => "0", "sequence" => "9"],
            ["id" => "location_time", "new_window" => "0", "sequence" => "8"],
            ["id" => "tickets", "new_window" => "0", "sequence" => "7"],
            ["id" => "sponsors", "new_window" => "0", "sequence" => "6"],

            ["id" => "telesoft", "new_window" => "1", "sequence" => "1", "vr_parent_id" => "sponsors"],
            ["id" => "elektroMarkt", "new_window" => "1", "sequence" => "2", "vr_parent_id" => "sponsors"],
            ["id" => "akropolis", "new_window" => "1", "sequence" => "3", "vr_parent_id" => "sponsors"],
            ["id" => "delfi", "new_window" => "1", "sequence" => "4", "vr_parent_id" => "sponsors"],
            ["id" => "litexpo", "new_window" => "1", "sequence" => "5", "vr_parent_id" => "sponsors"],
            
        ];

        $menuTranslations = [

            ["name" => "Apie", "url" => "/apie", "record_id" => "about", "language_code" => "lt"],
            ["name" => "Vieta ir laikas", "url" => "/vieta_ir_laikas", "record_id" => "location_time", "language_code" => "lt"],
            ["name" => "Bilietai", "url" => "/bilietai", "record_id" => "tickets", "language_code" => "lt"],
            ["name" => "Rėmėjai", "url" => "/rėmėjai", "record_id" => "sponsors", "language_code" => "lt"],

            ["name" => "Telesoft", "url" => "www.telesoft.lt", "record_id" => "telesoft", "language_code" => "lt"],
            ["name" => "Elektro Markt", "url" => "www.elektromarkt.lt", "record_id" => "elektroMarkt", "language_code" => "lt"],
            ["name" => "Akropolis", "url" => "www.akropolis.lt", "record_id" => "akropolis", "language_code" => "lt"],
            ["name" => "Delfi", "url" => "www.delfi.lt", "record_id" => "delfi", "language_code" => "lt"],
            ["name" => "Litexpo", "url" => "www.litexpo.lt", "record_id" => "litexpo", "language_code" => "lt"],


            ["name" => "About", "url" => "/about", "record_id" => "about", "language_code" => "en"],
            ["name" => "Location and time", "url" => "/location_time", "record_id" => "location_time", "language_code" => "en"],
            ["name" => "Tickets", "url" => "/tickets", "record_id" => "tickets", "language_code" => "en"],
            ["name" => "Sponsors", "url" => "/sponsors", "record_id" => "sponsors", "language_code" => "en"],

            ["name" => "Telesoft", "url" => "www.telesoft.en", "record_id" => "telesoft", "language_code" => "en"],
            ["name" => "Elektro Markt", "url" => "www.elektromarkt.en", "record_id" => "elektroMarkt", "language_code" => "en"],
            ["name" => "Akropolis", "url" => "www.akropolis.en", "record_id" => "akropolis", "language_code" => "en"],
            ["name" => "Delfi", "url" => "www.delfi.en", "record_id" => "delfi", "language_code" => "en"],
            ["name" => "Litexpo", "url" => "www.litexpo.en", "record_id" => "litexpo", "language_code" => "en"],





        ];


        DB::beginTransaction();
        try {
            foreach ($menu as $item) {
                $record = VrMenu::find($item['id']);
                if (!$record) {
                    VrMenu::create($item);
                }
            }

            foreach ($menuTranslations as $menuTranslation) {
                $record = VrMenuTranslations::where('record_id', $menuTranslation ['record_id'])
                                            ->where('language_code', $menuTranslation ['language_code'])
                                            ->first();
                if (!$record) {
                    VrMenuTranslations::create($menuTranslation);
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
