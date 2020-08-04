<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $model = new User();

        Schema::create($model->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('Имя полдьзователя');
            $table->string('email')->unique()->comment('login/email пользователя');
            $table->timestamp('email_verified_at')
                ->nullable()
                ->default(DB::raw('UPDATE CURRENT_TIMESTAMP'))
                ->comment('Подтверждение email пользователя');
            $table->string('password')->comment('Пароль от учетной записи');
            $table->rememberToken()->comment('Токен авторизации');
            $table->timestamp('created_at')->useCurrent()->comment('Время создания записи');
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                ->comment('Время обновления данных');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $model = new User();

        Schema::dropIfExists($model->getTable());
    }
}
