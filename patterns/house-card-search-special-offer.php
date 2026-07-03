<?php
/**
 * Title: House Card Search Special Offer
 * Slug: katomswold/house-card-search-special-offer
 * Categories: house-card-search
 */
?>

<!-- wp:group {"metadata":{"categories":["house-card-search"],"patternName":"katomswold/house-card-search-special-offer","name":"House Card Search Special Offer"},"style":{"dimensions":{"minHeight":"365px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-white-background-color has-background" style="min-height:365px"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","width":"100%","height":"280px","scale":"cover","sizeSlug":"thumbnail","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

<!-- wp:post-title {"textAlign":"center","isLink":true,"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"backgroundColor":"specialoffer","textColor":"white","fontSize":"small"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"brief_description"}}}},"fontSize":"x-small"} -->
<p class="has-x-small-font-size"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|tertiary","width":"1px"},"right":[],"bottom":[],"left":[]}},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--tertiary);border-top-width:1px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"0.2em"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><?php
// Build the "Sleeps" range from post meta. Some houses have no sleeps_min,
// which previously rendered "Sleeps  to N"; in that case show just "Sleeps N".
$sleeps_id  = get_the_ID();
$sleeps_min = get_post_meta($sleeps_id, 'sleeps_min', true);
$sleeps_max = get_post_meta($sleeps_id, 'sleeps_max', true);
$sleeps_text = ('' !== trim((string) $sleeps_min))
	? sprintf('Sleeps %s to %s', $sleeps_min, $sleeps_max)
	: sprintf('Sleeps %s', $sleeps_max);
?><!-- wp:paragraph {"fontSize":"x-small"} -->
<p class="has-x-small-font-size"><?php echo esc_html($sleeps_text); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"right","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"location_text"}}}},"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"x-small"} -->
<p class="has-text-align-right has-x-small-font-size"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php
global $special_offer_attributes;
if (!empty($special_offer_attributes['offer'])) :
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|tertiary","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--tertiary);border-top-width:1px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700"}},"fontSize":"small"} -->
<p class="has-small-font-size" style="font-weight:700"><?php echo esc_html($special_offer_attributes['offer']); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php endif; ?>
</div>
<!-- /wp:group -->
