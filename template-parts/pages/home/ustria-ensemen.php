<?php
/**
 * Ustria Ensemen Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

$ue_image_title       = get_field( 'ustria_ensemen_image_title' );
$ue_image_description = get_field( 'ustria_ensemen_image_description' );
$ue_photo             = get_field( 'ustria_ensemen_photo' );
?>
<section id="section-ustria-ensemen" class="section-ustria-ensemen pt-[50px] pb-[50px] md:pt-[100px] md:pb-[100px] xl:pt-0 xl:pb-96">
	<div class="theme-container">

		<!-- Mobile + Tablet layout -->
		<div class="theme-grid gap-y-[30px] md:gap-y-0 items-start xl:hidden">

			<div class="col-span-2 md:col-start-2 md:col-span-5">
				<h2 class="title-main italic text-off-white"><?php the_field( 'ustria_ensemen_title_1' ); ?></h2>
			</div>

			<div class="col-span-1 md:col-start-2 md:col-span-3 md:pt-5">
				<?php if ( $ue_image_title ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_title,
						'full',
						false,
						array(
							'class'         => 'section-ustria-ensemen__bg w-full h-auto max-w-[160px] md:max-w-none',
							'loading'       => 'lazy',
							'fetchpriority' => 'high',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-1 md:col-start-5 md:col-span-2 md:pt-10">
				<h2 class="title-main italic text-off-white"><?php the_field( 'ustria_ensemen_title_2' ); ?></h2>
			</div>

			<div class="col-span-2 md:col-start-1 md:col-span-3 md:pt-10">
				<?php if ( $ue_image_description ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_description,
						'full',
						false,
						array(
							'class'         => 'section-ustria-ensemen__bg w-full h-auto max-w-[203px] md:max-w-none',
							'loading'       => 'lazy',
							'fetchpriority' => 'high',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-2 md:col-start-4 md:col-span-3 md:pt-10">
				<?php if ( $ue_photo ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_photo,
						'full',
						false,
						array(
							'class'   => 'section-ustria-ensemen__photo w-full h-auto max-w-[279px] ml-auto md:max-w-none md:ml-0',
							'loading' => 'lazy',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-2 md:col-start-1 md:col-span-3 md:pt-[30px]">
				<p class="text-off-white font-open-sans text-[18px] leading-[30px] tracking-[0.5px] max-w-[572px]"><?php the_field( 'ustria_ensemen_description' ); ?></p>
			</div>

		</div>

		<!-- Desktop layout (original structure preserved) -->
		<div class="theme-grid items-start hidden xl:grid">

			<div class="xl:col-start-4 xl:col-span-4">
				<?php if ( $ue_image_title ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_title,
						'full',
						false,
						array(
							'class'         => 'section-ustria-ensemen__bg',
							'loading'       => 'lazy',
							'fetchpriority' => 'high',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="xl:col-start-8 xl:col-span-5">
				<h2 class="title-main text-off-white"><?php the_field( 'ustria_ensemen_title_1' ); ?></h2>
				<h2 class="title-main text-off-white xl:pt-32"><?php the_field( 'ustria_ensemen_title_2' ); ?></h2>
			</div>

			<div class="xl:col-start-1 xl:col-span-5 xl:pt-16">
				<?php if ( $ue_image_description ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_description,
						'full',
						false,
						array(
							'class'         => 'section-ustria-ensemen__bg',
							'loading'       => 'lazy',
							'fetchpriority' => 'high',
						)
					); ?>
				<?php endif; ?>
				<p class="body-small text-off-white pt-5 max-w-[572px]"><?php the_field( 'ustria_ensemen_description' ); ?></p>
			</div>

			<div class="xl:col-start-6 xl:col-span-6 xl:pt-64">
				<?php if ( $ue_photo ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_photo,
						'full',
						false,
						array(
							'class'   => 'section-ustria-ensemen__photo h-auto',
							'loading' => 'lazy',
						)
					); ?>
				<?php endif; ?>
			</div>

		</div>

	</div>
</section>
