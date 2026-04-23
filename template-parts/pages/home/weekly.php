<?php
/**
 * Weekly Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-weekly" class="section-weekly py-48">
	<?php if ( get_field( 'weekly_background_image' ) ) : ?>
		<?php echo wp_get_attachment_image(
			get_field( 'weekly_background_image' ),
			'full',
			false,
			array(
				'class'         => 'section-weekly__bg',
				'loading'       => 'eager',
				'fetchpriority' => 'high',
			)
		); ?>
	<?php endif; ?>
	<div class="section-weekly__border">
		<div class="py-56 text-center">
			<?php if ( get_field( 'weekly_title' ) ) : ?>
				<h2 class="title-secondary text-wine"><?php the_field( 'weekly_title' ); ?></h2>
			<?php endif; ?>
			<?php if ( get_field( 'weekly_description' ) ) : ?>
				<p class="body-large text-wine pt-10 max-w-[867px] mx-auto"><?php the_field( 'weekly_description' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
