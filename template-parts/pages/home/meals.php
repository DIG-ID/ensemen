<?php
/**
 * Meals Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */


?>
<section id="section-meals" class="section-meals bg-brown py-[100px] md:pt-[100px] md:pb-[100px] xl:pt-0 xl:pb-52">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-7">
                <h2 class="title-main italic md:italic xl:not-italic text-off-white"><?php the_field( 'meals_title_part_1' ); ?></h2>
            </div>
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-5">
                <h2 class="title-main italic md:italic xl:not-italic text-off-white"><?php the_field( 'meals_title_part_2' ); ?></h2>
            </div>
            <div class="col-span-2 pt-[30px] md:col-start-4 md:col-span-3 md:pt-[30px] xl:col-start-7 xl:col-span-4 xl:pt-7">
                <p class="text-off-white font-openSans text-[18px] leading-[30px] tracking-[0.5px]"><?php the_field( 'meals_description' ); ?></p>
            </div>
        </div>

        <?php if ( have_rows( 'meals_cards' ) ) : ?>
            <?php
            // Collect all cards first so we can render them grouped by tablet column.
            $meals_cards = array();
            while ( have_rows( 'meals_cards' ) ) :
                the_row();
                $meals_cards[] = array(
                    'image'  => get_sub_field( 'image' ),
                    'button' => get_sub_field( 'button' ),
                );
            endwhile;

            // Per-card class strings.
            // Mobile: row-start-N forces visual order 1 → 2 → 3 (card 4 hidden) even
            // though the DOM is reordered (1, 3, 2, 4) by the wrapper grouping.
            // Tablet: wrappers act as block columns (cols 1-3 / cols 4-6); cards stack
            // inside with the original pt offsets so the staircase looks identical.
            // Desktop: wrappers use display: contents so cards become direct grid
            // children and resume the original col-start placements.
            $card_classes = array(
                0 => 'col-span-2 row-start-1 md:row-auto xl:col-start-2 xl:col-span-3 xl:row-auto',
                1 => 'col-span-2 row-start-2 md:row-auto md:pt-[216px] xl:col-start-5 xl:col-span-4 xl:pl-[75px] xl:pr-[75px] xl:pt-[390px] xl:row-auto',
                2 => 'col-span-2 row-start-3 md:row-auto md:pt-[216px] xl:col-start-9 xl:col-span-3 xl:pt-[162px] xl:row-auto',
                3 => 'hidden md:block md:pt-[404px] xl:hidden',
            );

            $render_card = function ( $index ) use ( $meals_cards, $card_classes ) {
                if ( empty( $meals_cards[ $index ] ) || empty( $meals_cards[ $index ]['button'] ) ) {
                    return;
                }
                $card_image  = $meals_cards[ $index ]['image'];
                $card_button = $meals_cards[ $index ]['button'];
                $link_url    = $card_button['url'];
                $link_title  = $card_button['title'];
                $link_target = $card_button['target'] ?: '_self';
                $position    = $card_classes[ $index ] ?? 'col-span-2 md:col-span-3';
                ?>
                <div class="<?php echo esc_attr( $position ); ?>" data-meals-card>
                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="card-meal group">
                        <div class="card-meal__img">
                            <?php
                            if ( $card_image ) :
                                echo wp_get_attachment_image(
                                    $card_image,
                                    'full',
                                    false,
                                    array(
                                        'class' => 'w-full h-full object-cover',
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
            };
            ?>
            <div class="theme-grid gap-y-[50px] md:gap-y-0 pt-[50px] md:pt-[50px] xl:pt-40 items-start">
                <!-- Left column on tablet (cols 1-3): cards 1 + 3 -->
                <div class="contents md:block md:col-start-1 md:col-span-3 xl:contents">
                    <?php $render_card( 0 ); ?>
                    <?php $render_card( 2 ); ?>
                </div>
                <!-- Right column on tablet (cols 4-6): cards 2 + 4 -->
                <div class="contents md:block md:col-start-4 md:col-span-3 xl:contents">
                    <?php $render_card( 1 ); ?>
                    <?php $render_card( 3 ); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
