<?php

use App\Models\ActivityLog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = new ActivityLog();

        Schema::create($model->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Данные пользователя');
            $table->string('method')->nullable()->comment('Метод запроса');
            $table->longText('route')->nullable()->comment('Маршрут запроса');
            $table->ipAddress('ip')->nullable()->comment('IP адресс подключения');
            $table->longText('description')->comment('Описание действия');
            $table->timestamp('created_at')->useCurrent()->comment('Время создания записи');
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                ->comment('Время обновления данных');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $model = new ActivityLog();

        Schema::dropIfExists($model->getTable());
    }
}
