<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutsourcePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outsource_performances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outsource_id');
            $table->foreign('outsource_id')->references('id')->on('outsources')->onDelete('restrict');

            $table->boolean('trip')->default(0);
            $table->boolean('LoadType');
            $table->string('fonumber');
            $table->unsignedBigInteger('operation_id');
            $table->foreign('operation_id')->references('id')->on('operations')->onDelete('restrict');

            $table->string('driver_name')->nullable();
            $table->string('plate_number')->nullable();

            $table->dateTime('DateDispach');
            $table->unsignedBigInteger('orgion_id');
            $table->foreign('orgion_id')->references('id')->on('places')->onDelete('restrict');

            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')->references('id')->on('places')->onDelete('restrict');

            $table->double('tonkm', 10, 4)->default(0.00);
            $table->double('tariff', 4, 4);
            $table->double('DistanceWCargo', 12, 2);
            $table->double('DistanceWOCargo', 12, 2)->nullable();
            $table->double('CargoVolumMT', 12, 4)->nullable();

            $table->text('comment')->nullable();
            $table->boolean('satus')->default(1);
            $table->bigInteger('user_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outsource_performances');
    }
}
