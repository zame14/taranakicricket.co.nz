<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2023
 * Time: 11:33 AM
 */
class Programme extends TCABase
{
    public function getFeatureImage()
    {
        return get_the_post_thumbnail($this->Post, 'grid');
    }
    function getCategory()
    {
        global $wpdb;

        $sql = '
        SELECT t.term_id
        FROM ' . $wpdb->prefix . 'term_relationships tr
        INNER JOIN ' . $wpdb->prefix . 'term_taxonomy t
        ON tr.term_taxonomy_id = t.term_taxonomy_id
        WHERE object_id = ' . $this->id();
        $result = $wpdb->get_results($sql);

        return new Category($result[0]->term_id);
    }
}