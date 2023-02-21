<?php
function saveImage($file)
{
    $whiteList = [IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG];

    if (!in_array(exif_imagetype($file["tmp_name"]), $whiteList)) return false;

    $rand = uniqid(rand(), true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $originalFileName = $rand . '.' . $ext;
    $directoryPath = "./public/images/";

    file_put_contents($directoryPath . $originalFileName, file_get_contents($file["tmp_name"]));

    return $originalFileName;
}
