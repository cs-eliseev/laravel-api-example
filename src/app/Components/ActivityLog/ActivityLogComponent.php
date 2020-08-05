<?php

declare(strict_types=1);

namespace App\Components\ActivityLog;

use App\Components\ActivityLog\Helpers\ActivityLogLangHelper;
use App\Models\ActivityLog;
use App\Helpers\ErrorMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Request;

/**
 * Class ActivityLog
 *
 * @description Журнал действий пользователя.
 *
 */
final class ActivityLogComponent
{
    /**
     * Обработка активности.
     *
     * @param string $description
     *
     * @return void
     */
    public static function handler($description = null)
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        $method = Request::method();

        if (is_null($description)) {
            $description = ActivityLogLangHelper::getDefaultDescriptionByMethod($method)
                . ' ' . Request::path();
        }

        $data = [
            'description'   => $description,
            'user_id'       => $userId,
            'method'        => $method,
            'route'         => Request::fullUrl(),
            'ip'            => Request::ip(),
        ];

        $validator = Validator::make($data, ActivityLog::getRules());
        if ($validator->fails()) {
            Log::error(
                'Activity log, validation failed: '
                . ErrorMessage::prepareValidateErrorMessage($validator->errors(), $data)
            );
        } else {
            $activity = new ActivityLog();
            $activity->user_id = $data['user_id'];
            $activity->method = $data['method'];
            $activity->route = $data['route'];
            $activity->ip = $data['ip'];
            $activity->description = $data['description'];
            $activity->save();
        }
    }
}
