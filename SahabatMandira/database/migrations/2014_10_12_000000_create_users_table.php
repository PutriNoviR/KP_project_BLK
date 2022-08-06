<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('email')->unique()->primary();
            $table->string('nomor_identitas', 16);
            $table->enum('tipe_identitas',['WNA', 'WNI']);
            $table->string('nama_depan', 250);
            $table->string('nama_belakang', 250);
            $table->string('nomer_hp', 12);
            $table->string('kota', 250);
            $table->string('alamat', 250);
            $table->string('username', 45);
            $table->string('password', 250);
            $table->string('ktp',500)->nullable();
            $table->string('pas_foto', 500)->nullable();
            $table->string('ijazah',500)->nullable();
            $table->string('ksk', 500)->nullable();
            $table->tinyInteger('is_verified')->nullable();
            $table->bigInteger('verified_by')->nullable();
            // $table->timestamps('verified_at');
            $table->rememberToken();
            $table->timestamps();
            $table->bigInteger('roles_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
