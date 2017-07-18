<?php

$no_posts = $_GET["postsNum"];
$before = '<li>';
$after = '</li>';
/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");
include_once(ABSPATH . "wp-load.php");
include_once(ABSPATH . "wp-includes/wp-db.php");
include_once(ABSPATH . "wp-includes/post.php");

global $wpdb;
$output = '';

 $options = get_option("widget_MooToolsAccessibleSlider");
    if (!is_array($options)) {
        $options = array(
            'title' => 'MooTools Accessible Slider',
            'label' => 'Number of posts to show',
            'info' => 'Move the slider to select the number of posts to show'
        );
    }

if ($no_posts == 0) {
    $output .= '';
} else {

    $recent_posts = wp_get_recent_posts($no_posts);

    foreach ($recent_posts as $post) {
        $output .= $before . '<a href="' . get_permalink($post["ID"]) . '" title="' .
                $post["post_title"] . '" >' . $post["post_title"] . '</a>' . $after;
    }
}

$stuffToReturn = array();
$stuffToReturn["list"] = $output;
echo json_encode($stuffToReturn);
?>
