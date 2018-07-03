<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 7/3/18
 * Time: 5:54 PM
 */

namespace epo\entities;


class ArchiveInfo
{
    const ERROR = 0;
    const DOWNLOADED = 1;
    const EXTRACTED = 2;
    const HANDELED = 3;

    public $url;
    public $filename;
    public $status;

}