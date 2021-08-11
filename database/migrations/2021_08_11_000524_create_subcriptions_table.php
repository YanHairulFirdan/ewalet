<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcriptions', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigIncrementssubcription_('type_id');
            $table->foreign('subcription_type_id')
                ->references('id')
                ->on('subcription_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamp('started_at');
            $table->timestamp('end_at');
            $table->timestamps();
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcriptions');
    }
}
