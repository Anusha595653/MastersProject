
	$(document).ready(function()
	{
		$('table#delTable td a.delete').click(function()
		{
			
				var id = $(this).parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent();

				$.ajax(
				{
					   type: "POST",
					   url: "delete_row.php?id="+id,
					   data: data,
					   cache: false,
					
					   success: function(data, textStatus, jQxhr)
					   {
						   if(data=='done'){
							  alert('Successfully Deleted');
						   parent.fadeOut('slow', function() {$(this).remove();});}
						 else
							 alert('failed  Try Again');
					   }
				 });				
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#delTable tr:odd').css('background',' #FFFFFF');
	});
	

