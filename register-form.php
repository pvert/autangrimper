<?php
/**
 * template for Research Teams CPT (show post / platform associate by theme taxonomy)
*/

acf_form_head();
get_header(); 
while ( have_posts() ) : the_post();

?> 

<div id="content-area" class="wrapper">
   <main id="main" class="site-main">
      <div class="wrapper-content">
         <header>
               <h1><?php the_title(); ?></h1>
            </header>
            <section>
            <?php the_content(); ?>
            <hr>
            <h2>Formulaire d'inscription</h2>
            <div id="atgp-display-total">
               <div id="groupPriceArray"></div>
               <div id="reducPriceArray"></div>
               <button>Mettre à jour le montant</button>
            </div>
            <?php
               acf_form(array(
                  'post_id'       => 'new_post',
                  'new_post'      => array(
                     'post_type'     => 'atgp-member',
                     'post_status'   => 'publish',
                  ),
                  'submit_value'  => 'Valider le dossier',
                  'updated_message' => __("Inscription enregistrée", 'acf'),
                  'label_placement' => 'left',
                  'instruction_placement' => 'field',  // label
                  // 'post_content' => true,
                  // 'field_groups' => [4]),
                  // 'post_title' => true,
               )); 
            ?>
            </section>
		</div>
	</main>
</div>
<?php
endwhile; 
get_footer();
