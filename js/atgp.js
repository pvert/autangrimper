/**
* Autocomplete form 
*/

jQuery(document).ready(function(){

    // LASTNAME
    jQuery('#acf-field_60c359e1ee3a0-field_60bfea45fedb9').on( "blur", function() {
        jQuery('#acf-field_60c359e1ee3a0-field_60bfea45fedb9').val(function( i, val ) {
            return val.toUpperCase();
        });
    });
    // FIRSTNAME
    jQuery('#acf-field_60c359e1ee3a0-field_60bfea89fedba').on( "blur", function() {
        jQuery('#acf-field_60c359e1ee3a0-field_60bfea89fedba').val(function( i, val ) {
            return val.toUpperCase();
        });
    });
    // LASTNAME contact
    jQuery('#acf-field_60c35a75ff823-field_60c22f3097aad').on( "blur", function() {
        jQuery('#acf-field_60c35a75ff823-field_60c22f3097aad').val(function( i, val ) {
            return val.toUpperCase();
        });
    });
    // FIRSTNAME contact
    jQuery('#acf-field_60c35a75ff823-field_60c22f4c97aae').on( "blur", function() {
        jQuery('#acf-field_60c35a75ff823-field_60c22f4c97aae').val(function( i, val ) {
            return val.toUpperCase();
        });
    });
    // disable total input, and submit
    jQuery('#acf-field_60c35ab2e3911-field_60c005e597a91').prop('disabled', true);
    jQuery('.acf-form-submit input[type="submit"]').prop('disabled', true);
    var total=0;
    var groupID;
    // GET groupe checkbox 
        jQuery( '#atgp-display-total button' ).on( "click", function() {

            /************************************************************************************************* */
            var groupSelected = [];
            var groupID;
            jQuery( ".acf-field-60c001b397a8a .acf-taxonomy-field input:checked" ).each(function() 
            {
            // add $(this).val() to your array
                groupID = jQuery(this).val();
                // console.log(groupID);
                /* LOCAL */
                
                // switch(groupID) {
                //     case "11":
                //         var groupPrice = 165;
                //         break;
                //     case "12":
                //         var groupPrice = 80;
                //         break;
                //     case "10":
                //         var groupPrice = 235;
                //         break;
                //     case "9":
                //         var groupPrice = 195;
                //         break;
                //     case "8":
                //         var groupPrice = 195;
                //         break;
                //     case "7":
                //         var groupPrice = 195;
                //         break;
                //     case "6":
                //         var groupPrice = 195;
                //         break;
                //     case "5":
                //         var groupPrice = 195;
                //         break;
                //     case "4":
                //         var groupPrice = 80;
                //         break;
                //     case "3":
                //         var groupPrice = 195;
                //         break;
                //     case "2":
                //         var groupPrice = 195;
                //         break;            
                //     default:
                //         var groupPrice = 0;
                //    }
                
                /* ONLINE */
                switch(groupID) { 
                    case "3":
                        var groupPrice = 185;
                        break;
                    case "18":
                        var groupPrice = 90;
                        break;
                    case "6":
                        var groupPrice = 250;
                        break;
                    case "7":
                        var groupPrice = 230;
                        break;
                    case "13":
                        var groupPrice = 230;
                        break;
                    case "9":
                        var groupPrice = 230;
                        break;
                    case "11":
                        var groupPrice = 230;
                        break;
                    case "15":
                        var groupPrice = 230;
                        break;
                    case "16":
                        var groupPrice = 230;
                        break;
                    case "17":
                        var groupPrice = 230;
                        break;
                    case "10":
                        var groupPrice = 230;
                        break; 
                    case "14":
                        var groupPrice = 230;
                        break;     
                    case "12":
                        var groupPrice = 230;
                        break;    
                    case "19":
                        var groupPrice = 230;
                        break;   
                    default:
                        var groupPrice = 0;
                   }
                
                groupSelected.push(groupPrice);
            });
            jQuery( ".acf-field-60c004ca97a90 input:checked" ).each(function() 
            {
            // add $(this).val() to your array
                atgpReduc = jQuery(this).val();
                // console.log(atgpReduc);
                switch(atgpReduc) {
                    case "atgp-reduc-1":
                        var atgpReducPrice = 30;
                        break;
                    case "atgp-reduc-2":
                        var atgpReducPrice = 10;
                        break;          
                    default:
                        var atgpReducPrice = 0;
                   } 

                groupSelected.push(atgpReducPrice);
            });
            // console.log(groupSelected.length);
            jQuery('#atgp-display-total #groupPriceArray span').remove();
            jQuery('#atgp-display-total #TOTAL span').remove();
           
            var totalCours=0;
            var reduc=0;
            var reduc1=0;
            var typeReduc = "€";
            var reduc2=0;
            var atgp_reduc_montant=0;
            groupSelected.forEach(function(item, index){

                switch(item) {
                    case 30:
                        reduc1 = -30;
                        reduc=reduc1;
                        break;
                    case 10:
                        reduc2 = 10/100;
                        reduc=10;
                        typeReduc="%";
                        break;          
                    default:
                        console.log("switch Index" + index);
                        // si 2 cours, licence déduite sur 2nd cours
                        if (index == 1) {
                            totalCours = totalCours + item - 67.5;
                            reduc=item - 67.5;
                        } else {
                            totalCours = totalCours + item;
                            reduc=item;
                        }
                        
                   } 

                jQuery('#atgp-display-total #groupPriceArray').append( "<span id=\""+ index +"\"> > "+ reduc + ""+ typeReduc +" </span>");
            });
            // console.log(totalCours + "-(" + totalCours+ "*" + reduc2 +")+"+reduc1+ "");
            total=totalCours-(totalCours*reduc2)+reduc1;
            jQuery('#atgp-display-total #TOTAL').append("<span>" + total + " €</span>");
            jQuery('#acf-field_60c35ab2e3911-field_60c005e597a91').val(total);
      });

      /**
       * PAIEMENT
       */
      var cheque1=0;
      var cheque2=0;
      var cheque3=0;

    // VERIF PASS'SPORT
    jQuery('#passsport input').click(function() {
        if (jQuery('#passsport input').is(':checked')) {
            console.log("PASS SPORT CHECKED");
            //force paiement en 3 fois
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d1584302').prop('checked', true);
            // change acf switch button to on
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d1584302+div.acf-switch').addClass("-on");
            // remove hidden class on next acf input (cheque 2 / 3)
            jQuery('[data-name=atgp_echeancier_2_montant]').removeClass("acf-hidden");
            jQuery('[data-name=atgp_echeancier_2_montant]').removeAttr("hidden");
            jQuery('[data-name=atgp_echeancier_2_numero]').removeClass("acf-hidden");
            jQuery('[data-name=atgp_echeancier_2_numero]').removeAttr("hidden");
            jQuery('[data-name=atgp_echeancier_3_montant]').removeClass("acf-hidden");
            jQuery('[data-name=atgp_echeancier_3_montant]').removeAttr("hidden");
            jQuery('[data-name=atgp_echeancier_3_numero]').removeClass("acf-hidden");
            jQuery('[data-name=atgp_echeancier_3_numero]').removeAttr("hidden");
            // disable cheque 2 et 3
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303').prop('disabled', true);
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').prop('disabled', true);
        } else {
            console.log("PASS SPORT NOT CHECKED");
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303').prop('disabled', false);
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').prop('disabled', false);
        }
    });

      jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33c2a84300, #acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303, #acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').focusout(function() {
        var cheque1 = parseFloat(jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33c2a84300').val());
        var cheque2 = parseFloat(jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303').val());
        var cheque3 = parseFloat(jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').val());
        console.log("cheque1:" + cheque1 +" ; cheque2: "+ cheque2 +" ; cheque3: "+ cheque3);
        jQuery('#atgp-display-total #alert p').remove();
        totalCheque = cheque1;
        console.log("groupID:"+ groupID);
        // si pas dans le groupe (enfant libre avec pass sport), cheque1 doit être supérieur à 80
        if ( (cheque1 < 80) && (jQuery('[data-taxonomy=atgp-ctx-group] [value=18]').is(':not(:checked)')) && (jQuery('#passsport input').is(':not(:checked)')) ) {
            jQuery('#atgp-display-total #alert').append("<p>Le chèque 1 doit être d'un montant minimal de 80€ ("+total+ ")</p>");
        }
        // VERIF PASS'SPORT
        if (jQuery('#passsport input').is(':checked')) {

            // set value 
            var cheque2 = total-cheque1-50;
            if (cheque2 < 0) {
                cheque2 = 0;
            }
            var cheque3 = 50;
            console.log("cheque 2 ="+ cheque2 +" ; cheque 3 ="+ cheque3 );
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303').val(cheque2);
            jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').val(cheque3);
            
        } else {
            console.log("PASS SPORT NOT CHECKED");
            if ( (cheque2 < 80) && (jQuery('[data-taxonomy=atgp-ctx-group] [value=18]').is(':not(:checked)')) && (jQuery('#passsport input').is(':not(:checked)')) ) {
                jQuery('#atgp-display-total #alert').append("<p>Le chèque 2 doit être d'un montant minimal de 80€ ("+total+ ")</p>");
            }
        }

        if (cheque2) {
            
            totalCheque = cheque1+cheque2;
        }
        if ((cheque2) && (cheque3)){
            totalCheque = cheque1+cheque2+cheque3;
        }
        if ((cheque1) && (cheque3) && !cheque2){
            totalCheque = cheque1+cheque3;
        }
        console.log(totalCheque);
        if (totalCheque != total){
            jQuery('#atgp-display-total #alert').append("<p>Le montant des chèques ("+totalCheque+") n'est pas égal au montant total ("+total+ ")</p>");
            jQuery('.acf-form-submit input[type="submit"]').prop('disabled', true);
        } else {
            if(totalCheque != 0) {
            jQuery('.acf-form-submit input[type="submit"]').prop('disabled', false);
            }
        }
      });
});


