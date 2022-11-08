<?php

namespace common\services\storage;


use yii\web\UploadedFile;

class StorageService implements IStorageService
{
    public const LOGO_CATALOG = 'logo';

    private string $uploadDir;

    public function __construct()
    {
        $this->uploadDir = \Yii::getAlias('@frontend') . '/web/uploads/';
    }

    public function saveAs(UploadedFile $file, string $dir = ''): ?string
    {
        $path = $this->uploadDir . $dir . '/';
        $path = str_replace('//', '/', $path);

        if (!file_exists($path)) {
            mkdir($path, 777, true);
        }

        $name = substr(md5($file->baseName), 0, 7) . time();
        if ($file->saveAs($path . $name . '.' . $file->extension)) {
            return str_replace('//', '/', "uploads/$dir/$name.{$file->extension}");
        }

        return null;
    }

    public function dropFile(string $path): bool
    {
        if (file_exists($this->uploadDir . $path)) {
            return unlink($this->uploadDir . $path);
        }

        return true;
    }
}