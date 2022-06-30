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
               <section class="wp-block-buttons is-content-justification-center">
                  <div class="wp-block-button">
                     <button class="wp-block-button__link">Mettre à jour le montant : <span id="TOTAL"></span></button>
                  </div>
               </section>
               <div id="groupPriceArray"></div>
               <div id="alert"></div>
            </div>
            <?php
               acf_form(array(
                  'id'           => 'register-form',
                  'post_id'       => 'new_post',
                  'new_post'      => array(
                     'post_type'     => 'atgp-member',
                     'post_status'   => 'publish',
                  ),
                  'submit_value'  => 'Valider le dossier',
                  'updated_message' => __("<span class=\"success\">Pré-inscription enregistrée,<br>un mail permettant de télécharger votre dossier vous a été envoyé.</span><span class=\"warning\">Attention le mail généré à la fin de la pré-inscription peut attérir dans les courriers indésirables /SPAM, pensez à vérifier.</span><span class=\"info\"><strong>Cette fiche de pré-inscription doit être imprimée, signée et retournée </strong>avec le Certificat médical OU questionnaire santé enfant et le ou les chèques, <strong>le tout déposé dans la boite aux lettres du club</strong>. <br>L’ordre de réception des dossiers déterminera l’attribution des places.</span><span><a href=\"https://autangrimper.fr\" class=\"btn\" title=\"Retour au site\">Retour au site Autan Grimper</a></span>", 'acf'),
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
