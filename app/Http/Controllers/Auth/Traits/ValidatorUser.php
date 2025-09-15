<?php

namespace App\Http\Controllers\Auth\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidatorUser {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function validatorImage($reqImage) {
        return Validator::make($reqImage, [
            'image' => [ 'nullable', 'image', 'mimes:png,jpg,jpeg']
        ]);
    }

    protected function validatorOnlyPassword($pass) {
        return Validator::make($pass, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

}
