<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToBookSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_sections', function (Blueprint $table) {
            $table->bigInteger('parent_id')->unsigned()->nullable();

            $table->foreign('parent_id')
                  ->references('id')->on('book_sections')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_sections', function (Blueprint $table) {
            $table->dropForeign('book_sections_parent_id_foreign');

            $table->dropColumn('parent_id');
        });
    }
}
