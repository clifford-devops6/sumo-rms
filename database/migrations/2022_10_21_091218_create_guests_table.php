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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('identification_type')->comment('national_id/passport');
            $table->string('identification_number');
            $table->string('email_address')->nullable();
            $table->string('cellphone_one')->nullable();
            $table->string('cellphone_two')->nullable();
            $table->string('address')->nullable();
            $table->string('vehicle_reg')->nullable();
            $table->bigInteger('tenant_id')->index()->unsigned();

            $table->foreign('tenant_id')->references('id')->on('tenants')
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
        Schema::dropIfExists('guests');
    }
};
