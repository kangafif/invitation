<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('avatar');
            $table->string('is_admin')->default(0);
            $table->string('invitation_number')->default(0);
            $table->string('invitation_code')->nullable();
            $table->string('invitation_type')->default('REGULER');
            $table->string('invitation_qr')->nullable();
            $table->string('invitation_link')->nullable();
            $table->string('invitation_status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'is_admin' => 1, 'password' => Hash::make('password'), 'email_verified_at' => '2022-01-02 17:04:58', 'avatar' => 'avatar-1.jpg', 'created_at' => now(),]);
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
