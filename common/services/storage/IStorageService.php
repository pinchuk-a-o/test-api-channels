<?php

namespace common\services\storage;

use yii\web\UploadedFile;

interface IStorageService
{
    public function saveAs(UploadedFile $file, string $dir = '');

    public function dropFile(string $path);
}