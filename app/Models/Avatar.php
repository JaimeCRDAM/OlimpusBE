<?php

namespace App\Models;

use File;

class Avatar
{
    public string $imageType;
    public string $base64String;

    public function __construct(string $imageType, string $base64String ){
        $this -> imageType = $imageType;
        $this -> base64String = $base64String;
    }

    public function toFile(): string
    {
        $imageName = $this->generateRandomString() .'.'.$this -> imageType;
        File::put(storage_path(). '/app/public/' . $imageName, base64_decode($this -> base64String));
        return $imageName;
    }

    private function generateRandomString($length = 20): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
