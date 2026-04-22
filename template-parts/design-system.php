<section class="design-system pb-16">
	<div class="theme-container">
		<h1 class="font-secondary text-[58px] mb-12">Design System</h1>
		<div class="theme-grid">

			<!-- Colors -->
			<div class="col-span-2 md:col-span-2 xl:col-span-4 mt-12 border-l border-wine px-8">
				<h2 class="text-wine mb-6 font-primary">Colors</h2>
				<ul class="space-y-4">
					<li class="flex items-center gap-4">
						<span class="w-16 h-16 rounded-full bg-brown block shrink-0"></span>
						<span class="font-primary text-sm">Brown<br>#B39E87</span>
					</li>
					<li class="flex items-center gap-4">
						<span class="w-16 h-16 rounded-full bg-wine block shrink-0"></span>
						<span class="font-primary text-sm">Wine<br>#874644</span>
					</li>
					<li class="flex items-center gap-4">
						<span class="w-16 h-16 rounded-full bg-off-white block shrink-0 border border-brown"></span>
						<span class="font-primary text-sm">Off-white<br>#F1F2ED</span>
					</li>
					<li class="flex items-center gap-4">
						<span class="w-16 h-16 rounded-full bg-sand block shrink-0"></span>
						<span class="font-primary text-sm">Sand<br>#E8D4B3</span>
					</li>
				</ul>
			</div>

			<!-- Typography -->
			<div class="col-span-2 md:col-span-2 xl:col-span-8 mt-12 border-l border-wine px-8">
				<h2 class="text-wine mb-6 font-primary">Typography</h2>

				<p class="text-wine text-xs uppercase tracking-widest mb-2 font-primary">Bodoni Moda — font-secondary</p>
				<h1 class="font-secondary text-wine mb-2">H1 — Bodoni Moda</h1>
				<h2 class="font-secondary text-wine mb-2">H2 — Bodoni Moda</h2>
				<h3 class="font-secondary text-wine mb-2">H3 — Bodoni Moda</h3>
				<h4 class="font-secondary text-wine mb-6">H4 — Bodoni Moda</h4>

				<p class="text-wine text-xs uppercase tracking-widest mb-2 font-primary">Open Sans — font-primary</p>
				<p class="font-primary text-wine mb-2 text-base">Body — Open Sans Regular 400</p>
				<p class="font-primary text-wine mb-2 text-base font-semibold">Body Bold — Open Sans SemiBold 600</p>
				<p class="font-primary text-wine mb-2 text-base font-bold">Body Bold — Open Sans Bold 700</p>
				<p class="font-primary text-wine mb-6 text-base font-light">Body Light — Open Sans Light 300</p>
			</div>

		</div>

		<div class="theme-grid mt-12">

			<!-- Buttons -->
			<div class="col-span-2 md:col-span-3 xl:col-span-3 mt-12 border-l border-wine px-8">
				<h2 class="text-wine mb-6 font-primary">Buttons</h2>
				<div id="main-menu" class="mb-4">
					<div class="menu-item">
						<a>Menu default</a>
					</div>
				</div>
				<div class="flex flex-col gap-4 items-start">
					<a class="btn btn-primary">Primary Button</a>
					<a class="btn btn-secondary">Secondary Button</a>
					<a class="btn btn-big-button">Big Button</a>
				</div>
			</div>

			<!-- Icons -->
			<div class="col-span-2 md:col-span-3 xl:col-span-3 mt-12 border-l border-wine px-8">
				<h2 class="text-wine mb-6 font-primary">Icons</h2>
				<div class="flex flex-wrap gap-4">
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/calendar.svg" alt="Calendar" title="Calendar" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/cart.svg" alt="Cart" title="Cart" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/clock.svg" alt="Clock" title="Clock" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/email.svg" alt="Email" title="Email" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/instagram.svg" alt="Instagram" title="Instagram" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/location.svg" alt="Location" title="Location" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/user.svg" alt="User" title="User" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/menu-burger.svg" alt="Menu" title="Menu burger" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/phone.svg" alt="Phone" title="Phone" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/icon1.svg" alt="Icon 1" title="Icon 1" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/icon2.svg" alt="Icon 2" title="Icon 2" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/icon3.svg" alt="Icon 3" title="Icon 3" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svgs/sun-and-birds.svg" alt="Sun and birds" title="Sun and birds" />
				</div>
			</div>

			<!-- Logo -->
			<div class="col-span-2 md:col-span-3 xl:col-span-6 mt-12 border-l border-wine px-8">
				<h2 class="text-wine mb-6 font-primary">Logo</h2>
				<?php
				$image  = get_field( 'theme_logo', 'option' );
				$size   = 'full';
				if ( $image ) :
					echo wp_get_attachment_image( $image, $size, false, array( 'class' => 'w-[111px] md:w-[200px] mb-4' ) );
					echo wp_get_attachment_image( $image, $size, false, array( 'class' => 'w-[184px] md:w-[415px] mb-4' ) );
					echo wp_get_attachment_image( $image, $size, false, array( 'class' => 'w-[149px] md:w-[270px] mb-4' ) );
					echo wp_get_attachment_image( $image, $size, false, array( 'class' => 'w-[207px]' ) );
				endif;
				?>
			</div>

		</div>
	</div>
</section>
