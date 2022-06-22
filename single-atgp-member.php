<?php
/**
 * template for Research Teams CPT (show post / platform associate by theme taxonomy)
*/

acf_form_head();
get_header(); 
while ( have_posts() ) : the_post();

$status = get_the_terms( get_the_id(), 'atgp-ctx-status');  // recup des terms de la taxonomie $parameters['category']
$terms=array();
if (is_array($status) || is_object($status))
{
   foreach ($status as $term_slug) {        
      array_push($terms, $term_slug->slug);
   }
}

$status = get_the_terms( $post->ID, 'atgp-ctx-status');  
$statusSlugRewrite = "atgp-ctx-status";

//https://autangrimper.fr/wp-content/plugins/autangrimper/printpdf.php?postID=the_ID()

$linkToPDF_generator="pdf/printpdf.php?postID=".get_the_id();
$post_id=get_the_id();
?>
<!-- L'AFFICHAGE COMMENCE ICI -->


<div id="content-area" class="wrapper">

<div class="wrapper-layout">
   <main id="main" class="site-main">
         <article id="post-<?php the_ID();?>">	
            <header>
               <h1><?php the_title(); ?></h1>
               <div>
                     <?php 
                     if( function_exists('sedoo_show_categories') ){
                        sedoo_show_categories($status, $statusSlugRewrite);
                     }
                     ?>
                     <p class="post-meta">Inscription enregistrée le <?php the_date(); ?></p>
               </div>
            </header>
            
            <section>
               <?php the_content(); ?>
               
               <?php
               if ( ! post_password_required() ) {

               $etat_civil=  get_field('atgp_group_etat_civil', $post_id);
               $urgence=  get_field('atgp_group_urgence', $post_id);
               $adhesion=  get_field('atgp_group_adhesion', $post_id);
               $cours=  get_field('atgp_group_cours', $post_id);
               $cout=  get_field('atgp_group_cout', $post_id);
               ?>
               <section class="wp-block-buttons is-content-justification-center">
                  <div class="wp-block-button">
                     <a class="wp-block-button__link" href="<?php echo plugins_url($linkToPDF_generator, __FILE__);?>">Téléchargez votre dossier</a>
                  </div>
               </section>

               <section class="wp-block-columns are-vertically-aligned-center" id="atgp_infos">
                  <div class="wp-block-column is-vertically-aligned-center">
                     <h2>Infos adhérent</h2>
                     <p>Nom : <?php echo $etat_civil['atgp_nom']; ?></p>
                     <p>Prénom : <?php echo $etat_civil['atgp_prenom']; ?></p>
                     <p>Sexe : <?php echo $etat_civil['atgp_sexe']; ?></p>
                     <p>Date de naissance : <?php echo $etat_civil['atgp_date_de_naissance']; ?></p>
                     <p>Lieu de naissance : <?php echo $etat_civil['atgp_lieu_de_naissance']; ?></p>
                     <p>Adresse : <?php echo $etat_civil['atgp_adresse']; ?></p>
                     <p>Code postal : <?php echo $etat_civil['atgp_code_postal']; ?></p>
                     <p>Ville : <?php echo $etat_civil['atgp_ville']; ?></p>
                     <p>Tel mobile : <?php echo $etat_civil['atgp_tel']; ?></p>
                     <p>Tel fixe : <?php echo $etat_civil['atgp_tel_fixe']; ?></p>
                     <p>Courriel : <?php echo $etat_civil['atgp_courriel']; ?></p>
                  </div>
                  <div class="wp-block-column is-vertically-aligned-center">
                     <h2>En cas d'urgence</h2>
                     <p>Personne à contacter : <?php echo $urgence['atgp_nom_urgence']; ?> <?php echo $urgence['atgp_prenom_urgence']; ?></p>
                     <p>Tel 1 : <?php echo $urgence['atgp_tel_urgence']; ?></p>
                     <p>Tel 2 : <?php echo $urgence['atgp_fixe_urgence']; ?></p> 

                     <h2>Adhésion</h2>
                     <p>Type d'adhésion : <?php echo $adhesion['atgp_type_dadhesion']; ?></p>
                     <?php 
                     if ($adhesion['atgp_type_dadhesion'] = 2) {
                     ?>
                     <p>Numéro de licence : <?php echo $adhesion['atgp_licence']; ?></p>
                     <?php
                     }
                     ?>
                     <p>Certificat médical ou Questionnaire santé établit le : <?php echo $adhesion['atgp_group_adhesion_group_certificat']['atgp_group_adhesion_certificat_date'];?></p>
                     <p>Médécin  : <?php echo $adhesion['atgp_group_adhesion_group_certificat']['atgp_group_adhesion_certificat_medecin'];?></p> 
                  </div>       
               </section>

               <section class="wp-block-columns" id="atgp_groupe">
                  <div class="wp-block-column" id="atgp_groupe_main">
                     <h3>Groupe(s) choisis (liste principale): </h3>
                     <ul>
                     <?php 
                     foreach ($cours['atgp_group'] as $mainCours) {
                        // 
                     ?>
                        <li><strong><?php echo $mainCours->name;?></strong>
                        <?php if ($mainCours->name == "perf") {echo "<br>".$mainCours->description;}?>
                        </li>
                     <?php
                     } 
                     ?>    
                     </ul>
                  </div>
                  <div class="wp-block-column" id="atgp_groupe_voeux">
                     <h3>Au cas où un groupe soit complet, vos voeux dans l'ordre de préférence:</h3>       
                     <ol>
                     <?php 
                     $voeuxList=$cours['atgp_group_voeux'];
                        foreach ($voeuxList as $voeux) {
                        ?>
                           <li><?php echo $voeux->name;?></li>
                        <?php
                        } 
                        ?>
                     </ol>
                  </div>
               </section>

               <?php //var_dump($cout['atgp_reductions']);?>
               <h2>Réduction(s) : </h2>
               <section id="atgp_type_reduction">
               <?php 
               if ($cout['atgp_reductions']['atgp_type_reduction']) {
                  foreach ($cout['atgp_reductions']['atgp_type_reduction'] as $reduction) {
                     ?>
                     <div>
                        <span id="<?php echo $reduction['value'];?>">
                        <?php 
                        echo $reduction['label'];
                        ?>
                        </span>
                        <?php
                        if ($reduction['value'] == "atgp-reduc-1") {
                           $featured_members = $cout['atgp_reductions']['atgp_reduction_autres_membres'];
                           if( $featured_members ): ?>
                              <p>Autres membres de la famille : </p>
                              <ul>
                              <?php foreach( $featured_members as $post ):                
                                 // Setup this post for WP functions (variable must be named $post).
                                 setup_postdata($post); ?>
                                 <li>
                                    <?php the_title(); ?>
                                 </li>
                              <?php endforeach; ?>
                              </ul>
                              <?php 
                              // Reset the global post object so that the rest of the page works correctly.
                              wp_reset_postdata();
                           endif;
                        }                     
                        ?>
                     </div>
                  <?php
                  }  
               }              
               ?>                
               </section>              
                        
               <h2>Montant de l'adhésion</h2>
               <section id="atgp_paiement">
                  <div class="wp-block-columns" id="atgp_paiement">
                     <div class="wp-block-column" id="atgp_paiement_echeancier">
                        <h3>Mode de paiement  <?php //echo $cout['atgp_paiement']['paiement_en_3_fois'];?></h3>
                        <p><em>Chèque(s) à remplir à l'ordre de Autan Grimper</em></p>   
                        <ul>
                           <li>Montant chéque 1, numéro <?php echo $cout['atgp_paiement']['atgp_echeancier_1_numero'];?> : <?php echo $cout['atgp_paiement']['atgp_echeancier_1_montant'];?> €</li>
                           <?php 
                           if ( $cout['atgp_paiement']['paiement_en_3_fois'] == "oui") {
                              ?>
                              <li>Montant chéque 2, numéro <?php echo $cout['atgp_paiement']['atgp_echeancier_2_numero'];?> : <?php echo $cout['atgp_paiement']['atgp_echeancier_2_montant'];?> €</li>
                              <li>Montant chéque 3, numéro <?php echo $cout['atgp_paiement']['atgp_echeancier_3_numero'];?> : <?php echo $cout['atgp_paiement']['atgp_echeancier_3_montant'];?> €</li>
                           <?php
                           }
                           ?>
                        </ul>
                     </div>
                     <div class="wp-block-column" id="atgp_total">
                        <ul>
                           <h3>Récapitulatif</h3>
                        <?php 
                        $i=0;
                        foreach ($cours['atgp_group'] as $mainCours) {
                           $cout_cours=get_field('atgp_cours_cout', $mainCours);  
                           // Calcul du cout
                           if ($i>0) {
                              $cout_cours=$cout_cours-60;
                           }                         
                           ?>
                           <li>
                                 <span><?php echo $mainCours->name." : ";?></span>
                                 <span><?php echo $cout_cours." €";?></span>
                           </li>
                           <?php                              
                              $cout_cours_total=$cout_cours_total+$cout_cours;
                              $i++;
                           } 
                           ?>
                        <?php 
                        $cout_reduction_total=0;
                        if ($cout['atgp_reductions']['atgp_type_reduction']) {
                           foreach ($cout['atgp_reductions']['atgp_type_reduction'] as $coutReduction) {
                              /**
                               * Get related info from ACF options Réduc
                               */
                              // Check rows exists.
                              if( have_rows('atgp_reduc', 'option') ){
                                 // Loop through rows.
                                 while( have_rows('atgp_reduc', 'option') ) : the_row();
                                    // Load sub field value.
                                    if ($coutReduction['value'] == get_sub_field('atgp_reduc_id')) {
                                       $atgp_reduc_id = get_sub_field('atgp_reduc_id');
                                       $atgp_reduc_label = get_sub_field('atgp_reduc_label');
                                       $atgp_reduc_type = get_sub_field('atgp_reduc_type');
                                       $atgp_reduc_montant = get_sub_field('atgp_reduc_montant');
                                    }
                                 endwhile;
                              }

                              if ($atgp_reduc_type == "fixe") {
                                 $type_reduction="€";
                                 $reduc_fixe=$atgp_reduc_montant;
                              } else {
                                 $type_reduction="%";
                                 $reduc_pourcentage=$atgp_reduc_montant/100;
                              }
                              ?>
                              <li class="atgp_reduc">
                                    <span><?php echo $atgp_reduc_label." : ";?></span>
                                    <span><?php echo "- ".$atgp_reduc_montant." ".$type_reduction;?></span>
                              </li>
                              <?php                              
                           }
                        }
                           $atgp_total=$cout_cours_total-($cout_cours_total*$reduc_pourcentage)-$reduc_fixe;
                           // if ($type_reduction=="%") {
                           //    $atgp_total=$atgp_total-($atgp_total*($reduc_pourcentage/100));
                           //    }
                           ?>
                           <!-- <li> -->
                              <?php //echo $cout_cours_total."-(".$cout_cours_total."*".$reduc_pourcentage.")-".$reduc_fixe;?>
                           <!-- </li> -->
                           <li>
                              <span>Coût total : </span>
                              <span><?php echo $atgp_total; ?> €</span>
                           </li>
                        </ul>
                        
                     </div>
                  </div> 
               </section>
               <?php
				   } // end password_required
				   ?>
            </section>
            
         </article>
   </main><!-- #main -->
</div>

<?php
endwhile; 
get_footer();
