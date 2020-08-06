<?php

use App\Models\ActivityLog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = new ActivityLog();

        Schema::table($model->getTable(), function (Blueprint $table) {
            $table->unsignedSmallInteger('status')->nullable()->after('route')->comment('Код ответа');
            $table->json('extra')->nullable()->after('status')->comment('Параметры запроса');
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

        Schema::table($model->getTable(), function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
