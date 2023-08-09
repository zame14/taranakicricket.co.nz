<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/24/2023
 * Time: 11:08 AM
 */
class Blog extends TCABase
{
    public function getFeatureImage($size)
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
}