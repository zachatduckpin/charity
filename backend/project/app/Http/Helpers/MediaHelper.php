<?php

namespace App\Http\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class MediaHelper
{


    // image is file
    // field is database field photo name
    // array is image resize width and height
    public static function handleMakeImage($file, $resize_array = null)
    {
        $image_name = MediaHelper::imageNameValidation($file);
        $location = base_path('../assets/images/');

        if ($resize_array) {
            $image = Image::make($file)->resize($resize_array[0], $resize_array[1]);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location . '/' . $image_name);
            } else {
                $image->save($location . '/' . $image_name, 75, $file->getClientOriginalExtension());
            }
        } else {
            $image = Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location . '/' . $image_name);
            } else {
                $image->save($location . '/' . $image_name, 75, $file->getClientOriginalExtension());
            }
        }


        return $image_name;
    }



    // image is file
    // field is database field photo name
    // array is image resize width and height
    public static function handleUpdateImage($file, $field, $resize_array = null)
    {
        //dd($file, $field, $resize_array);
        $image_name = MediaHelper::imageNameValidation($file);

        $locaion = base_path('../assets/images/');

        if ($field && file_exists($locaion . $field)) {
            @unlink($locaion . $field);
        }
        if ($resize_array) {
            $image = Image::make($file)->resize($resize_array[0], $resize_array[1]);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $locaion . '/' . $image_name);
            } else {
                $image->save($locaion . '/' . $image_name, 75, $file->getClientOriginalExtension());
            }
        } else {
            $image = Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $locaion . '/' . $image_name);
            } else {
                $image->save($locaion . '/' . $image_name, 75, $file->getClientOriginalExtension());
            }
        }
        return $image_name;
    }



    public static function handleDeleteImage($field)
    {
        $locaion = base_path('../assets/images/');
        if ($field && file_exists($locaion . $field)) {
            unlink($locaion . $field);
        }
    }


    public static function imageNameValidation($image)
    {
        $extension = $image->getClientOriginalExtension();
        $new_name = rand() . time() . '.' . $extension;
        return $new_name;
    }

    public static function ExtensionValidation($image)
    {
        $extension = ['jpg', 'JPG', 'jpeg', 'JPEG', 'zip', 'pdg', 'csv', 'png', 'PNG', 'pdf', 'doc', 'docx', 'svg'];
        $image_extension = $image->getClientOriginalExtension();
        if (in_array($image_extension, $extension)) {
            return true;
        } else {
            return false;
        }
    }

    public static function ExtensionFileValidation($file)
    {
        $extension = ['zip', 'rar'];
        $image_extension = $file->getClientOriginalExtension();
        if (in_array($image_extension, $extension)) {
            return true;
        } else {
            return false;
        }
    }



    public static function handleMakeFile($file, $resize_array = null)
    {
        $file_name = MediaHelper::imageNameValidation($file);
        $location = base_path('../assets/files/');
        $file->move($location, $file_name);
        return $file_name;
    }

}
