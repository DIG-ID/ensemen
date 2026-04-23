<?php
/**
 * Celebrate Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-celebrate" class="section-celebrate bg-brown xl:pt-72 xl:pb-[427px]">
	<div class="theme-container">
        <div class="theme-grid">
            <div class="xl:col-start-3 xl:col-span-5">
                <h2 class="title-main italic text-off-white"><?php the_field( 'celebrate_title' ); ?></h2>
        </div>
        <div class="xl:col-start-8 xl:col-span-5">
            <?php if ( get_field( 'celebrate_image_right' ) ) : ?>
            <?php echo wp_get_attachment_image(
                get_field( 'celebrate_image_right' ),
                'full',
                false,
                array(
                    'class'         => 'celebrate_image_right',
                    'loading'       => 'lazy',
                    'fetchpriority' => 'high',
                )
            ); ?>
        </div>
        <?php endif; ?>
        <div class="xl:col-start-1 xl:col-span-6 xl:-mt-32">
            <?php if ( get_field( 'celebrate_image_left' ) ) : ?>
            <?php echo wp_get_attachment_image(
                get_field( 'celebrate_image_left' ),
                'full',
                false,
                array(
                    'class'         => 'celebrate_image_left',
                    'loading'       => 'lazy',
                    'fetchpriority' => 'high',
                )
            ); ?>
        </div>
        <?php endif; ?>
        <div class="xl:col-start-7 xl:col-span-6 xl:pt-60">
            <?php if ( have_rows( 'celebrate_items' ) ) : ?>
                <ul class="celebrate-items xl:flex xl:gap-[109px]">
                    <?php while ( have_rows( 'celebrate_items' ) ) : the_row(); ?>
                        <?php
                        $item_icon = get_sub_field( 'icon' );
                        $item_text = get_sub_field( 'text' );
                        ?>
                        <li class="celebrate-items__item flex items-center gap-[36px]">
                            <?php if ( $item_icon ) : ?>
                                <?php
                                echo wp_get_attachment_image(
                                    $item_icon,
                                    'full',
                                    false,
                                    array(
                                        'class'   => 'celebrate-items__icon shrink-0',
                                        'loading' => 'lazy',
                                    )
                                );
                                ?>
                            <?php endif; ?>
                            <?php if ( $item_text ) : ?>
                                <div class="celebrate-items__text body-small text-off-white"><?php echo wp_kses_post( $item_text ); ?></div>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        <div class="xl:col-start-7 xl:col-span-4 xl:pt-16">
            <p class="body-small text-off-white max-w-[594px]"><?php the_field( 'celebrate_description' ); ?></p>
        </div>
        <div class="xl:col-start-7 xl:col-span-2 pt-16">
            <?php
            $btn_primary = get_field( 'celebrate_button' );
            if ( $btn_primary ) :
              $btn_url    = $btn_primary['url'];
              $btn_title  = $btn_primary['title'];
              $btn_target = $btn_primary['target'] ?: '_self';
              ?>
              <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary">
                <?php echo esc_html( $btn_title ); ?>
              </a>
            <?php endif; ?>
        </div>
        </div>
	</div>
</section>
