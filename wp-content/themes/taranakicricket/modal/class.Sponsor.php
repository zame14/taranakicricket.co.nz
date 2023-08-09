<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/25/2019
 * Time: 1:28 PM
 */
class Sponsor extends TCABase
{
    public function getLogo()
    {
        return $this->getPostMeta('sponsor-logo');
    }
    public function getLink()
    {
        return $this->getPostMeta('sponsor-url');
    }
    public function output() {
        $html = '<img src="' . $this->getLogo() . '" alt="' . $this->getTitle() . '" />';

        return $html;
    }
}