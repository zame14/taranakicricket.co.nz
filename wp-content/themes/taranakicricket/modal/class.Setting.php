<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/26/2019
 * Time: 1:05 PM
 */
class Setting extends TCABase
{
    public function hideGoogleMaps()
    {
        return $this->getPostMeta('hide-google-maps');
    }
}