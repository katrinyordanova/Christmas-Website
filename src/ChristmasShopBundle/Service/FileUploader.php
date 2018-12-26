<?php
namespace ChristmasShopBundle\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $image)
    {
        $imageName = md5(uniqid()).'.'.$image->guessExtension();

    try {
        $image->move($this->getTargetDirectory(), $imageName);
    } catch (FileException $e) {
        // ... handle exception if something happens during file upload
    }

        return $imageName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}