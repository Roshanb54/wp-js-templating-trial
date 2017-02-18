jQuery( function($){
	/**
	 * Load new fields.
	 */
	function WjttGetNewFields() {
		var template = wp.template( 'social-links-add' );
		$('#social-icons-listing-table tbody').append(  template( {} ) );
	}

	/**
	 * Load fields with values.
	 */
	function WjttGetFieldValue() {
		var template = wp.template( 'social-links-fields' );
		console.log( "here" + wjtt );
		$('#social-icons-listing-table tbody').append(  template( wjtt ) );
	}

	/**
	 * Hide delete option.
	 */
	function WjttGetHideDelete() {
		var listCount = $('#social-icons-listing-table tbody tr').length;
		if( listCount === 1 ) {
			$('.delete-row').hide();
		}
		else{
			$('.delete-row').show();
		}
	}

	// On page load check values.
	if( wjtt.length > 0 ) {
		WjttGetFieldValue();
	}
	else {
		WjttGetNewFields();
	}

	// Add field event.
	$('#wjtt-add-button').click( function(){
		WjttGetNewFields();
		WjttGetHideDelete();
	});

	// Delete field event.
	$(document).on( 'click', '.delete-row', function(){
		var index = $(this).data('deleteindex');
		$('tr[data-index='+index+']').remove();
		WjttGetHideDelete();
	})
});
