<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationMethodResource;
use App\Http\Services\NotificationMethodService;

class NotificationMethodController extends ApiController
{
    /**
     * List all notification methods
     *
     * @param NotificationMethodService $notificationMethodService
     * @return \Illuminate\Http\Response
     */
    public function index(NotificationMethodService $notificationMethodService)
    {
        $appointments = $notificationMethodService->index();

        return $this->sendResponse(NotificationMethodResource::collection($appointments));
    }
}
