<script type="text/javascript">
 @role('admin')
	$(document).on('click','#designation',function(){
             $('#select1').val('');
				if($(this).val() == 'Business Development Executives'){
					$('.bdaauthority').addClass('followupvisible');
					$('.adminautority').removeClass('followupvisible');
					$('.onlyadmin').addClass('followupvisible');
				}
				else if($(this).val() == 'Sales Executives'){
					$('.bdaauthority').removeClass('followupvisible');
					$('.adminautority').addClass('followupvisible');
					$('.onlyadmin').addClass('followupvisible');
				}
				else if($(this).val() == 'Admin'){
					$('.bdaauthority').addClass('followupvisible');
					$('.adminautority').addClass('followupvisible');
					$('.onlyadmin').removeClass('followupvisible');
					
				}

	});
 @endrole
</script>