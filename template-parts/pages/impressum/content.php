<?php
/**
 * Impressum Page Content.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-impressum" class="section-impressum bg-brown pt-12 pb-20 md:pt-20 md:pb-32 xl:pt-32 xl:pb-48">
	<div class="theme-container">
		<div class="theme-grid gap-y-12 md:gap-y-16 xl:gap-y-20">
			<h1 class="section-impressum__title col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-3 xl:col-span-10 mb-12 md:mb-16 xl:mb-24">
				<?php the_title(); ?>
			</h1>

			<div class="impressum-block col-start-1 col-span-1 md:col-start-2 md:col-span-2 xl:col-start-6 xl:col-span-2">
				<h2 class="impressum-block__title"><?php the_field( 'inhaber_title' ); ?></h2>
				<div class="impressum-block__content"><?php the_field( 'inhaber_content' ); ?></div>
			</div>

			<div class="impressum-block col-start-2 col-span-1 md:col-start-4 md:col-span-3 xl:col-start-8 xl:col-span-5">
				<h2 class="impressum-block__title"><?php the_field( 'phone_title' ); ?></h2>
				<p class="impressum-block__value"><?php the_field( 'phone_value' ); ?></p>

				<h2 class="impressum-block__title impressum-block__title--spaced"><?php the_field( 'email_title' ); ?></h2>
				<p class="impressum-block__value">
					<a href="mailto:<?php the_field( 'email_value' ); ?>"><?php the_field( 'email_value' ); ?></a>
				</p>
			</div>

			<div class="impressum-block col-start-1 col-span-2 md:col-start-2 md:col-span-5 xl:col-start-6 xl:col-span-7">
				<h2 class="impressum-block__title"><?php the_field( 'credits_title' ); ?></h2>
				<div class="impressum-block__content"><?php the_field( 'credits_content' ); ?></div>
			</div>
		</div>
	</div>
</section>
