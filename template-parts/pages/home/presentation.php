<?php
/**
 * Presentation Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */
 

?>
<section id="section-presentation" class="section-presentation bg-brown pb-20 md:pt-24 md:pb-24 xl:pt-40 xl:pb-40" data-presentation-draw>
	<div class="section-presentation__border xl:px-2" data-reveal-border>
		<div class="py-36 md:py-52 text-center">
				<h2 class="title-secondary text-off-white max-w-72 md:max-w-[587px] xl:max-w-none mx-auto" data-reveal-title><?php the_field( 'presentation_title' ); ?></h2>
				<p class="body text-off-white pt-3 md:pt-8 max-w-72 md:max-w-[460px] xl:max-w-[753px] mx-auto" data-reveal-desc><?php the_field( 'presentation_description' ); ?></p>
		</div>
	</div>
</section>
