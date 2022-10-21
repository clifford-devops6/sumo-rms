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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('tenant_id')->index()->unsigned();
            $table->bigInteger('guest_id')->index()->unsigned();
            $table->bigInteger('unit_id')->nullable();
            $table->bigInteger('property_id')->nullable();
            $table->dateTime('appointment_date');
            $table->dateTime('appointment_end_date');
            $table->bigInteger('appointment_status_id')->unsigned()->index();
            $table->text('status_reason')->nullable();
            $table->string('appointment_number')->unique();

            $table->foreign('tenant_id')->references('id')->on('tenants')
                ->cascadeOnDelete();
            $table->foreign('guest_id')->references('id')->on('guests')
                ->cascadeOnDelete();
            $table->foreign('appointment_status_id')->references('id')->on('appointment_statuses')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
