<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/25/2019
 * Time: 9:01 PM
 */
class Location extends TCABase
{
    public function getMap()
    {
        return $this->getPostMeta('location-google-map');
    }
}