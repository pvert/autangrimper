<?php

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );    
require_once( $parse_uri[0] . 'wp-load.php' );

$post_id=$_GET["postID"];
     
/************************************************************************************************************************************** */
?>
<style>
* {
    margin:0;
    padding:0;
}

h1, h2 {
    margin:15px 0;
    text-align:center;
}

h3 {
    margin:10px 0 5px;
}

p {
    margin:10px 0;
}

table {
    /* border:1px solid #000; */
    width:1000px;
}
td {
    /* border:1px solid #000; */
    padding:10px;
}

ul li,
ol li {
    margin-bottom: 10px;
    font-size: 12px;
}

#atgp_total li {
}

.mediumtext {
    font-size:16px;
}

.bigtext {
    font-size:18px;
}
.etatCivil {
    /* background:pink; */
}

.w100 {
    text-align:left; 
    width:150px;
}

.w150 {
    text-align:left; 
    width:150px;
}

.w300 {
    text-align:left; 
    width:300px;
}

.w400 {
    text-align:left; 
    width:350px;
}

.border {
    border:1px solid #000;
}

.borderb {
    border-bottom:1px solid #000;
}

.gray {
    background:#F0F0F0;
}
.gray2 {
    background:#DDD;
}
</style>
<page orientation="portrait" format="A4" style="font-size: 12px" backtop="7mm" backbottom="7mm" backleft="7mm" backright="7mm">
    <page_header> 
        <p>DOSSIER DE PRE-INSCRIPTION AUTAN GRIMPER</p>         
    </page_header> 
    <?php
    $etat_civil=  get_field('atgp_group_etat_civil', $post_id);
    $urgence=  get_field('atgp_group_urgence', $post_id);
    $adhesion=  get_field('atgp_group_adhesion', $post_id);
    $cours=  get_field('atgp_group_cours', $post_id);
    $cout=  get_field('atgp_group_cout', $post_id);
    ?>
    <h1><?php echo $etat_civil['atgp_nom']; ?> , <?php echo $etat_civil['atgp_prenom']; ?></h1>
    <h2>Groupe(s) : 
        <?php 
        $i=0;
        foreach ($cours['atgp_group'] as $mainCours) {
            if($i>0) {
                echo " - ";
            }
            echo $mainCours->slug;
            $i++;
        } 
        ?> 
    </h2>
    <hr>
    <table class="etatCivil" cellpadding="0" cellspacing="0" width="700">
        <tr>
            <td valign="top" class="w300">
                <p>Date de naissance : <strong class="bigtext"><?php echo $etat_civil['atgp_date_de_naissance']; ?></strong><br>
                <small><?php echo $etat_civil['atgp_lieu_de_naissance']; ?></small>
                </p>
                <p>Sexe : <?php echo $etat_civil['atgp_sexe']; ?></p>
                <p>Adresse :<br><?php echo $etat_civil['atgp_adresse']; ?>, <?php echo $etat_civil['atgp_code_postal']; ?> <?php echo $etat_civil['atgp_ville']; ?></p>
                <p>Tel mobile : <strong class="bigtext"><?php echo $etat_civil['atgp_tel']; ?></strong></p>
                <p>Tel fixe : <?php echo $etat_civil['atgp_tel_fixe']; ?></p>
                <p>Courriel : <strong class="bigtext"><?php echo $etat_civil['atgp_courriel']; ?></strong></p>
                <hr>
                <h3>Contact en cas d'urgence</h3>
                <p class="mediumtext"><?php echo $urgence['atgp_nom_urgence']; ?> <?php echo $urgence['atgp_prenom_urgence']; ?></p>
                <p>Tel 1 : <?php echo $urgence['atgp_tel_urgence']; ?></p>
                <p>Tel 2 : <?php echo $urgence['atgp_fixe_urgence']; ?></p>
                <hr>
                <p>Groupe(s) demandé(s): </p>
                <ul>
                    <?php 
                    foreach ($cours['atgp_group'] as $mainCours) {                        
                        echo "<li class=\"group\">".$mainCours->name."</li>";
                    } 
                    ?> 
                </ul>
                <p>Autre(s) voeux :</p>       
                <ol>
                <?php 
                $voeuxList= array();
                $voeuxList=$cours['atgp_group_voeux'];               
                if (!empty($voeuxList)) {
                    foreach ($voeuxList as $voeux) {
                    ?>
                        <li><?php echo $voeux->name;?></li>
                    <?php
                    } 
                }
                ?>
                </ol>
            </td>
            <td valign="top" class="gray w300">
                <p>Type d'adhésion : <strong><?php echo $adhesion['atgp_type_dadhesion']; ?></strong></p>
                <?php 
                if ($adhesion['atgp_type_dadhesion'] = 2) {
                ?>
                <p>Numéro de licence : <strong><?php echo $adhesion['atgp_licence']; ?></strong></p>
                <?php
                }
                ?>
                <p>Certificat médical ou Questionnaire santé établit le : <strong><?php echo $adhesion['atgp_group_adhesion_group_certificat']['atgp_group_adhesion_certificat_date'];?></strong></p>
                <p>Médecin : <?php echo $adhesion['atgp_group_adhesion_group_certificat']['atgp_group_adhesion_certificat_medecin'];?></p>
                
                
                <h3>Montant de l'adhésion</h3>
                <table id="atgp_total" class="gray2 w300">    
                    <tr>
                        <td colspan="2" class="borderb">Groupe(s)</td>
                    </tr>                    
                    <?php 
                    $i=0;
                    $cout_cours_total=0;
                    foreach ($cours['atgp_group'] as $mainCours) {
                    $cout_cours=get_field('atgp_cours_cout', $mainCours);  
                    // Calcul du cout
                    if ($i>0) {
                        $cout_cours=$cout_cours-60;
                    }                         
                    ?>      
                    <tr id="atgp_total_group">              
                        <td class="w100"><span><?php echo $mainCours->name." : ";?></span></td>
                        <td width="30px"><span><?php echo $cout_cours." €";?></span></td>
                    </tr>
                    <?php                              
                        $cout_cours_total=$cout_cours_total+$cout_cours;
                        $i++;
                    } 
                    ?>
                    <?php
                    if ($cout['atgp_reductions']['atgp_type_reduction']) {
                    ?>
                    <tr>
                        <td colspan="2" class="borderb">Réduction(s)</td>
                    </tr>   
                    <?php 
                    $cout_reduction_total=0;
                    
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

                            // if ($atgp_reduc_type == "fixe") {
                            // $type_reduction="€";
                            // $cout_reduction_total=$cout_reduction_total+$atgp_reduc_montant;
                            // } else {
                            // $type_reduction="%";
                            // $reduc_pourcentage=$atgp_reduc_montant;
                            // }
                            $reduc_fixe=0;
                            $reduc_pourcentage=0;
                            if ($atgp_reduc_type == "fixe") {
                                $type_reduction="€";
                                $reduc_fixe=$atgp_reduc_montant;
                             } else {
                                $type_reduction="%";
                                $reduc_pourcentage=$atgp_reduc_montant/100;
                             }
                        ?>
                        <tr id="atgp_total_reduc">
                            <td><?php echo $atgp_reduc_label." : ";?>
                            <?php
                            if ($coutReduction['value'] == "atgp-reduc-1") {
                                $featured_members = $cout['atgp_reductions']['atgp_reduction_autres_membres'];
                                if( $featured_members ): ?>
                                <br>Membres de la famille : <br>
                                <?php foreach( $featured_members as $post ):                
                                    // Setup this post for WP functions (variable must be named $post).
                                    setup_postdata($post); ?>
                                    <span><?php the_title(); ?><br></span>
                                <?php endforeach; ?>
                                <?php 
                                // Reset the global post object so that the rest of the page works correctly.
                                wp_reset_postdata();
                                endif;
                            }                     
                            ?>
                        
                            </td>
                            <td><?php echo "- ".$atgp_reduc_montant." ".$type_reduction;?></td>
                        </tr>
                        <?php                              
                        }
                    }
                    $atgp_total=$cout_cours_total-($cout_cours_total*$reduc_pourcentage)-$reduc_fixe;
                    // if ($type_reduction=="%") {
                    //     $atgp_total=$atgp_total-($atgp_total*($reduc_pourcentage/100));
                    //     }
                    ?>
                    <tr>
                        <td colspan="2" class="borderb"></td>
                    </tr> 
                    <tr id="atgp_total_final">
                        <td>TOTAL </td>
                        <td class="mediumtext"><?php echo $atgp_total; ?> €</td>
                    </tr>
                </table>

                <h4>Mode de paiement:</h4>
                <ul>
                    <li>Chèque 1, numéro <?php echo $cout['atgp_paiement']['atgp_echeancier_1_numero'];?> : <?php echo $cout['atgp_paiement']['atgp_echeancier_1_montant'];?> €</li>
                <?php 
                if ( $cout['atgp_paiement']['paiement_en_3_fois'] == "oui") {
                    ?>
                    <li>Chèque 2, numéro <?php echo $cout['atgp_paiement']['atgp_echeancier_2_numero'];?> : <?php echo $cout['atgp_paiement']['atgp_echeancier_2_montant'];?> €</li>
                    <li>Chèque 3, numéro <?php echo $cout['atgp_paiement']['atgp_echeancier_3_numero'];?> : <?php echo $cout['atgp_paiement']['atgp_echeancier_3_montant'];?> €</li>
                <?php
                }
                ?>  
                </ul>                            
                <p><em>Chèque à remplir à l'ordre de Autan Grimper</em></p> 
                <p><?php $cout['atgp_paiement']; ?></p>
                
            </td>
        </tr>
    </table>
    <h3>Autorisations</h3>
    <p><strong>Pour les mineurs :</strong><br>
    Je soussigné(e) Monsieur, Madame, Mademoiselle : ……………………………………………………………………… représentant légal, autorise mon  enfant …………………………………………………………… à participer aux activités proposées par le club et donne aux responsables du club l’autorisation de prendre toute initiative en cas d’accident.
    <br>Les membres de l’encadrement du club d’escalade « Autan Grimper »  ne peuvent pas  être tenus pour responsables en cas d'accident en dehors de la salle d’escalade,  en dehors des heures d'activités et en dehors de leur présence.
    </p>
    <p>
    Je soussigné(e) : ……………………………………………………………… autorise tout dirigeant ou membre d’Autan Grimper  à me prendre ou à prendre mon enfant mineur ……………………………………………………………… en photos dans le cadre des activités du club. J’accepte l’utilisation de mon image ou de l’image de mon enfant mineur pour la diffusion sur le site web ou les documents de communication d’Autan Grimper.
    </p>
    <table>
        <tr>
            <td style="text-align:left; width:300px">Date :</td>
            <td>Signature :</td>
        </tr>
    </table>
    <page_footer> 
    <p><small>Version : <?php echo date('ymj-H-i-s');?></small><br>
    Date de l'inscription en ligne :<?php echo get_the_date( 'j/m/y H:i:s', $post_id ); ?><br>
    <small>AUTAN GRIMPER, Salle Liv Sansoz 177 Chemin de la forêt 31660 BESSIERES, Renseignements : 06 83 30 89 87, http://www.autangrimper.fr</small>
    </p>    
    
    </page_footer>
</page>
