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
	0 => 'md:col-start-4 md:col-span-2 xl:col-start-9 xl:col-span-1',
	1 => 'md:col-start-6 md:col-span-1 xl:col-start-11 xl:col-span-1',
);
?>

<footer class="footer-main">
	<div class="footer-main__content bg-sand pt-[32px] pb-[50px] md:pt-[51px] md:pb-[115px] xl:pt-0 xl:pb-[143px]">
		<div class="theme-container">

			<?php if ( $logo_id ) : ?>
				<div class="footer-main__logo flex justify-center pb-[80px] md:pb-[139px] xl:pt-[60px] xl:pb-36">
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

			<!-- Mobile + Tablet layout -->
			<div class="theme-grid items-start text-wine xl:hidden">

				<div class="footer-main__kontakt col-span-2 text-center md:text-left md:col-start-1 md:col-span-3">
					<h3 class="footer-title pb-12"><?php esc_html_e( 'Kontakt', 'ensemen' ); ?></h3>
					<?php if ( $phone ) : ?>
						<p class="footer-content pb-12">
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo $phone; ?></a>
						</p>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<p class="footer-content">
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo $email; ?></a>
						</p>
					<?php endif; ?>
				</div>

				<div class="footer-main__adresse col-span-2 pt-[50px] text-center md:text-left md:pt-0 md:col-start-5 md:col-span-2">
					<h3 class="footer-title pb-12"><?php esc_html_e( 'Adresse', 'ensemen' ); ?></h3>
					<?php if ( $address ) : ?>
						<div class="footer-content"><?php echo wpautop( $address ); ?></div>
					<?php endif; ?>
				</div>

				<?php if ( $opening_hours ) : ?>
					<div class="footer-main__hours col-span-2 pt-[50px] text-center md:text-left md:pt-[60px] md:col-start-1 md:col-span-4">
						<h3 class="footer-title pb-12"><?php esc_html_e( 'Öffnungszeiten', 'ensemen' ); ?></h3>
						<div class="footer-content"><?php echo wpautop( $opening_hours ); ?></div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $menu_items ) ) : ?>
					<nav class="footer-main__nav col-span-2 pt-[50px] md:pt-[60px] grid grid-cols-2 gap-y-[22px] md:col-span-6 md:flex md:flex-row md:justify-between md:gap-4" aria-label="<?php esc_attr_e( 'Footer menu', 'ensemen' ); ?>">
						<?php foreach ( $menu_items as $item ) : ?>
							<a href="<?php echo esc_url( $item->url ); ?>" class="btn-footer"><?php echo esc_html( $item->title ); ?></a>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>

				<div class="footer-main__newsletter col-span-2 pt-[50px] md:pt-[60px] md:col-span-6">
					<?php if ( ! empty( $newsletter['title'] ) ) : ?>
						<h3 class="footer-title pb-12"><?php echo $newsletter['title']; ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $newsletter['newletter_shortcode'] ) ) : ?>
						<?php echo do_shortcode( $newsletter['newletter_shortcode'] ); ?>
					<?php endif; ?>
				</div>

			</div>

			<!-- Desktop layout (original structure preserved) -->
			<div class="theme-grid items-start text-wine hidden xl:grid">

				<div class="footer-main__kontakt xl:col-start-2 xl:col-span-2">
					<h3 class="footer-title pb-12"><?php esc_html_e( 'Kontakt', 'ensemen' ); ?></h3>
					<?php if ( $phone ) : ?>
						<p class="footer-content pb-12">
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo $phone; ?></a>
						</p>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<p class="footer-content">
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo $email; ?></a>
						</p>
					<?php endif; ?>

					<?php if ( $opening_hours ) : ?>
						<div class="footer-main__hours xl:pt-44 xl:w-[calc(150%+10px)]">
							<h3 class="footer-title pb-12"><?php esc_html_e( 'Öffnungszeiten', 'ensemen' ); ?></h3>
							<div class="footer-content"><?php echo wpautop( $opening_hours ); ?></div>
						</div>
					<?php endif; ?>
				</div>

				<div class="footer-main__adresse xl:col-start-4 xl:col-span-2 xl:pl-[105px]">
					<h3 class="footer-title pb-12"><?php esc_html_e( 'Adresse', 'ensemen' ); ?></h3>
					<?php if ( $address ) : ?>
						<div class="footer-content"><?php echo wpautop( $address ); ?></div>
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
						<h3 class="footer-title pb-12"><?php echo $newsletter['title']; ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $newsletter['newletter_shortcode'] ) ) : ?>
						<?php echo do_shortcode( $newsletter['newletter_shortcode'] ); ?>
					<?php endif; ?>
				</div>

			</div>

		</div>
	</div>

	<div class="footer-main__copyright bg-wine py-5 md:py-6">
		<div class="theme-container">
			<div class="theme-grid items-center gap-y-3 md:gap-y-0 text-sand">
				<p class="footer-main__copyright-text copyright col-span-2 text-center md:text-left md:col-start-1 md:col-span-3 xl:col-start-2 xl:col-span-2">
					&copy;<?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved', 'ensemen' ); ?>
				</p>
				<?php if ( ! empty( $footer_menu_items ) ) : ?>
					<?php foreach ( $footer_menu_items as $i => $item ) : ?>
						<?php $position = $copyright_positions[ $i ] ?? ''; ?>
						<a href="<?php echo esc_url( $item->url ); ?>" class="copyright col-span-1 <?php echo esc_attr( $position ); ?>">
							<?php echo esc_html( $item->title ); ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
