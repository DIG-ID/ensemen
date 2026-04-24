<?php
/**
 * The Section for the Header Template.
 *
 * @package ensemen
 * @subpackage Section
 * @since 1.0.0
 */

$menu_locations = get_nav_menu_locations();
$menu_items     = array();
if ( isset( $menu_locations['main-menu'] ) && $menu_locations['main-menu'] ) {
	$menu_items = wp_get_nav_menu_items( $menu_locations['main-menu'] );
}

$general     = get_field( 'general', 'option' );
$reservation = $general['header_reservation_button'] ?? null;
?>
<header id="header-main" class="header-main bg-brown" itemscope itemtype="http://schema.org/WebSite">
	<div class="theme-container">
		<div class="theme-grid items-center py-[20px] md:py-[26px] xl:py-7">
			<div class="header-main__logo col-start-1 col-span-1 md:col-start-1 md:col-span-1 xl:col-start-2 xl:col-span-3 max-w-[115px] md:max-w-[261px]">
				<?php do_action( 'theme_logo_white' ); ?>
			</div>

			<?php if ( ! empty( $menu_items ) ) : ?>
				<nav class="header-main__nav hidden xl:block xl:col-start-5 xl:col-span-4" aria-label="<?php esc_attr_e( 'Main menu', 'ensemen' ); ?>">
					<ul class="header-main__menu grid grid-cols-4 gap-x-5 list-none m-0 p-0">
						<?php foreach ( array_slice( $menu_items, 0, 4 ) as $item ) : ?>
							<li class="header-main__menu-item">
								<a href="<?php echo esc_url( $item->url ); ?>" class="btn btn-header body-menu w-full">
									<?php echo esc_html( $item->title ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>

			<?php if ( $reservation ) : ?>
				<div class="header-main__reservation col-start-2 col-span-1 md:col-start-5 md:col-span-2 xl:col-start-10 xl:col-span-2">
					<a
						href="<?php echo esc_url( $reservation['url'] ); ?>"
						target="<?php echo esc_attr( $reservation['target'] ?: '_self' ); ?>"
						class="btn btn-reservation reservation-button w-full"
					>
						<?php echo $reservation['title']; ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<div class="header-main__border border-b-2 border-off-white"></div>
	</div>
</header>
