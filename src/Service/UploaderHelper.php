<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{

    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadVehicleImage(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath;

        $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFileName = $originalFileName .'-'. uniqid() .'.'.$uploadedFile->guessExtension();

        $uploadedFile->move($destination, $newFileName);

        return $newFileName;
    }
}