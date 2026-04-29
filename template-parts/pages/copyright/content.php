<?php
/**
 * Copyright Page Content.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-copyright" class="section-copyright bg-brown pt-12 pb-20 md:pt-20 md:pb-32 xl:pt-32 xl:pb-48">
	<div class="theme-container">
		<div class="theme-grid">
			<h1 class="section-copyright__title col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-3 xl:col-span-10 pb-32 md:pb-16 xl:pb-10">
				<?php the_title(); ?>
			</h1>
		</div>
		<?php
		if ( have_rows( 'content' ) ) :
			?><ol class="theme-grid copyright-content list-decimal list-inside space-y-2"><?php
			while( have_rows( 'content' ) ) :
				the_row();
				?>
				<li class="copyright-block col-span-2 md:col-span-5 xl:col-span-7 xl:col-start-3 pt-24 md:pt-24 grid grid-cols-2 md:grid-cols-5 xl:grid-cols-7 gap-x-5">
					<div class="col-span-2 md:col-span-5 xl:col-span-7">
						<h2 class="copyright-block__title"><?php the_sub_field( 'title' ); ?></h2>
					</div>
					<div class=" col-span-2 md:col-start-2 md:col-span-4 xl:col-span-6 xl:col-start-2">
						<div class="copyright-block__content"><?php the_sub_field( 'text' ); ?></div>
					</div>
				</li>
				<?php
			endwhile;
			?></ol><?php
		endif;
		?>
	</div>
</section>
