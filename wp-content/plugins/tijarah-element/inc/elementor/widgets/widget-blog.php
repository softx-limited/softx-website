<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class tijarah_Widget_Blog extends Widget_Base {
 
   public function get_name() {
      return 'blog';
   }
 
   public function get_title() {
      return esc_html__( 'Latest Blog', 'tijarah' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'tijarah-elements' ];
   }
   protected function _register_controls() {
      $this->start_controls_section(
         'blog_section',
         [
            'label' => esc_html__( 'Blog', 'tijarah' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'tijarah' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => [
               'ASC'  => __( 'Ascending', 'tijarah' ),
               'DESC' => __( 'Descending', 'tijarah' )
            ],
         ]
      );
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'ppp', 'basic' );
      ?>

      <div class="container">
         <div class="row justify-content-center">
            <?php
            $blog = new \WP_Query( array( 
               'post_type' => 'post',
               'posts_per_page' => 3,
               'ignore_sticky_posts' => true,
               'order' => $settings['order'],
            ));
            /* Start the Loop */
            while ( $blog->have_posts() ) : $blog->the_post();
            ?>
            <!-- blog -->
            <div class="col-xl-4 col-md-6">
               <div class="blog-item">
                  <?php if (has_post_thumbnail()): ?>
                  <div class="blog-thumb">
                     <a href="<?php the_permalink() ?>">
                        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'tijarah-350x200'); ?>" alt="<?php the_title_attribute() ?>">
                     </a>
                  </div>
                  <?php endif ?> 
                  <div class="blog-content">
                     <div class="blog-meta">
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
                        <span> - <?php echo get_the_date(); ?></span>
                     </div>
                     <h4><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), 6, '...' );?></a></h4>
                     <p><?php echo wp_trim_words( get_the_content(), 9, ' ...' );?></p>
                  </div>
               </div>
            </div>
            <?php 
            endwhile; 
            wp_reset_postdata();
            ?>
         </div>
      </div>
      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new tijarah_Widget_Blog );