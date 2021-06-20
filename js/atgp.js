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
    // GET groupe checkbox 
        jQuery( '#atgp-display-total button' ).on( "click", function() {

            /************************************************************************************************* */
            var groupSelected = [];
            var groupID;
            jQuery( ".acf-field-60c001b397a8a .acf-taxonomy-field input:checked" ).each(function() 
            {
            // add $(this).val() to your array
                groupID = jQuery(this).val();
                console.log(groupID);
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
                    case "51":
                        var groupPrice = 165;
                        break;
                    case "52":
                        var groupPrice = 80;
                        break;
                    case "59":
                        var groupPrice = 235;
                        break;
                    case "53":
                        var groupPrice = 195;
                        break;
                    case "54":
                        var groupPrice = 195;
                        break;
                    case "55":
                        var groupPrice = 195;
                        break;
                    case "56":
                        var groupPrice = 195;
                        break;
                    case "57":
                        var groupPrice = 195;
                        break;
                    case "58":
                        var groupPrice = 80;
                        break;
                    case "60":
                        var groupPrice = 195;
                        break;
                    case "61":
                        var groupPrice = 195;
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
                        if (index == 1) {
                            totalCours = totalCours + item - 60;
                            reduc=item - 60;
                        } else {
                            totalCours = totalCours + item;
                            reduc=item;
                        }
                        
                   } 

                jQuery('#atgp-display-total #groupPriceArray').append( "<span id=\""+ index +"\"> > "+ reduc + ""+ typeReduc +" </span>");
            });
            console.log(totalCours + "-(" + totalCours+ "*" + reduc2 +")+"+reduc1+ "");
            total=totalCours-(totalCours*reduc2)+reduc1;
            jQuery('#atgp-display-total #TOTAL').append("<span>" + total + " €</span>");
            jQuery('#acf-field_60c35ab2e3911-field_60c005e597a91').val(total);
      });

      var cheque1=0;
      var cheque2=0;
      var cheque3=0;

      jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33c2a84300, #acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303, #acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').focusout(function() {
        var cheque1 = parseInt(jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33c2a84300').val());
        var cheque2 = parseInt(jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d3184303').val());
        var cheque3 = parseInt(jQuery('#acf-field_60c35ab2e3911-field_60c32a5eda844-field_60c33d9584305').val());
        jQuery('#atgp-display-total #alert span').remove();
        totalCheque = cheque1;
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
        if (totalCheque != total) {
            jQuery('#atgp-display-total #alert').append("<span>Le montant des chèques n'est pas égal au montant total ("+total+ ")</span>");
            jQuery('.acf-form-submit input[type="submit"]').prop('disabled', true);
        } else {
            if(totalCheque != 0) {
            jQuery('.acf-form-submit input[type="submit"]').prop('disabled', false);
            }
        }
      });


});


