<?php

use App\Models\VrMenu;
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
            ["id" => "about", "new_window" => "0", "sequence" => "1"],
            ["id" => "virtual_rooms", "new_window" => "0", "sequence" => "2"],
            ["id" => "location_time", "new_window" => "0", "sequence" => "3"],
            ["id" => "tickets", "new_window" => "0", "sequence" => "4"],
            ["id" => "sponsors", "new_window" => "0", "sequence" => "5"],

            ["id" => "the_lab", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "samsung_rowing", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "fruit_ninja", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "ktu_sailplane", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "space_pirate_trainer", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "hurl", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "tilt_brush", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "final_goal", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "merry_snowballs", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],
            ["id" => "projects_cars", "new_window" => "0", "sequence" => "2", "vr_parent_id" => "virtual_rooms"],

            ["id" => "telesoft", "new_window" => "0", "sequence" => "5", "vr_parent_id" => "sponsors"],
            ["id" => "elektroMarkt", "new_window" => "0", "sequence" => "5", "vr_parent_id" => "sponsors"],
            ["id" => "akropolis", "new_window" => "0", "sequence" => "5", "vr_parent_id" => "sponsors"],
            ["id" => "delfi", "new_window" => "0", "sequence" => "5", "vr_parent_id" => "sponsors"],
            ["id" => "litexpo", "new_window" => "0", "sequence" => "5", "vr_parent_id" => "sponsors"],
            
        ];
        DB::beginTransaction();
        try {
            foreach ($menu as $item) {
                $record = VrMenu::find($item['id']);
                if (!$record) {
                    VrMenu::create($item);
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
