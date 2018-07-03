<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 7/3/18
 * Time: 5:22 PM
 */

namespace epo\FileManager\src;


use ZipArchive;

class FileManager
{
    public $dir;

    public function extract($zipPath)
    {
        $zip = new ZipArchive;
        $res = $zip->open($zipPath);
        if ($res === TRUE) {
            $zip->extractTo('/myzips/extract_path/');
            $zip->close();
        } else {
            echo 'doh!';
        }
    }
}