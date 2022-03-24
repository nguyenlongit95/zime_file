<?php

namespace App\Validations;

class Validation
{
    /**
     * @param $request
     * @return void
     */
    public static function packageValidation($request)
    {
        $request->validate([
            'name' => 'require|in:Basic,Medium,Advanced',
            'max_file_size' => 'require',
            'max_file_upload' => 'require|integer',
        ]);
    }
}
