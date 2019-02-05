<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadstoreCategoriesAlter extends Migration
{

    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('banner_image_path')->nullable();
        });

    }

    public function down()
    {

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('banner_image_path');
        });

    }

}
