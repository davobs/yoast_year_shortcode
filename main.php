<?php

/*
Plugin Name: Yoast SEO replace year with shortcode
  
Description:  Yoast SEO replace year with shortcode 
 
Version: 1.0 
*/
add_action('init', 'process_post');

function process_post()
{
    $years = array('2020', '2021', '2022');
    foreach ($years as $year) {
        global $wpdb;
        $results = $wpdb->get_results($wpdb->prepare("SELECT ID, title  FROM {$wpdb->prefix}yoast_indexable WHERE title LIKE '%" . $year . "%' AND object_type = 'post'"));
        foreach ($results as $result) {
            $ID = $result->ID;
            $title = $result->title;
            $newTitle = str_replace($year, "%%currentyear%%", $title);
            $wpdb->update($wpdb->prefix . 'yoast_indexable', array('title' => $newTitle), array('ID' => $ID));

        }
    }
}
