<?php
/**
 * Weekly Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-weekly" class="section-weekly bg-sand py-[100px] md:py-[100px]" data-weekly-reveal>
	<div class="section-weekly__border" data-reveal-border>
		<div class="py-[190px] md:py-[214px] text-center">
			<?php if ( get_field( 'weekly_title' ) ) : ?>
				<h2 class="title-secondary text-wine max-w-[295px] md:max-w-[587px] xl:max-w-none mx-auto" data-reveal-title><?php the_field( 'weekly_title' ); ?></h2>
			<?php endif; ?>
			<?php if ( get_field( 'weekly_description' ) ) : ?>
				<p class="text-wine font-openSans text-[18px] leading-[30px] tracking-[0.5px] pt-[30px] max-w-[292px] md:max-w-[460px] xl:max-w-[867px] mx-auto" data-reveal-desc><?php the_field( 'weekly_description' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
