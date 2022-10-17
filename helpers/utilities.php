<?php

/**
 * @param $file - file to convert
 * @return string - Converted file to URL respective to server root.
 */
function fileToUrl($file): string
{
    if (!file_exists($file)) return false;

    $file = str_replace("/" , "\\" , $file);
    $dir = str_replace("/" , "\\" , $_SERVER["DOCUMENT_ROOT"]);

    return str_replace($dir , "" , $file);
}


/**
 * @param string $source
 * @param string $destination
 * @param array $format
 * @return bool|string
 *
 * Moves uploaded source image to given destination, if it cannot be moved, it returns false.
 * Source should be valid Image.
 */
function move_uploaded_image_file(
    string $source ,
    string $destination ,
    array  $format = array('jpg' => 'image/jpeg' , 'png' => 'image/png' , 'gif' => 'image/gif' ,)
): bool|string
{
    $fInfo = new finfo(FILEINFO_MIME_TYPE);

    $ext = array_search($fInfo->file($source) , $format , true);

    if (!$ext) return false;

    $hash = sha1_file($source);
    $image_dest = sprintf("%s/img_%s.%s" , $destination , $hash , $ext);

    if (file_exists($image_dest)) return $image_dest;

    if (move_uploaded_file($source , $image_dest)) {
        return $image_dest;
    } else return false;
}

