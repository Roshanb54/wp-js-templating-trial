jQuery( function($){
	function WjttGetNewFields() {
		var template = wp.template( 'social-links-add' );
		$('#social-icons-listing-table tbody').append(  template( {} ) );
	}
	function WjttGetFieldValue() {
		var template = wp.template( 'social-links-fields' );
		$('#social-icons-listing-table tbody').append(  template( wjtt ) );
	}
	function WjttGetHideDelete() {
		var listCount = $('#social-icons-listing-table tbody tr').length;
		if( listCount === 1 ) {
			$('.delete-row').hide();
		}
		else{
			$('.delete-row').show();
		}
	}
	if( wjtt.length > 0 ) {
		WjttGetFieldValue();
	}
	else {
		WjttGetNewFields();
	}
	$('#wjtt-add-button').click( function(){
		WjttGetNewFields();
		WjttGetHideDelete();
	});

	$(document).on( 'click', '.delete-row', function(){
		var index = $(this).data('deleteindex');
		$('tr[data-index='+index+']').remove();
		WjttGetHideDelete();
	})
});
