( function( $ ) {

    var column_selectors = [
        '.gf-column-half',
        '.gf-column-quarter',
        '.gf-column-third',
        '.gf-column-single'
    ];

    var selectors = column_selectors.join( ', ' );

    if ( $( selectors ).length ) {

        for ( s = 0; s < column_selectors.length; s++ ) {

            $( column_selectors[s] ).each(

                function( index ) {
        
                    $( this ).closest( '.gform_fields' ).addClass( 'gf-columns-wrapper' );
        
                    gf_wsu_wrap_column( column_selectors[s], $( this ) );
                    
                }
            );

        }

    } // End if


    function gf_wsu_wrap_column( column_selector, section ) {

        section.hide();

        var selectors = column_selectors.join( ', ' );

        var fields = section.nextUntil( selectors );

        column_selector = column_selector.replace( '.', '');

        fields.wrapAll( "<ul class='" + column_selector + "' />");

    }
    
} )( jQuery );
