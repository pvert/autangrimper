/**
* Autocomplete form 
*/

jQuery(document).ready(function(){
    console.log('HELLO');

    // init 
    jQuery('#acf-field_60c359e1ee3a0-field_60bfeadffedbc').focusout(function() {
        // alert( "Handler for .focus() called." );      
        // var datnat = jQuery(this).val();
        var datnat = jQuery('#acf-field_60c359e1ee3a0-field_60bfeadffedbc').val();
        // jQuery('#atgp-display-total').text(jQuery(this).val());
        console.log(datnat);
        
    });

    // GET groupe checkbox 
       
    //   jQuery( '.acf-taxonomy-field input[type=checkbox]' ).on( "click", countChecked );
    // jQuery( '.acf-taxonomy-field input[type=checkbox]' ).on( "click", function() {
        jQuery( '#atgp-display-total > button' ).on( "click", function() {
            var groupSelected = [];
            var groupID;
        // var groupID = jQuery( ".acf-taxonomy-field input:checked" ).val();
            jQuery( ".acf-field-60c001b397a8a .acf-taxonomy-field input:checked" ).each(function() 
            {
            // add $(this).val() to your array
                groupID = jQuery(this).val();
                console.log(groupID);
                switch(groupID) {
                    case "11":
                        var groupPrice = 165;
                        break;
                    case "12":
                        var groupPrice = 80;
                        break;
                    case "10":
                        var groupPrice = 235;
                        break;
                    case "9":
                        var groupPrice = 195;
                        break;
                    case "8":
                        var groupPrice = 195;
                        break;
                    case "7":
                        var groupPrice = 195;
                        break;
                    case "6":
                        var groupPrice = 195;
                        break;
                    case "5":
                        var groupPrice = 195;
                        break;
                    case "4":
                        var groupPrice = 80;
                        break;
                    case "3":
                        var groupPrice = 195;
                        break;
                    case "2":
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
                console.log(atgpReduc);
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
            console.log(groupSelected.length);
            jQuery('#atgp-display-total #groupPriceArray span').remove();
            groupSelected.forEach(function(item, index){
                console.log(item, index);                
                jQuery('#atgp-display-total #groupPriceArray').append( "<span id=\""+ index +"\">"+ item + "</span>");
            });
        // jQuery('#atgp-display-total').append( "<p>"+ groupPrice + "</p>" );
      });

// groupe adulte :  [data-id="11"]
// enf-L :          [data-id="12"]
// Perf :            [data-id="10"]
// enf :          [data-id="7"] 8 5 2 3 6 10 4 9


    // var datnat = jQuery('#acf-field_60c359e1ee3a0-field_60bfeadffedbc').val();
    // console.log(datnat);
    // if (jQuery('.acf-taxonomy-field > input[type="checkbox"]').is(":checked"))
    // {
    //     console.log("check");
    // }

});

/**
 * ACF JS API
 */

// acf.add_action('ready', function( $el ){
	
// 	// $el will be equivalent to $('body')
	
	
// 	// find a specific field
// 	var $field = $('#acf-field_60c359e1ee3a0-field_60bfeadffedbc');

//     field.$input().focus();
	
	
// 	// do something to $field
	
// });
