<?php
/**
 * Presentation Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */
 

?>
<section id="section-presentation" class="section-presentation bg-brown xl:pt-80 xl:pb-72">
	<div class="section-presentation__border xl:px-2 ">
		<div class="py-56 text-center">
				<h2 class="title-secondary text-off-white"><?php the_field( 'presentation_title' ); ?></h2>
				<p class="text-off-white pt-10 max-w-[1053px] mx-auto"><?php the_field( 'presentation_description' ); ?></p>
		</div>
	</div>
</section>
