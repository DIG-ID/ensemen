<?php
/**
 * The Section for the Footer Default Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

$general = get_field( 'general', 'option' );

$logo_id       = $general['theme_logo'] ?? null;
$phone         = $general['phone'] ?? '';
$email         = $general['email'] ?? '';
$address       = $general['address'] ?? '';
$opening_hours = $general['opening_hours'] ?? '';
$newsletter    = $general['newsletter'] ?? array();

$menu_locations = get_nav_menu_locations();
$menu_items     = array();
if ( isset( $menu_locations['main-menu'] ) && $menu_locations['main-menu'] ) {
	$menu_items = wp_get_nav_menu_items( $menu_locations['main-menu'] );
}

$footer_menu_items = array();
if ( isset( $menu_locations['footer-menu'] ) && $menu_locations['footer-menu'] ) {
	$footer_menu_items = wp_get_nav_menu_items( $menu_locations['footer-menu'] );
}

// Per-item grid placement for the copyright bar menu links.
$copyright_positions = array(
	0 => 'xl:col-start-9 xl:col-span-1',
	1 => 'xl:col-start-11 xl:col-span-1',
);
?>

<footer class="footer-main">
	<div class="footer-main__content bg-sand xl:pb-[143px]">
	<div class="theme-container">
		<?php if ( $logo_id ) : ?>
			<div class="footer-main__logo flex justify-center xl:pt-[60px] xl:pb-36">
				<?php
				echo wp_get_attachment_image(
					$logo_id,
					'full',
					false,
					array(
						'class'   => 'max-w-full h-auto',
						'loading' => 'lazy',
					)
				);
				?>
			</div>
		<?php endif; ?>

		<div class="theme-grid items-start text-wine">
			<div class="footer-main__kontakt xl:col-start-2 xl:col-span-2">
				<h3 class="footer-title pb-12"><?php esc_html_e( 'Kontakt', 'ensemen' ); ?></h3>
				<?php if ( $phone ) : ?>
					<p class="footer-content pb-12">
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					</p>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<p class="footer-content">
						<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
					</p>
				<?php endif; ?>

				<?php if ( $opening_hours ) : ?>
					<div class="footer-main__hours xl:pt-44 xl:w-[calc(150%+10px)]">
						<h3 class="footer-title pb-12"><?php esc_html_e( 'Öffnungszeiten', 'ensemen' ); ?></h3>
						<div class="footer-content"><?php echo wp_kses_post( wpautop( $opening_hours ) ); ?></div>
					</div>
				<?php endif; ?>
			</div>

			<div class="footer-main__adresse xl:col-start-4 xl:col-span-2 xl:pl-[105px]">
				<h3 class="footer-title pb-12"><?php esc_html_e( 'Adresse', 'ensemen' ); ?></h3>
				<?php if ( $address ) : ?>
					<div class="footer-content"><?php echo wp_kses_post( wpautop( $address ) ); ?></div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $menu_items ) ) : ?>
				<nav class="footer-main__nav xl:col-start-7 xl:col-span-1 flex flex-col items-center gap-[132px]" aria-label="<?php esc_attr_e( 'Footer menu', 'ensemen' ); ?>">
					<?php foreach ( $menu_items as $item ) : ?>
						<a href="<?php echo esc_url( $item->url ); ?>" class="btn-footer"><?php echo esc_html( $item->title ); ?></a>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>

			<div class="footer-main__newsletter xl:col-start-9 xl:col-span-4">
				<?php if ( ! empty( $newsletter['title'] ) ) : ?>
					<h3 class="footer-title pb-12"><?php echo esc_html( $newsletter['title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $newsletter['newletter_shortcode'] ) ) : ?>
					<?php echo do_shortcode( $newsletter['newletter_shortcode'] ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	</div>

	<div class="footer-main__copyright bg-wine xl:py-6">
		<div class="theme-container">
			<div class="theme-grid items-center text-sand">
				<p class="footer-main__copyright-text copyright xl:col-start-2 xl:col-span-2">
					&copy;<?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved', 'ensemen' ); ?>
				</p>
				<?php if ( ! empty( $footer_menu_items ) ) : ?>
					<?php foreach ( $footer_menu_items as $i => $item ) : ?>
						<?php $position = $copyright_positions[ $i ] ?? ''; ?>
						<a href="<?php echo esc_url( $item->url ); ?>" class="copyright <?php echo esc_attr( $position ); ?>">
							<?php echo esc_html( $item->title ); ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
