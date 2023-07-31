<?php
namespace Utils;

include_once __DIR__."/../env.php";

class ManageImagesHelper
{
    private const ALLOWED_TYPES = [
        "jpg",
        "jpeg",
        "png",
        "webp",
    ];

    public static function returnAllowedTypesAsStr()
    {
        $allowedTypes = "";
        foreach (self::ALLOWED_TYPES as $type) {
            $allowedTypes .= ".$type, ";
        }
        $allowedTypes = substr($allowedTypes, 0, -2);
        
        return $allowedTypes;
    }

    public static function Upload(mixed $file)
    {
        global $env;

        $filesName = [];

        for ($i=0; $i < count($file["name"]); $i++)
        {
            if(self::validateFileType($file['name'][$i]))
            {
                $fileName = 
                    $env['STORAGE_PATH'] .
                    DIRECTORY_SEPARATOR .
                    date("dmYhis") .
                    $i.
                    "." .
                    pathinfo($file['name'][$i], PATHINFO_EXTENSION
                );

                $destination_path = 
                    $env['BASE_PATH'].
                    DIRECTORY_SEPARATOR.
                    $fileName
                ;

                if(move_uploaded_file(
                    $file['tmp_name'][$i],
                    $destination_path
                ))
                    $filesName[] = $fileName;
                else
                    $filesName[] = null;
            } else {
                $filesName[] = null;
            }
        }

        return $filesName;
    }

    private static function validateFileType(string $fileName)
    {
        $fileNameBreaked = explode(".", $fileName);

        if (in_array(
            $fileNameBreaked[sizeof($fileNameBreaked) - 1],
            self::ALLOWED_TYPES
        )) {
            return true;
        }

        return false;
    }

    public static function Delete(string $fileName)
    {
        $status = false;

        if(file_exists($fileName))
        {
            $status = unlink($fileName) ? True  : False;
        }

        return $status;
    }
}