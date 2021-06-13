<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Data-Terra
 */

$titleItem=mb_strimwidth(get_the_title(), 0, 70, '...');  
$postType=get_post_type();
echo 'content-sedoo-cpt';
?>
<a class="item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
    <div class="item-img">
        <?php if(has_post_thumbnail()){ ?>
            <?php the_post_thumbnail('thumbnail-plugin'); ?>
        <?php } else { ?>
            <img src="<?php echo esc_url( plugins_url( 'images/empty-mode-'.$postType.'.svg', dirname(__FILE__)) )  ; ?>" alt="" />
        <?php } ?>
    </div>
    <h3><?php echo $titleItem; ?></h3>
</a>    
