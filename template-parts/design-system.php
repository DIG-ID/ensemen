<section class="design-system pb-16 bg-white">
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
				<div class="flex flex-col gap-4 items-start bg-sand">
					<a class="btn btn-primary">Primary Button</a>
					<a class="btn btn-reservation">Reservation Button</a>
					<a class="btn btn-footer">Footer Button</a>
				</div>
			</div>

			<!-- Icons -->
			<div class="col-span-2 md:col-span-3 xl:col-span-3 mt-12 border-l bg-wine border-wine px-8">
				<h2 class="text-wine mb-6 font-primary">Icons</h2>
				<div class="flex flex-wrap gap-4">
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/chair.svg" alt="Chair" title="Chair" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/multimedia.svg" alt="Multimedia" title="Multimedia" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/people.svg" alt="People" title="People" />
					<img class="inline-block" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/arrow.svg" alt="Arrow" title="Arrow" />
					<img class="inline-block bg-off-white" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/instagram.svg" alt="Instagram" title="Instagram" />
					<img class="inline-block bg-off-white" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/svg/facebook.svg" alt="Facebook" title="Facebook" />
				</div>
			</div>
<?php /* ?>
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
<?php */ ?>
		</div>
	</div>
</section>
