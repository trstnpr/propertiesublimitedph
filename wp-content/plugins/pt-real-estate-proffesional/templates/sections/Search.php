<div class="sproperty">
<div class="grid">

<form role="search" method="get" class="searchform group property-search" action="<?php echo home_url( '/' ); ?>">

<input type="hidden" name="search" value="advanced">

<div class="col-3-12">
<?php 
$location = array(
		'taxonomy'=> 'location',
		'show_count'=> 1,
		'show_option_all' => 'All Locations',
		'name'=> 'location',
		//'value_field' => 'name',
	);
wp_dropdown_categories( $location );
?>
</div>
<div class="col-3-12">
<?php 
$type = array(
		'taxonomy'=> 'types',
		'show_count'=> 0,
		'show_option_all' => 'All Property Types',
		'name'=> 'type',
		//'value_field' => 'name',
	);
wp_dropdown_categories( $type );

?>
</div>
<div class="col-3-12">
<select name="contract" ID="contract">
<option value="" disabled selected>Contract Type</option>
  <option value="rental">Rent</option>
  <option value="sale">Sale</option>
  <option value="sold">Sold</option>

</select>
</div>
<div class="col-3-12">
 <input type="hidden" name="post_type" value="property" />
 <input type="submit" id="searchsubmit" value="Search" />
 </div>
</form>

</div>
</div>