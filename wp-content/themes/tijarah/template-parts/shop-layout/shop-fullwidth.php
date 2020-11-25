<?php
	if ( woocommerce_product_loop() ) { ?>
		<div class="products-filter-area">
			<div class="row">
			<div class="col-md-8 my-auto"><?php woocommerce_result_count(); ?></div>
			<div class="col-md-4 my-auto"><?php woocommerce_catalog_ordering(); ?></div>
			</div>
		</div>

		<?php 
		woocommerce_output_all_notices();
		woocommerce_product_loop_start();

		if ( have_posts() ) { while ( have_posts() ) { the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action( 'woocommerce_shop_loop' ); ?>

				<div class="col-xl-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) )?> col-md-6">
					<?php wc_get_template_part( 'content', 'product' ); ?>
				</div>
			<?php 
			}
		}

		woocommerce_product_loop_end(); ?>

		<div class="text-center mt-5">
		<?php
		the_posts_pagination( array(
		    'mid_size'  => 2,
		    'prev_text' => esc_html__( '&#10094; Prev', 'tijarah' ),
		    'next_text' => esc_html__( 'Next &#10095;', 'tijarah' ),
		) ); ?>
		</div>
		
	<?php 
	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	} ?>