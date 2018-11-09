( function ( $ ) {
	
	var wsuwp_modules_taxonomy = {

		result_wrapper: $('.wsuwp-taxonomy-search-results'),

		results_limit:10,

		search_after:0,

		init:function() {

			wsuwp_modules_taxonomy.bind_events();

		}, // End init

		bind_events:function() {

			$( '.wsuwp-taxonomy-search-az-index').on(
				'click',
				'.wsuwp-term-set:not(.wsuwp-empty-term)',
				function(){
					wsuwp_modules_taxonomy.update_resluts( 
						$(this).data('alpha'),
						'alpha'
					);
				}
			);

			$( '.wsuwp-taxonomy-search-field input[type="text"]').on(
				'keyup',
				function(){
					wsuwp_modules_taxonomy.update_resluts( 
						$(this).val(),
						'search'
					);
				}
			);

		}, // End bind_events

		update_resluts:function( query, type ) {

			var results = [];

			switch ( type ) {

				case 'alpha':
					results = wsuwp_modules_taxonomy.get_alpha_resluts( query );
					break;
				case 'search':
					results = wsuwp_modules_taxonomy.get_search_results( query );
					break;

			}; // End switch

			wsuwp_modules_taxonomy.result_wrapper.empty();

			if ( results.length ) {

				var results_length = results.length;

				for ( var r = 0; r < results_length; r++ ) {

					if ( r > wsuwp_modules_taxonomy.results_limit && 'search' === query ) {

						break;

					} // End if

					var r_html = '<div class="results-item"><a href="' + results[r].link + '">' + results[r].name + '</a></div>';

					wsuwp_modules_taxonomy.result_wrapper.append( r_html );

				} // End for

			} else {

				var r_html = '<div class="no-results">Sorry, no results found<div>';

				wsuwp_modules_taxonomy.result_wrapper.append( r_html );

			} // End if

		}, // End update_resluts

		get_search_results:function( query ) {

			var results = [];

			if ( query.length && query.length > wsuwp_modules_taxonomy.search_after ) {

				var term_set = wsuwp_modules_taxonomy.get_term_set();

				var set_length = term_set.length;

				for( var i = 0; i < set_length; i++ ) {

					var name = term_set[i].name.toLowerCase();

					var search = query.toLowerCase();

					if ( -1 !== name.indexOf( search ) ) {

						results.push( term_set[i] );

					} // End if

				} // End for

			} // End if

			return results;

		}, // End et_search_results

		get_alpha_resluts:function( query ) {

			var results = [];

			var term_set = wsuwp_modules_taxonomy.get_term_set();

			var set_length = term_set.length;

			for( var i = 0; i < set_length; i++ ) {

				var name = term_set[i].name;

				var char = name.charAt( 0 );

				char = char.toLowerCase();

				if ( query === char ) {

					results.push( term_set[i] );

				} // End if

			} // End for

			return results;

		}, // End get_alpha_resluts

		get_term_set:function() {

			$term_set = [];

			if ( 'undefined' !== typeof wsuwp_term_set ) {

				$term_set = wsuwp_term_set;

			} // End if

			return $term_set;

		} // End get_term_set

	} // End wsuwp_modules_taxonomy

	wsuwp_modules_taxonomy.init();
	
} )( jQuery );