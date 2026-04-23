<?php
/**
 * Hero Section in the Home Page Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

?>
<section id="section-hero" class="section-hero bg-brown xl:pt-24">
	<div class="theme-container">
    <div class="theme-grid">
      <div class="xl:col-start-1 xl:col-span-6">
          <?php
          //Image display example
          $img_id = get_field( 'hero_image' );
          if ( $img_id ) :
            echo wp_get_attachment_image(
              $img_id,
              'full',
              false,
              array(
                'class'         => 'w-full h-auto object-cover',
                'loading'       => 'eager',
                'fetchpriority' => 'high',
              )
            );
          endif;
          ?>
      </div>
      <div class="xl:col-start-7 xl:col-span-6">
        <h2 class="over-title text-off-white pb-8"><?php the_field( 'hero_over-title' ); ?></h2>
        <h1 class="title-big text-off-white pb-60"><?php the_field( 'hero_title' ); ?></h1>
        <div class="grid grid-cols-6 gap-x-5">
          <div class="col-start-1 col-span-2">
            <?php
            $btn_primary = get_field( 'hero_button_1' );
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
          <div class="col-start-4 col-span-2">
            <?php
            $btn_secondary = get_field( 'hero_button_2' );
            if ( $btn_secondary ) :
              $btn_url    = $btn_secondary['url'];
              $btn_title  = $btn_secondary['title'];
              $btn_target = $btn_secondary['target'] ?: '_self';
              ?>
              <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary">
                <?php echo esc_html( $btn_title ); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
	</div>
</section>
