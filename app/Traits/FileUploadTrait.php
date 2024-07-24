<?php

namespace App\Traits;

trait FileUploadTrait
{
    public function uploadFile($file, $path = 'public/images')
    {
        $name = str_replace(" ", "_", $file->getClientOriginalName());

        $fileName = time().'_'.$name;

        $file->storeAs($path, $fileName);

        return $fileName;
    }
}
