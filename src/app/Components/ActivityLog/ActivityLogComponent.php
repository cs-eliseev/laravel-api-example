<?php

declare(strict_types=1);

namespace App\Components\ActivityLog;

use App\Components\ActivityLog\Helpers\ActivityLogLangHelper;
use App\Models\ActivityLog;
use App\Helpers\ErrorMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

/**
 * Class ActivityLog
 *
 * @description Журнал действий пользователя.
 */
final class ActivityLogComponent
{
    /**
     * @var ActivityLog|null $activityLog
     */
    private static ?ActivityLog $activityLog = null;

    /**
     * Обработка активности.
     *
     * @param string $description
     *
     * @return void
     */
    public static function handler($description = null): void
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        $method = Request::method();

        if (is_null($description)) {
            $description = ActivityLogLangHelper::getDefaultDescriptionByMethod($method)
                . ' ' . Request::path();
        }

        $param = Request::all();

        if (key_exists('password', $param)) {
            $param['password'] = '******';
        }

        $data = [
            'description'   => $description,
            'user_id'       => $userId,
            'method'        => $method,
            'route'         => Request::fullUrl(),
            'extra'         => $param,
            'ip'            => Request::ip(),
        ];

        $validator = Validator::make($data, ActivityLog::getRules());
        if ($validator->fails()) {
            Log::error(
                'Activity log, validation failed: '
                . ErrorMessage::prepareValidateErrorMessage($validator->errors(), $data)
            );
        } else {
            self::$activityLog = new ActivityLog();
            self::$activityLog->user_id = $data['user_id'];
            self::$activityLog->method = $data['method'];
            self::$activityLog->route = $data['route'];
            self::$activityLog->extra = $data['extra'];
            self::$activityLog->ip = $data['ip'];
            self::$activityLog->description = $data['description'];
            self::$activityLog->save();
        }
    }

    /**
     * Вернуть модель журнала действий пользователя.
     *
     * @return ActivityLog|null
     */
    public static function getModel(): ?ActivityLog
    {
        return self::$activityLog;
    }

    /**
     * Обновить пользоватея.
     */
    public static function updateUser(): void
    {
        if (!empty(self::$activityLog) && !empty(Auth::user())) {
            self::$activityLog->user()->associate(Auth::user());
            self::$activityLog->save();
        }
    }

    /**
     * Установить код статуса ответа.
     *
     * @param int $status
     */
    public static function setStatusCode(int $status): void
    {
        if (!empty(self::$activityLog)) {
            self::$activityLog->status = $status;
            self::$activityLog->save();
        }
    }
}
