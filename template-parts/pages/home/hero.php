<?php
/**
 * Hero Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-hero" class="section-hero bg-brown pt-12 pb-20 md:pt-20 md:pb-24 xl:pt-24 xl:pb-0">
	<div class="theme-container">
    <div class="theme-grid">
      <div class="col-start-1 col-span-2 md:col-span-3 xl:col-span-6">
          <?php
          //Image display example
          $img_id = get_field( 'hero_image' );
          if ( $img_id ) :
            echo wp_get_attachment_image(
              $img_id,
              'full',
              false,
              array(
                'class'         => 'w-full h-auto object-cover aspect-[344/327] md:aspect-auto md:min-h-[550px] xl:min-h-[500px]',
                'loading'       => 'eager',
                'fetchpriority' => 'high',
              )
            );
          endif;
          ?>
      </div>
      <div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-7 xl:col-span-6">
        <p class="over-title text-off-white pt-8 pb-2.5 md:pt-0 md:pb-2.5"><?php the_field( 'hero_over-title' ); ?></p>
        <h1 class="title-big text-off-white pb-14 md:pb-24 xl:pb-36"><?php the_field( 'hero_title' ); ?></h1>
        <div class="flex flex-col gap-y-7 xl:grid xl:grid-cols-6 xl:gap-x-5 xl:gap-y-0">
          <div class="w-full col-span-2 md:col-start-1 md:col-span-4 xl:col-start-1 xl:col-span-2">
            <?php
            $btn_primary = get_field( 'hero_button_1' );
            if ( $btn_primary ) :
              $btn_url    = $btn_primary['url'];
              $btn_title  = $btn_primary['title'];
              $btn_target = $btn_primary['target'] ?: '_self';
              ?>
              <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary w-full">
                <?php echo $btn_title; ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="w-full col-span-2 md:col-start-1 md:col-span-4 xl:col-start-4 xl:col-span-2">
            <?php
            $btn_secondary = get_field( 'hero_button_2' );
            if ( $btn_secondary ) :
              $btn_url    = $btn_secondary['url'];
              $btn_title  = $btn_secondary['title'];
              $btn_target = $btn_secondary['target'] ?: '_self';
              ?>
              <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary w-full">
                <?php echo $btn_title; ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
	</div>
</section>
