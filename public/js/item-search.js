var timer;
function up() {

	timer = setTimeout(function()
	{	

		var keywords = $('#item_no').val();
		
		if(keywords.lengtth != '')
		{	
			alert("<?php echo url() ?>");
			$.get( "{{ url('/Search?id=') }}"+keywords, function( data ) {
                   //$( "#item_name" ).html( data );  
                   //alert(<?php echo url() ?>);
            });
		}

	},500);

}

function down() {

	clearTimeout(timer);
}