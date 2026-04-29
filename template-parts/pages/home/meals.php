<?php
/**
 * Meals Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */


?>
<section id="section-meals" class="section-meals bg-brown py-24 md:pt-24 md:pb-24 xl:pt-0 xl:pb-52">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-7">
                <h2 class="title-main italic md:italic xl:not-italic text-off-white"><?php the_field( 'meals_title_part_1' ); ?></h2>
            </div>
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-5">
                <h2 class="title-main italic md:italic xl:not-italic text-off-white"><?php the_field( 'meals_title_part_2' ); ?></h2>
            </div>
            <div class="col-span-2 pt-8 md:col-start-4 md:col-span-3 md:pt-8 xl:col-start-7 xl:col-span-4 xl:pt-7">
                <p class="text-off-white font-openSans text-[18px] leading-8 tracking-[0.5px]"><?php the_field( 'meals_description' ); ?></p>
            </div>
        </div>

        <?php if ( have_rows( 'meals_cards' ) ) : ?>
            <?php
            // Collect all cards once and render them in two separate layouts
            // (mobile/desktop, tablet) toggled via responsive hidden/block wrappers.
            $meals_cards = array();
            while ( have_rows( 'meals_cards' ) ) :
                the_row();
                $meals_cards[] = array(
                    'image'  => get_sub_field( 'image' ),
                    'button' => get_sub_field( 'button' ),
                );
            endwhile;

            $render_card = function ( $index, $position_classes, $delay_override = null ) use ( $meals_cards ) {
                if ( empty( $meals_cards[ $index ] ) || empty( $meals_cards[ $index ]['button'] ) ) {
                    return;
                }
                $card_image  = $meals_cards[ $index ]['image'];
                $card_button = $meals_cards[ $index ]['button'];
                $link_url    = $card_button['url'];
                $link_title  = $card_button['title'];
                $link_target = $card_button['target'] ?: '_self';
                $delay_attr  = ( null !== $delay_override )
                    ? ' data-meals-delay="' . esc_attr( $delay_override ) . '"'
                    : '';
                ?>
                <div class="<?php echo esc_attr( $position_classes ); ?>" data-meals-card<?php echo $delay_attr; ?>>
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

            <!-- Mobile + Desktop layout: 3 cards in the staggered staircase -->
            <div class="md:hidden xl:block">
                <div class="theme-grid gap-y-12 pt-12 xl:pt-40 items-start" data-meals-grid>
                    <?php $render_card( 0, 'col-span-2 xl:col-start-2 xl:col-span-3' ); ?>
                    <?php $render_card( 1, 'col-span-2 xl:col-start-5 xl:col-span-4 xl:pl-[75px] xl:pr-[75px] xl:pt-[390px]' ); ?>
                    <?php $render_card( 2, 'col-span-2 xl:col-start-9 xl:col-span-3 xl:pt-40' ); ?>
                </div>
            </div>

            <!-- Tablet-only layout: left column = cards 1 + 3, right column = card 2 -->
            <div class="hidden md:block xl:hidden">
                <div class="theme-grid pt-12 items-start" data-meals-grid data-meals-stagger="0.15">
                    <!-- Left column: cards 1 + 3 stacked -->
                    <div class="md:col-start-1 md:col-span-3">
                        <?php $render_card( 0, '' ); ?>
                        <?php $render_card( 2, 'md:pt-12', 0 ); ?>
                    </div>
                    <!-- Right column: card 2 alone -->
                    <div class="md:col-start-4 md:col-span-3">
                        <?php $render_card( 1, 'md:pt-72' ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
