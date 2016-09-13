<div id="blog_head">				
	
	<div id="searchbox" class="menu">
		
		<?php get_search_form(true); ?>
		
	</div>
			
	<?php wp_dropdown_categories( 'show_option_none=Select category' ); ?>
	
	<script type="text/javascript">
		var dropdown = document.getElementById("cat");
		function onCatChange() {
			if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
				location.href = "<?php echo home_url();
				?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
			}
		}
		dropdown.onchange = onCatChange;
	</script>
	
</div>