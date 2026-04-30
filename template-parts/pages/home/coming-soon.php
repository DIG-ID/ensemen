<?php
/**
 * Meals Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */


?>
<section id="section-meals" class="section-meals bg-sand py-24 md:pt-24 md:pb-24 xl:pt-72 xl:pb-44">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-start-3 xl:col-span-7">
                <h2 class="title-main italic text-wine"><?php the_field( 'coming_soon_title_part_1' ); ?></h2>
            </div>
            <div class="col-span-2 md:col-span-6 xl:col-start-3 xl:col-span-5">
                <h2 class="title-main italic text-wine"><?php the_field( 'coming_soon_title_part_2' ); ?></h2>
            </div>
            <div class="col-span-2 pt-8 md:col-start-4 md:col-span-3 md:pt-8 xl:col-start-8 xl:col-span-4 xl:pt-7 pb-8 xl:pb-36">
                <p class="text-wine font-openSans text-[18px] leading-8 tracking-[0.5px]"><?php the_field( 'coming_soon_description' ); ?></p>
            </div>

            <div class="btn-coming-soon col-span-2 md:col-start-2 md:col-span-4 xl:col-start-5 xl:col-span-4">
                <?php the_field( 'coming_soon_button_text' ); ?>
            </div>

        </div>
    </div>
</section>
