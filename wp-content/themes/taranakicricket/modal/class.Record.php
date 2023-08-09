<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/12/2019
 * Time: 10:52 AM
 */
class Record extends TCABase
{
    public function getPlayer()
    {
        return $this->getPostMeta('player');
    }
    public function getYear()
    {
        return $this->getPostMeta('year');
    }
    public function getPerformance()
    {
        return $this->getPostMeta('performance');
    }
    public function getOpponent()
    {
        return $this->getPostMeta('opponent');
    }
    public function getScorecard()
    {
        $html = '';
        if($this->getPostMeta('honors-scorecard') <> "") {
            $html = '<a href="' . $this->getPostMeta('honors-scorecard') . '" target="_blank"><span class="fa fa-list-alt"></span></a>';
        }
        return $html;
    }
}