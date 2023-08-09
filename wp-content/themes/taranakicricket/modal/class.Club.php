<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/1/2019
 * Time: 11:40 AM
 */
class Club extends TCABase
{
    public function getLogo()
    {
        return $this->getPostMeta('club-logo');
    }
    public function getImage()
    {
        return $this->getPostMeta('club-feature-image');
    }
    public function getWebsite()
    {
        return $this->getPostMeta('club-website');
    }
    public function getFacebook()
    {
        return $this->getPostMeta('club-facebook');
    }
    public function getMap()
    {
        return $this->getPostMeta('google-map-location');
    }
    public function getMap2()
    {
        return $this->getPostMeta('google-map-location-2');
    }
    public function getMap3()
    {
        return $this->getPostMeta('google-map-location-3');
    }
    function getMedia()
    {
        $html = '
        <ul class="club-media">';
        if($this->getFacebook() <> "")
        {
            $html .= '<li><a href="' . $this->getFacebook() . '" target="_blank"><span class="fa fa-facebook-square"></span></a></li>';
        }
        if($this->getWebsite() <> "")
        {
            $html .= '<li><a href="' . $this->getWebsite() . '" target="_blank"><span class="fa fa-globe"></span></a></li>';
        }
        $html .= '
        </ul>';
        
        return $html;
    }
    function getClubImage()
    {
        if($this->getImage() <> "")
        {
            $imageid = getImageID($this->getImage());
            $img = wp_get_attachment_image_src($imageid, 'action');
        } else {
            $imageid = getImageID($this->getLogo());
            $img = wp_get_attachment_image_src($imageid, 'logo');
        }
        $html = '
        <div class="image-wrapper">
            <img src="' . $img[0] . '" alt="' . $this->getTitle() . '" />
        </div>';

        return $html;
    }
    public function previous()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID < ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="club" 
        ORDER BY p.ID DESC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $previd = $result[0]->ID;
        if($previd == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="club"
            ORDER BY p.ID DESC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $previd = $result1[0]->ID;

        }

        return new Club($previd);
    }
    public function next()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID 
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID > ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="club" 
        ORDER BY p.ID ASC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $nextid = $result[0]->ID;
        if($nextid == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="club"
            ORDER BY p.ID ASC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $nextid = $result1[0]->ID;

        }
        return new Club($nextid);
    }
    function displayMaps()
    {
        if($this->getMap2() <> "" && $this->getMap3() <> "")
        {
            $html = '
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 map-wrapper">
                <iframe src="https://www.google.com/maps/embed?' . $this->getMap() . '" width="1140" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 map-wrapper">
                <iframe src="https://www.google.com/maps/embed?' . $this->getMap2() . '" width="1140" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 map-wrapper">
                <iframe src="https://www.google.com/maps/embed?' . $this->getMap3() . '" width="1140" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>';
        }
        else if($this->getMap2() <> "" && $this->getMap3() == "")
        {
            $html = '
            <div class="col-12 col-sm-6 map-wrapper">
                <iframe src="https://www.google.com/maps/embed?' . $this->getMap() . '" width="1140" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-12 col-sm-6 map-wrapper">
                <iframe src="https://www.google.com/maps/embed?' . $this->getMap2() . '" width="1140" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>';
        }
        else
        {
            $html = '
            <div class="col-12 map-wrapper">
                <iframe src="https://www.google.com/maps/embed?' . $this->getMap() . '" width="1140" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>';
        }
        return $html;
    }
}