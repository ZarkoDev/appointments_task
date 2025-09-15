<?php

namespace App\Http\Services;

use App\Models\NotificationMethod;

class NotificationMethodService
{

    /**
     *  Return active notification methods
     *
     * @param $request
     * @return mixed
     */
    public function index()
    {
        return NotificationMethod::onlyActive()->get();
    }
}
