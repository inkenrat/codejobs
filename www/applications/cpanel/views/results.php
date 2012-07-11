<?php 
if(!defined("_access")) die("Error: You don't have permission to access here..."); 
		
if(isset($message)) {
	echo '<div class="error-box">';
		echo '<p class="error-message bold">No existen Comentarios Registrados</p>';
	echo '</div>';
} else {
	echo isset($search) 	 ? $search 	   : NULL;
	echo isset($table) 	 ? $table 	   : NULL;
	echo isset($pagination) ? $pagination : NULL;
}
