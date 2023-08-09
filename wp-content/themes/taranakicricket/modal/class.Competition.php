<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/29/2019
 * Time: 2:01 PM
 */
class Competition extends TCABase
{
    public function getImage()
    {
        return $this->getPostMeta('sc-feature-image');
    }
    public function getCrichqID()
    {
        return $this->getPostMeta('sc-crichq-id');
    }
    public function getGrade()
    {
        return $this->getPostMeta('grade');
    }
}