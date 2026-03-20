<?php
/**
 * Title: House Card Search Coast
 * Slug: katomswold/house-card-search-coast
 * Categories: house-card-search
 */
?>

<!-- wp:group {"metadata":{"categories":["house-card-search"],"patternName":"katomswold/house-card-search-coast","name":"House Card Search Coast"},"style":{"dimensions":{"minHeight":"365px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-white-background-color has-background" style="min-height:365px"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","width":"100%","sizeSlug":"thumbnail","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

<!-- wp:post-title {"textAlign":"center","isLink":true,"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","left":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"backgroundColor":"coloreight","textColor":"white","fontSize":"small"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"brief_description"}}}},"fontSize":"x-small"} -->
<p class="has-x-small-font-size"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|tertiary","width":"1px"},"right":[],"bottom":[],"left":[]}},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--tertiary);border-top-width:1px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:columns {"verticalAlignment":null,"isStackedOnMobile":false} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:paragraph {"style":{"layout":{"rowSpan":1,"columnSpan":1},"spacing":{"margin":{"right":"4px"}}},"fontSize":"x-small"} -->
<p class="has-x-small-font-size" style="margin-right:4px">Sleeps </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"kateandtoms/sleeps-to-range"}}},"style":{"layout":{"columnSpan":1,"rowSpan":1}},"fontSize":"x-small"} -->
<p class="has-x-small-font-size"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:paragraph {"align":"right","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"location_text"}}}},"style":{"layout":{"selfStretch":"fill","flexSize":null,"columnSpan":1,"rowSpan":1}},"fontSize":"x-small"} -->
<p class="has-text-align-right has-x-small-font-size"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>

<?php
global $kt_current_house_pricing;
if ( ! empty( $kt_current_house_pricing ) && is_array( $kt_current_house_pricing ) ) :
	?>
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"blockGap":"0.3em"}},"border":{"top":{"color":"var:preset|color|tertiary","width":"1px"},"right":[],"bottom":[],"left":[]},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--tertiary);border-top-width:1px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
	<?php foreach ( $kt_current_house_pricing as $period ) : ?>
		<!-- wp:paragraph {"fontSize":"x-small"} -->
		<p class="has-x-small-font-size"><?php echo esc_html( $period['name'] ); ?> - <?php echo esc_html( $period['formatted_price'] ); ?> *</p>
		<!-- /wp:paragraph -->
	<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
	<?php
endif;
?>

<!-- /wp:group --></div>
<!-- /wp:group -->
