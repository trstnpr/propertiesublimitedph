<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package real-estate-lite
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="grid bottom-border">

	<div class="<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>col-3-12 <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>col-3-12 <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>col-3-12 <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>col-3-12 <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-4' ); ?>
	</div>
	</div><!--col center-->

	<div class="col-center site-info">
		
		&copy; <?php echo date('Y'); ?> <a href="<?php echo bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a>. All Rights Reserved
	</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php echo do_shortcode('[sg_popup id=16]'); ?>

<?php wp_footer(); ?>

</body>
</html>
