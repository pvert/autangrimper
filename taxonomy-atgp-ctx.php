<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

get_header(); 

// recup le slug de la taxonomie du term courant
$term = get_queried_object();
$taxonomy = $term->taxonomy;
$affichage_portfolio = get_field('sedoo_affichage_en_portfolio', $term);
?>

<div class="site-branding" 
    <?php 
    if (get_the_post_thumbnail_url()) {
    ?>
    style="background-image:url(
    <?php //the_post_thumbnail_url( 'full' ); ?>
    );">
    <?php 
    }
    ?>
    <div>    
		<h1 class="site-title" rel="bookmark" style="<?php ?>"><span><?php echo $term->name;?></span></h1>
    </div>
</div><!-- .site-branding -->


<div id="content-area" class="wrapper archives">
	<main id="main" class="site-main" role="main">
		<header class="page-header">
			<?php
			// the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->
		
		<?php
	if($affichage_portfolio != true) { // if portfolio then display it, if not just do the normal script

        // SHOW POST
        $defaultListPost = array(
            'title'         => 'News',
            'posttype'      => 'post',
            'taxonomy'      => $taxonomy,
            'post_number'   => '3', 
            'post_offset'   => '0',
        );
        // SHOW RESEARCH-TEAM
        $defaultListTeam = array(
                'title'         => 'Research teams',
                'posttype'      => 'sedoo-research-team',
                'taxonomy'      => $taxonomy,
                'post_number'   => '-1', 
                'post_offset'   => '0',
        );
        // SHOW AXE
        $defaultListAxe = array(
                'title'         => 'Axes',
                'posttype'      => 'sedoo-axe',
                'taxonomy'      => $taxonomy,
                'post_number'   => '-1', 
                'post_offset'   => '0',
        );
        // SHOW PLATFORM
        $defaultListPlatform =  array(
                'title'         => 'Platforms',
                'posttype'      => 'sedoo-platform',
                'taxonomy'      => $taxonomy,
                'post_number'   => '-1', 
                'post_offset'   => '0',
        );
        // SHOW PROJECT
        $defaultListProject =  array(
            'title'         => 'Projects',
            'posttype'      => 'sedoo-project',
            'taxonomy'      => $taxonomy,
            'post_number'   => '-1', 
            'post_offset'   => '0',
        );
        // SHOW SNO
        $defaultListSno =  array(
            'title'         => 'SNO',
            'posttype'      => 'sedoo-sno',
            'taxonomy'      => $taxonomy,
            'post_number'   => '-1', 
            'post_offset'   => '0',
        );
        // SHOW Instruments
        $defaultListInstruments =  array(
            'title'         => 'Instruments',
            'posttype'      => 'sedoo_instruments',
            'taxonomy'      => $taxonomy,
            'post_number'   => '-1', 
            'post_offset'   => '0',
        );

		switch ($taxonomy) {
			case 'sedoo-theme-labo':
				$whatToShow= array(
                    '1' => $defaultListPost,
                    '2' => $defaultListTeam,
                    '3' => $defaultListProject,
                    '4' => $defaultListSno,
                    '5' => $defaultListAxe,
                    '6' => $defaultListPlatform,
                    '7' => $defaultListInstruments,       
                );
				break;
            case 'sedoo-axe-tag':
				$whatToShow= array(
                    '1' => $defaultListPost,
                    '2' => $defaultListTeam,
                    '3' => $defaultListPlatform,
                );
				break;
            case 'sedoo-platform-tag':
                    $whatToShow= array(
                        '1' => $defaultListPost,
                        '2' => $defaultListPlatform,
                        '3' => $defaultListTeam,
                        '4' => $defaultListAxe,
                        '5' => $defaultListInstruments,
                    );
                break;
            case 'sedoo-project-tag':
                    $whatToShow= array(
                        '1' => $defaultListPost,
                        '2' => $defaultListProject,
                        '3' => $defaultListTeam,
                    );
                break;
            case 'sedoo-ano-tag':
                    $whatToShow= array(
                        '1' => $defaultListPost,
                        '2' => $defaultListSno,
                        '3' => $defaultListTeam,
                    );
                break;
		}

        //sedoo_labtools_get_associate_content_arguments($title, $type_of_content, $taxonomy, $post_number, $post_offset, $className)
        $className="";
        $layout="";
        $show_more="";
        $show_more_text="";
        foreach ($whatToShow as $display) {
            sedoo_labtools_get_associate_content_arguments($display['title'], $display['posttype'], $display['taxonomy'], $display['post_number'], $display['post_offset'], $layout, $className, $show_more, $show_more_text );
        }
    } else {
        ?>
        <script>
            ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>
        <style>
            .sedoo_port_action_btn li:hover {
                background-color: <?php echo $code_color; ?> !important;
            }

            .sedoo_port_action_btn li.active {
                background-color: <?php echo $code_color; ?> !important;
            }
        </style>
        <?php 
        archive_do_portfolio_display($term);
    }
		?>


<?php //endif;
//}?>
	
	</main><!-- #main -->
</div><!-- #content-area -->
<?php
get_footer();
?>