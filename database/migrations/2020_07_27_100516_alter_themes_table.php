<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('themes', function(Blueprint $table)
		{
		    $table->integer('status')->nullable()->default(1)->after('themeText');
                  
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('themes', function(Blueprint $table)
		{
	            
	            $table->dropColumn('status');
           
		});
    }
}
