<?php

namespace App\Validations;

class Validation
{
    /**
     * Validation package
     *
     * @param $request
     * @return void
     */
    public static function packageValidation($request)
    {
        $request->validate([
            'name' => 'required|in:Basic,Medium,Advanced',
            'max_file_size' => 'required',
            'max_file_upload' => 'required|integer',
        ]);
    }
}
