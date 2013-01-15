var abv_min = 2;
var abv_max = 15;
var abv_inf = 4;
var abv_sup = 8;

var ibu_min = 20;
var ibu_max = 120;
var ibu_inf = 40;
var ibu_sup = 70;

function url_range( field, val_min, val_max ) {
  
	if( document.getElementById(field+'-min').value != '' && document.getElementById(field+'-min').value > val_min ) {
	  url = url + "&"+field+"_min=" + document.getElementById(field+'-min').value;
	}
	if( document.getElementById(field+'-max').value != '' && document.getElementById(field+'-max').value < val_max ) {
	  url = url + "&"+field+"_max=" + document.getElementById(field+'-max').value;
	}
} // url_range

function url_add( field ) {
  if( document.getElementById(field).value != '' ) {
    url = url + "&" + field + "=" + document.getElementById(field).value;
  }
}
function get_reload_url()  {
	url = table_url + '?';

	// category
	if( document.getElementById('ale-check').checked || document.getElementById('lager-check').checked || document.getElementById('lambic-check').checked ) {
	    url = url + '&ale=' + document.getElementById('ale-check').checked + '&lager=' + document.getElementById('lager-check').checked + '&lambic=' + document.getElementById('lambic-check').checked;
	 }
	// type
	url_add( 'type_id' );
	// brewery
	url_add( 'brewery_id' );
	if( document.getElementById('brewery_id').value == '' )
	  url_add( 'brewery' );
	// country
	url_add( 'country_id' );
	
	url_range( "abv", abv_min, abv_max );
	url_range( "ibu", ibu_min, ibu_max );

	// search
	url_add( 'search' );
	
	return url;
} // get_reload_url

$('country').on({
  select: function () {
    reload_div(get_reload_url(), 'results');
  }
});

jQuery(function(){
  
    jQuery('select.turn-to-ac').selectToAutocomplete();
  
    $('#menu ul').menu({ position: { my: "left top", at: "right-5 top+25" } });
  
    $("#search-input").keyup(function(event){
        if(event.keyCode == 13){
            $("#search-word-button").click();
        }
    });

    // autocomplete brewery
    jQuery(function(){
        var lib_url = 'http://localhost/birrols_sym/web/app_dev.php/es/';
        var birrolpath = 'http://localhost/birrols_sym/web/app_dev.php/es/';
        jQuery('#brewery').autocomplete({
            source: lib_url + 'search_brewery.php?birrolpath=' + birrolpath,
            select: function(event, ui) {
                $(this).val(ui.item.label);
                $('#brewery_id').val(ui.item.id);
            },
            change: function(event, ui) {
                if( !ui.item ) {
                    $('#brewery_id').val('');
                    reload_div(get_reload_url(), 'results');
                }
            }
        });
    });

  // sliders
    function slide_set_text( field, val_inf, val_sup, val_min, val_max, unit ) {
        if( val_inf == val_min && val_sup == val_max )
          $( field ).val( " - " );
        else if( val_inf == val_min )
          $( field ).val( "< " + val_sup + unit );
        else if( val_sup == val_max )
          $( field ).val( val_inf + unit + " <"  );
        else
          $( field ).val( val_inf + unit + " - " + val_sup + unit );
    } // slide_set_text
  
    function slider( field, val_inf, val_sup, val_min, val_max, unit ) {
        var field_id = "#birrols_beerbundle_beerssearchtype_"+field;
        $(field_id).slider({
            range: true,
            min: val_min,
            max: val_max,
            values: [ val_inf, val_sup ],
            slide: function( event, ui ) {
                slide_set_text( field_id, ui.values[0], ui.values[1], val_min, val_max, unit );
                $( "#"+field+"-min" ).val( ui.values[ 0 ]);
                $( "#"+field+"-max" ).val( ui.values[ 1 ]);
            },
            stop: function( event, ui ) {
                 reload_div(get_reload_url(), 'results');
            }
        });
        slide_set_text( field_id, $(field_id).slider( "values", 0 ), 
            $(field_id).slider( "values", 1 ), 
            val_min, val_max, unit );
    } // slider
  
    slider( "abv", abv_inf, abv_sup, abv_min, abv_max, "%" );
    slider( "ibu", ibu_inf, ibu_sup, ibu_min, ibu_max, "" );
  
}); // end jQuery

function get_query(){
    var query = window.location.href;
    
    var params = [];
    var aux = query.split("&");
    for (var i=0; i < aux.length; i++)
    { 
        aux2 = aux[i].split("=");
        params[aux2[0]] = aux2[1];
    }
    
    return params;
    
}