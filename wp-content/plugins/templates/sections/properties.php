<?php 
/*
* Template Section for Properties
*/
	//do_action('realest_display_properties');

	$prop = Pt_Real_Estate_Proffesional_Functions::realest_properties_query();

	echo $prop;
?>