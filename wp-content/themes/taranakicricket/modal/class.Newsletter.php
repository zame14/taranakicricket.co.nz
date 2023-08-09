<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/29/2019
 * Time: 9:07 AM
 */
class Newsletter extends TCABase
{
    public function getNewsletter()
    {
        return $this->getPostMeta('newsletter-link');
    }
}