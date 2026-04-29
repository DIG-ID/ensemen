<?php
/**
 * Content Section in the Copyright Page Template.
 *
 * Renders the page title and the WP editor content (Gutenberg).
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-copyright" class="section-copyright bg-brown pt-12 pb-20 md:pt-20 md:pb-32 xl:pt-32 xl:pb-48">
	<div class="theme-container">
		<div class="theme-grid">
			<h1 class="section-copyright__title col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-3 xl:col-span-10 mb-12 md:mb-16 xl:mb-24">
				<?php the_title(); ?>
			</h1>
			<div class="page-copyright-content col-start-1 col-span-2 md:col-start-2 md:col-span-5 xl:col-start-6 xl:col-span-7">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
