<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 7/3/18
 * Time: 5:18 PM
 */

namespace epo\connection\src\helpers;


class ParseHelper
{

    /**
     * @param string $rss
     * @param array $keywords
     * @return array
     */
    static function find($rss, $keywords = []) {

        preg_match_all('/<id>(.*('.implode('|', $keywords).').*)<\/id>/i', $rss,$res);

        return $res[1];
    }

    /**
     * @param $url
     * @return string
     */
    static function getFilename($url)
    {
        trim($url);
        $res = preg_split('/\//', $url);

        return array_pop($res);
    }

}