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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_admin')->refrences('id')->on('admins');
            $table->integer('id_pelanggan')->refrences('id')->on('customers')->unsigned()->nullable();
            $table->integer('id_supplier')->refrences('id')->on('suppliers')->unsigned()->nullable();
            $table->integer('total_harga');
            $table->integer('tipe_transaksi');
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
        Schema::dropIfExists('transactions');
    }
};
