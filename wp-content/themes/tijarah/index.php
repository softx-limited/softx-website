<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tijarah
 */

get_header();

//HTTP GET
if(!empty($_GET['blog_layout'])){
    $blog_layout_setting = $_GET['blog_layout'];
}
// http://localhost/tijarah/?blog_layout=left

?>

<section class="section-padding">
	<div class="container">
		<div class="row justify-content-center">
			<div class="<?php if ( is_active_sidebar('sidebar') ){ echo'col-xl-8 col-md-7'; } else { echo'col-lg-12'; } ?>">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile; ?>

					<div class="text-center">
					<?php 
					the_posts_pagination( array(
					    'mid_size'  => 2,
					    'prev_text' => esc_html__( '&#10094; Prev', 'tijarah' ),
					    'next_text' => esc_html__( 'Next &#10095;', 'tijarah' ),
					) ); ?>
					</div>

				<?php
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
			<?php if ( is_active_sidebar('sidebar') ){ ?>
				<div class="col-xl-4 col-md-5">
					<?php get_sidebar() ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php get_footer();
