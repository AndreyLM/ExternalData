<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 7/3/18
 * Time: 5:22 PM
 */

namespace epo\FileManager\src;


use ZipArchive;

class ArchiveExtractor
{
    public $path;

    public function extract($zipPath)
    {
        $zip = new ZipArchive;
        $res = $zip->open($zipPath);

        $destination = '/'.trim($this->path.'/').'/'.time();

        if ($res === TRUE) {
            $zip->extractTo($destination);
        } else {
            return false;
        }
        $zip->close();

        return $destination;
    }

}