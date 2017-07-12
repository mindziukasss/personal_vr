<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnResourceIdToVrConnectionsPagesResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vr_connections_pages_resources', function(Blueprint $table)
        {
            $table->string('resource_id', 36);
            $table->foreign('resource_id', 'fk_vr_connections_pages_resources_vr_resources1')->references('id')->on('vr_resources')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vr_connections_pages_resources', function(Blueprint $table)
        {
            $table->dropForeign('fk_vr_connections_pages_resources_vr_resources1');
            $table->dropColumn('resource_id');
        });
    }
}
