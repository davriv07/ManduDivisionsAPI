<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subdivisions_relations', function (Blueprint $table) {
            $table->foreign(['id_division_parent'], 'subdivisions_ibfk_1')->references(['id'])->on('divisions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_division_sub'], 'subdivisions_ibfk_2')->references(['id'])->on('divisions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subdivisions_relations', function (Blueprint $table) {
            $table->dropForeign('subdivisions_ibfk_1');
            $table->dropForeign('subdivisions_ibfk_2');
        });
    }
};
