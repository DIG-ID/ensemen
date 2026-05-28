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
		<div class="py-[190px] md:py-[214px] xl:py-40 text-center">
			<?php if ( get_field( 'weekly_title' ) ) : ?>
				<h2 class="title-secondary text-wine max-w-[295px] md:max-w-[587px] xl:max-w-none mx-auto" data-reveal-title><?php the_field( 'weekly_title' ); ?></h2>
			<?php endif; ?>
			<?php if ( get_field( 'weekly_description' ) ) : ?>
				<p class="text-wine font-openSans text-[18px] leading-[30px] tracking-[0.5px] pt-[30px] max-w-[292px] md:max-w-[460px] xl:max-w-[400px] mx-auto" data-reveal-desc><?php the_field( 'weekly_description' ); ?></p>
			<?php endif; ?>
		<div class="theme-grid gap-y-7 xl:gap-y-0 pt-14 md:pt-20 xl:pt-16">
			<div class="col-span-2 md:col-start-3 md:col-span-2 xl:col-start-4">
				<?php
					$btn_primary = get_field( 'weekly_button_1' );
					if ( $btn_primary ) :
						$btn_url    = $btn_primary['url'];
						$btn_title  = $btn_primary['title'];
						$btn_target = $btn_primary['target'] ?: '_self';
						?>
						<a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-weekly px-5 md:px-0 w-full md:w-auto">
							<?php echo $btn_title; ?>
						</a>
					<?php endif; ?>
			</div>
			<div class="col-span-2 md:col-start-3 md:col-span-2 xl:col-start-6 ">
				<?php
					$btn_primary = get_field( 'weekly_button_2' );
					if ( $btn_primary ) :
						$btn_url    = $btn_primary['url'];
						$btn_title  = $btn_primary['title'];
						$btn_target = $btn_primary['target'] ?: '_self';
						?>
						<a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn btn-weekly w-full md:w-auto">
							<?php echo $btn_title; ?>
						</a>
					<?php endif; ?>
			</div>
			<div class="col-span-2 md:col-start-3 md:col-span-2 xl:col-start-8 ">
				<?php
					$btn_primary = get_field( 'weekly_button_3' );
					if ( $btn_primary ) :
						$btn_url    = $btn_primary['url'];
						$btn_title  = $btn_primary['title'];
						$btn_target = $btn_primary['target'] ?: '_self';
						?>
						<a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn btn-weekly w-full md:w-auto">
							<?php echo $btn_title; ?>
						</a>
					<?php endif; ?>
		</div>
	</div>
</section>
