<?php
/**
 * Ustria Ensemen Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-ustria-ensemen" class="section-ustria-ensemen xl:pb-96 ">
	<div class="theme-container">
		<div class="theme-grid">
            <div class="xl:col-start-4 xl:col-span-4">
            	<?php if ( get_field( 'ustria_ensemen_image_title' ) ) : ?>
                    <?php echo wp_get_attachment_image(
                        get_field( 'ustria_ensemen_image_title' ),
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
                <?php if ( get_field( 'ustria_ensemen_image_description' ) ) : ?>
                    <?php echo wp_get_attachment_image(
                        get_field( 'ustria_ensemen_image_description' ),
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
                        <?php if ( get_field( 'ustria_ensemen_photo' ) ) : ?>
                            <?php echo wp_get_attachment_image(
                                get_field( 'ustria_ensemen_photo' ),
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
		</div>
	</div>
</section>