<div class="section alizarin">
	<div class="grid">
<?php
$arg = array(
		'post_type' => 'testimonial',
);
$testimony = new WP_Query( $arg );

if ($testimony->have_posts()) {
	 echo '<div id="slider" class="flexslider testimonial"><ul class="slides">';
	while($testimony->have_posts())  {
		echo"<li class='testimony'>";
		$testimony->the_post();

		if(has_post_thumbnail()){
			echo "<div class='testimonial-avatar'>";
			the_post_thumbnail('thumbnail');
			echo "</div>";
		}

		the_content("<p class='testimony-content'>","</p>");
		the_title();
		echo"</li'>";
		}
	echo "</ul></div>";
		wp_reset_postdata();
}?>

<div id="slider" class="flexslider">
	<ul class="slides">
		<li></li>
	</ul>
</div>
</div>
</div>