<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/30/2019
 * Time: 10:11 AM
 */
class Player extends TCABase
{
    public function getProfileImage()
    {
        return $this->getPostMeta('mens-profile-image');
    }
    public function getActionShot()
    {
        return $this->getPostMeta('mens-action-shot');
    }
    public function getDOB()
    {
        return $this->getPostMeta('mens-dob');
    }
    public function getBirthplace()
    {
        return $this->getPostMeta('mens-birthplace');
    }
    public function getNickname()
    {
        return $this->getPostMeta('mens-nickname');
    }
    public function getClub()
    {
        return $this->getPostMeta('mens-club');
    }
    public function getRole()
    {
        return $this->getPostMeta('mens-playing-role');
    }
    public function getMemorableMoment()
    {
        return wpautop($this->getPostMeta('mens-memorable-moment'));
    }
    public function getCrichqID()
    {
        return $this->getPostMeta('mens-crichq-id');
    }
    public function previous($post_type)
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID < ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="' . $post_type . '" 
        ORDER BY p.ID DESC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $previd = $result[0]->ID;
        if($previd == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="' . $post_type . '"
            ORDER BY p.ID DESC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $previd = $result1[0]->ID;

        }

        return new Player($previd);
    }
    public function next($post_type)
    {
        global $wpdb;
        $sql = '
        SELECT p.ID 
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID > ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="' . $post_type . '" 
        ORDER BY p.ID ASC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $nextid = $result[0]->ID;
        if($nextid == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="' . $post_type . '"
            ORDER BY p.ID ASC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $nextid = $result1[0]->ID;

        }
        return new Player($nextid);
    }
}