<?php
/**
 * Meals Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */
 

?>
<section id="section-meals" class="section-meals bg-brown xl:pb-40">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="xl:col-start-2 xl:col-span-7">
                <h2 class="title-main text-off-white"><?php the_field( 'meals_title_part_1' ); ?></h2>
            </div>
            <div class="xl:col-start-2 xl:col-span-5">
                <h2 class="title-main text-off-white"><?php the_field( 'meals_title_part_2' ); ?></h2>
            </div>
            <div class="xl:col-start-7 xl:col-span-4 xl:pt-7">
                <p class="body-small text-off-white"><?php the_field( 'meals_description' ); ?></p>
            </div>
        </div>

        <?php if ( have_rows( 'meals_cards' ) ) : ?>
            <div class="theme-grid xl:pt-40 items-start">
                <?php
                // Per-card grid placement and stagger offsets (applied to wrapper, not the card).
                $card_positions = array(
                    0 => 'xl:col-start-2 xl:col-span-3',
                    1 => 'xl:col-start-5 xl:col-span-4 xl:pl-[75px] xl:pr-[75px] xl:pt-[390px]',
                    2 => 'xl:col-start-9 xl:col-span-3 xl:pt-[162px]',
                );

                $card_index = 0;
                while ( have_rows( 'meals_cards' ) ) :
                    the_row();

                    $card_image  = get_sub_field( 'image' );
                    $card_button = get_sub_field( 'button' );

                    if ( ! $card_button ) {
                        $card_index++;
                        continue;
                    }

                    $link_url    = $card_button['url'];
                    $link_title  = $card_button['title'];
                    $link_target = $card_button['target'] ?: '_self';
                    $position    = $card_positions[ $card_index ] ?? 'xl:col-span-3';
                    ?>
                    <div class="<?php echo esc_attr( $position ); ?>">
                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="card-meal group">
                            <div class="card-meal__img">
                                <?php
                                if ( $card_image ) :
                                    echo wp_get_attachment_image(
                                        $card_image,
                                        'full',
                                        false,
                                        array(
                                            'class'   => 'w-full h-full object-cover',
                                            'loading' => 'lazy',
                                        )
                                    );
                                endif;
                                ?>
                            </div>
                            <div class="card-meal__footer">
                                <span class="card-meal__label text-off-white"><?php echo esc_html( $link_title ); ?></span>
                                <img class="card-meal__arrow inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/arrow.svg" alt="" aria-hidden="true" />
                            </div>
                        </a>
                    </div>
                    <?php
                    $card_index++;
                endwhile;
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>
