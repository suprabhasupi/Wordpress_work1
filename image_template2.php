<?php
/*
Template Name: Pic Post Thumbnail
Author: Suprabha supi
Author URI: https://github.com/suprabhasupi
Description: This Template shows five random images from thumbnail post. 
Version: 1.0
*/
?>
<?php 
/* Argument to query all the post from wordpress*/
$args = array('post_type' => 'post');
/* Wordpress Query */
$counter = 0;
$urllist = array();
$the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php
                 if ( has_post_thumbnail()) {
                    /* Getting thumbnail url */
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                    /* Adding image url into an array */
                    array_push($urllist,$large_image_url[0]);
                 }
                /* Count number of element in loop if more than 5 then break */
                    ++$counter;
                    if($counter == 5){
                    break;
                    }
            ?>
        <?php endwhile;?>
        <?php 
        /* Shuffle for  randomness ins array */
        shuffle($urllist);
        /* Looping through each image and displaying */
        foreach ($urllist as $url){
        echo '<a href='.$url.'><img src=' .$url. ' alt="Gallery image" style="width: 200px;height: 200px;margin: 2px;" /></a>';
        }
        ?>
    <?php wp_reset_postdata(); ?>
<?php else :
    /* If no post found */
 ?>
    <p><?php _e( 'Sorry, NO post found!' ); ?></p>
<?php endif; ?>