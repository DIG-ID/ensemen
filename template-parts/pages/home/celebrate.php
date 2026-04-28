<?php
/**
 * Celebrate Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-celebrate" class="section-celebrate bg-brown pt-12 pb-12 md:pt-24 md:pb-24 xl:pt-52 xl:pb-52">
	<div class="theme-container">
		<div class="theme-grid gap-y-[50px] md:gap-y-0 items-start">

			<div class="col-span-2 md:col-span-6 block xl:hidden">
				<h2 class="title-main italic text-off-white md:pb-16"><?php the_field( 'celebrate_title' ); ?></h2>
			</div>

			<div class="col-span-2 block md:hidden">
				<?php if ( get_field( 'celebrate_image_right' ) ) : ?>
					<?php echo wp_get_attachment_image(
						get_field( 'celebrate_image_right' ),
						'full',
						false,
						array(
							'class' => 'celebrate_image_right w-full h-auto',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-1 md:col-span-3 xl:col-span-7 pt-0 xl:pr-10">
				<div class="hidden xl:grid xl:grid-cols-7">
					<h2 class="xl:col-span-7 2xl:col-span-5 col-start-1 2xl:col-start-3 title-main italic text-off-white xl:pb-16"><?php the_field( 'celebrate_title' ); ?></h2>
				</div>

				<?php if ( get_field( 'celebrate_image_left_portrait' ) ) : ?>
					<?php echo wp_get_attachment_image(
						get_field( 'celebrate_image_left_portrait' ),
						'full',
						false,
						array(
							'class' => 'celebrate_image_left w-full xl:hidden mt-0',
						)
					); ?>
				<?php endif; ?>
				<?php if ( get_field( 'celebrate_image_left' ) ) : ?>
					<?php echo wp_get_attachment_image(
						get_field( 'celebrate_image_left' ),
						'full',
						false,
						array(
							'class' => 'celebrate_image_left w-full h-auto hidden xl:block',
						)
					); ?>
				<?php endif; ?>
			</div>

			<div class="col-span-1 md:col-span-3 xl:col-span-5">
				<?php if ( get_field( 'celebrate_image_right' ) ) : ?>
					<?php echo wp_get_attachment_image(
						get_field( 'celebrate_image_right' ),
						'full',
						false,
						array(
							'class' => 'celebrate_image_right w-full h-auto hidden md:block',
						)
					); ?>
				<?php endif; ?>

				<?php if ( have_rows( 'celebrate_items' ) ) : ?>
					<ul class="celebrate-items flex flex-col xl:flex-row mt-28 md:mt-[4.65rem] xl:mt-32 2xl:mt-40">
						<?php while ( have_rows( 'celebrate_items' ) ) : the_row(); ?>
							<?php
							$item_icon = get_sub_field( 'icon' );
							$item_text = get_sub_field( 'text' );
							?>
							<li class="celebrate-items__item flex flex-row xl:flex-col items-start mb-10 last:mb-0 md:mb-10 md:last:mb-10 xl:mb-0 gap-9 xl:gap-4 flex-1">
								<?php if ( $item_icon ) : ?>
									<?php
									echo wp_get_attachment_image(
										$item_icon,
										'full',
										false,
										array(
											'class' => 'celebrate-items__icon shrink-0',
										)
									);
									?>
								<?php endif; ?>
								<?php if ( $item_text ) : ?>
									<div class="celebrate-items__text text-off-white font-openSans text-[11px] leading-[15px] tracking-[0.5px] md:text-[18px] md:leading-[30px]"><?php echo $item_text; ?></div>
								<?php endif; ?>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				
				<div class="celebrate-wrapper__bottom hidden xl:block">
					<p class="text-off-white font-openSans text-[18px] leading-[30px] tracking-[0.5px] xl:max-w-[594px] mt-1 xl:mt-10 mb-11 xl:mb-16"><?php the_field( 'celebrate_description' ); ?></p>

					<?php
					$btn_primary = get_field( 'celebrate_button' );
					if ( $btn_primary ) :
						$btn_url    = $btn_primary['url'];
						$btn_title  = $btn_primary['title'];
						$btn_target = $btn_primary['target'] ?: '_self';
						?>
						<a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary w-full md:w-auto">
							<?php echo $btn_title; ?>
						</a>
					<?php endif; ?>
					</div>
			</div>

			<div class="col-span-2 md:col-span-6 block xl:hidden">
				<p class="text-off-white font-openSans text-[18px] leading-[30px] tracking-[0.5px] xl:max-w-[594px] mt-1 xl:mt-10 mb-11 xl:mb-16"><?php the_field( 'celebrate_description' ); ?></p>
				<?php
				$btn_primary = get_field( 'celebrate_button' );
				if ( $btn_primary ) :
					$btn_url    = $btn_primary['url'];
					$btn_title  = $btn_primary['title'];
					$btn_target = $btn_primary['target'] ?: '_self';
					?>
					<a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary w-full md:w-auto">
						<?php echo $btn_title; ?>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
