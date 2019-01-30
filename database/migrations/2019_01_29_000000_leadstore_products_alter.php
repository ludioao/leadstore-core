<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadstoreProductsAlter extends Migration
{

    public function up()
    {
        Schema::table('products', function(Blueprint $table) {
            $table->boolean('is_featured')->default(0);
        });

    }

    public function down()
    {

        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn(['is_featured']);
        });
    }

}
