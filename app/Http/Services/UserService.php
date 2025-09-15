<?php

namespace App\Http\Services;

class UserService
{

    /**
     * Update the user
     *
     * @param $request
     * @param $user
     * @return void
     */
    public function update($request, $user)
    {
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email') ?? $user->email;
        $user->phone = $request->input('phone') ?? $user->phone;
        $user->save();
    }
}
