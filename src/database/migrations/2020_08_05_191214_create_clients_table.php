<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = new Client();

        Schema::create($model->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->comment('Имя');
            $table->string('last_name')->comment('Фамилия');
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
        $model = new Client();

        Schema::dropIfExists($model->getTable());
    }
}
