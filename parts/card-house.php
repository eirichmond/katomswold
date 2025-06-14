<?php
/**
 * Template part for displaying house cards
 */
?>
<article class="house-card">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="house-card__image">
			<?php the_post_thumbnail( 'medium' ); ?>
		</div>
	<?php endif; ?>
	
	<div class="house-card__content">
		<h3 class="house-card__title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		
		<?php
		// Display location
		$locations = get_the_terms( get_the_ID(), 'location' );
		if ( $locations && ! is_wp_error( $locations ) ) :
			$location = reset( $locations );
		?>
			<div class="house-card__location">
				<?php echo esc_html( $location->name ); ?>
			</div>
		<?php endif; ?>
		
		<?php
		// Display size/capacity
		$min_sleeps = get_post_meta( get_the_ID(), 'sleeps_min', true );
		$max_sleeps = get_post_meta( get_the_ID(), 'sleeps_max', true );
		if ( $min_sleeps && $max_sleeps ) :
		?>
			<div class="house-card__capacity">
				Sleeps <?php echo esc_html( $min_sleeps ); ?>-<?php echo esc_html( $max_sleeps ); ?>
			</div>
		<?php endif; ?>

		<div class="house-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article> 
