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
<section id="section-ustria-ensemen" class="section-ustria-ensemen pt-12 pb-12 md:pt-24 md:pb-24 xl:pt-0 xl:pb-52">
	<div class="theme-container">

		<div class="theme-grid gap-y-8 md:gap-y-0 items-start">

			<!-- Mobile + Tablet -->
			<div class="col-span-2 md:col-start-2 md:col-span-5 xl:hidden">
				<h2 class="title-main italic text-off-white"><?php the_field( 'ustria_ensemen_title_1' ); ?></h2>
			</div>

			<div class="col-span-1 md:col-start-2 md:col-span-3 md:pt-5 xl:hidden">
				<?php if ( $ue_image_title ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_title,
						'full',
						false,
						array(
							'class' => 'section-ustria-ensemen__bg w-full h-auto max-w-40 md:max-w-none',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-1 md:col-start-5 md:col-span-2md:pt-10 xl:hidden">
				<h2 class="title-main italic text-off-white"><?php the_field( 'ustria_ensemen_title_2' ); ?></h2>
			</div>

			<div class="col-span-2 md:col-start-1 md:col-span-3 md:pt-10 xl:hidden">
				<?php if ( $ue_image_description ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_description,
						'full',
						false,
						array(
							'class' => 'section-ustria-ensemen__bg w-full h-auto max-w-52 md:max-w-none',
						)
					); ?>
				<?php endif; ?>
				<p class="text-off-white font-openSans text-[18px] leading-[30px] tracking-[0.5px] md:mt-14 hidden md:block"><?php the_field( 'ustria_ensemen_description' ); ?></p>
			</div>

			<div class="col-span-2 md:col-start-4 md:col-span-3 md:pt-40 xl:hidden">
				<?php if ( $ue_photo ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_photo,
						'full',
						false,
						array(
							'class' => 'section-ustria-ensemen__photo w-full h-auto max-w-[279px] ml-auto md:max-w-none md:ml-0',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-2 md:col-start-1 md:col-span-3 md:pt-8 md:hidden">
				<p class="text-off-white font-openSans text-[18px] leading-[30px] tracking-[0.5px] max-w-[572px]"><?php the_field( 'ustria_ensemen_description' ); ?></p>
			</div>

			<!-- Desktop -->
			<div class="hidden xl:block xl:col-start-4 xl:col-span-4">
				<?php if ( $ue_image_title ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_title,
						'full',
						false,
						array(
							'class' => 'section-ustria-ensemen__bg',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="hidden xl:block xl:col-start-8 xl:col-span-5">
				<h2 class="title-main text-off-white"><?php the_field( 'ustria_ensemen_title_1' ); ?></h2>
				<h2 class="title-main text-off-white xl:pt-32"><?php the_field( 'ustria_ensemen_title_2' ); ?></h2>
			</div>

			<div class="hidden xl:block xl:col-start-1 xl:col-span-5 xl:pt-16">
				<?php if ( $ue_image_description ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_image_description,
						'full',
						false,
						array(
							'class' => 'section-ustria-ensemen__bg',
						)
					); ?>
				<?php endif; ?>

				<p class="body-small text-off-white pt-5 max-w-[572px]"><?php the_field( 'ustria_ensemen_description' ); ?></p>
			</div>

			<div class="hidden xl:block xl:col-start-7 xl:col-span-6 xl:pt-40">
				<?php if ( $ue_photo ) : ?>
					<?php echo wp_get_attachment_image(
						$ue_photo,
						'full',
						false,
						array(
							'class' => 'section-ustria-ensemen__photo h-auto',
						)
					); ?>
				<?php endif; ?>
			</div>

		</div>

	</div>
</section>