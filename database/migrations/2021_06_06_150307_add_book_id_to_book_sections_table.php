<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookIdToBookSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_sections', function (Blueprint $table) {
            $table->bigInteger('book_id')->unsigned();

            $table->foreign('book_id')
                  ->references('id')->on('books')
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
            $table->dropForeign('book_sections_book_id_foreign');

            $table->dropColumn('book_id');
        });
    }
}
