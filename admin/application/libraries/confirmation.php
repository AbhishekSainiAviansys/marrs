<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class confirmation
{
	public function confirm($class,$confirmMessage='Are you sure to delete this?',$confirmHead='Warning'){
		echo "
			<script>
			$(document).ready(function(){
				$('.".$class."').click(function(event){
					event.preventDefault();
					var href = $(this).attr('href');
					jConfirm('".$confirmMessage."', '".$confirmHead."', function(r) {
						if(r){
							window.location.href = href;
						}
					});
				});
			});
			</script>
		";
	}
} 


