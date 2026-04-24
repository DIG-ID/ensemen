<?php
/**
 * Meals Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */


?>
<section id="section-meals" class="section-meals bg-brown py-[100px] md:pt-[100px] md:pb-[100px] xl:pt-0 xl:pb-40">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-7">
                <h2 class="title-main italic md:italic xl:not-italic text-off-white"><?php the_field( 'meals_title_part_1' ); ?></h2>
            </div>
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-5">
                <h2 class="title-main italic md:italic xl:not-italic text-off-white"><?php the_field( 'meals_title_part_2' ); ?></h2>
            </div>
            <div class="col-span-2 pt-[30px] md:col-start-4 md:col-span-3 md:pt-[30px] xl:col-start-7 xl:col-span-4 xl:pt-7">
                <p class="text-off-white font-open-sans text-[18px] leading-[30px] tracking-[0.5px]"><?php the_field( 'meals_description' ); ?></p>
            </div>
        </div>

        <?php if ( have_rows( 'meals_cards' ) ) : ?>
            <div class="theme-grid gap-y-[50px] md:gap-y-0 pt-[50px] md:pt-[50px] xl:pt-40 items-start">
                <?php
                // Per-card grid placement and stagger offsets for tablet (md) and desktop (xl).
                // Mobile: 3 cards stack full-width; 4th card hidden.
                // Tablet: 4 cards in 2 columns with a staircase/stagger via pt offsets.
                // Desktop: 3 cards in the original staggered layout; 4th is hidden.
                $card_positions = array(
                    0 => 'col-span-2 md:col-start-1 md:col-span-3 xl:col-start-2 xl:col-span-3',
                    1 => 'col-span-2 md:col-start-4 md:col-span-3 md:pt-[216px] xl:col-start-5 xl:col-span-4 xl:pl-[75px] xl:pr-[75px] xl:pt-[390px]',
                    2 => 'col-span-2 md:col-start-1 md:col-span-3 xl:col-start-9 xl:col-span-3 xl:pt-[162px]',
                    3 => 'hidden md:block md:col-start-4 md:col-span-3 md:pt-[404px] xl:hidden',
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
                    $position    = $card_positions[ $card_index ] ?? 'col-span-2 md:col-span-3';
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
                                <span class="card-meal__label text-off-white"><?php echo $link_title; ?></span>
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
