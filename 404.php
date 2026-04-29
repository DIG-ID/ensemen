<?php
get_header();
do_action( 'before_main_content' );
?>

<section class="section-404 mt-6 md:mt-16 mb-20 bg-sand">

	<div class="theme-container flex flex-col justify-center items-center">

		<div class="outer-box theme-grid w-full bg-sand border-[3px] border-wine relative rounded-[5px] px-6 py-5 md:py-9 xl:pt-14 xl:pb-16 mb-6 md:mb-16 before:content-[''] before:absolute before:-top-[3px] before:left-[32px] md:before:left-[64px] xl:before:left-[175px] before:h-[3px] before:w-[30px] md:before:w-[64px] xl:before:w-[160px] before:bg-sand">

				<div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-3 flex justify-center">
					<div class="text-wine font-bodoni italic text-[10.625rem] md:text-[18.75rem] leading-[12.5rem] tracking-[0.0625rem] flex justify-start items-start">
						<span class="block translate-y-0">4</span>
						<span class="block translate-y-8 md:translate-y-24">0</span>
						<span class="block translate-y-0 md:translate-y-16">4</span>
					</div>
				</div>

				<div class="col-span-2 md:col-span-3 md:col-start-3 xl:col-span-4">
					<h2 class="text-wine font-bodoni text-[4.625rem] xl:text-[9.375rem] leading-[4.375rem] xl:leading-[7.8125rem] tracking-[0.0313rem] md:mt-32 xl:mt-0"><?php esc_html_e( 'Seite nicht gefunden.', 'ensemen' ); ?></h2>
				</div>

				<div class="col-span-2 md:col-span-3 md:col-start-3 xl:col-span-4 xl:col-start-8">
					<p class="font-openSans text-[0.9375rem] md:text-lg xl:text-xl text-wine leading-[1.5625rem] md:leading-[1.875rem] xl:leading-[2rem] tracking-[0.0313rem] mt-8 md:mt-12"><?php esc_html_e( 'Die von Ihnen aufgerufene Seite konnte leider nicht gefunden werden. Möglicherweise wurde sie entfernt, umbenannt oder ist vorübergehend nicht verfügbar. Bitte nutzen Sie die Navigation, um zur gewünschten Seite zu gelangen, oder kehren Sie zur Startseite zurück.', 'ensemen' ); ?></p>
				</div>

		</div>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary--reversed">
			<?php esc_html_e( 'zur startseite', 'ensemen' ); ?>
		</a>
	
	</div>

</section>

<?php
do_action( 'after_main_content' );
get_footer();
