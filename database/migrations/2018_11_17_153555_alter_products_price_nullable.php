<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsPriceNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('products')) {
            if (Schema::hasColumn('products', 'price')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->float('price')->nullable()->default(null)->change();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('products')) {
            if (Schema::hasColumn('products', 'price')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->float('price')->change();
                });
            }
        }
    }
}
