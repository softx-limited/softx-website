<?php

// Create a Menu for Activate License
function tijarah_admin_menu() {
    if (is_admin()) {
        add_menu_page( __( 'Activate License', 'tijarah' ),  __( 'Activate License', 'tijarah' ), 'manage_options', 'activate-license','tijarah_activate_license_page_content', 'dashicons-admin-network', 10 );
    }
}
add_action('admin_menu','tijarah_admin_menu' );

// Settings Page for Activate License ( callback function )
function tijarah_activate_license_page_content() { ?>
    <div class="wrap">               
    	<h1><?php echo esc_html__( 'Activate License', 'tijarah' ) ?></h1>

		<div class="update-nag">
			<?php echo esc_html__('Please visit the', 'tijarah' ); ?>
			<a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-"><?php echo esc_html__('Where Is My Purchase Code?', 'tijarah' ); ?></a>
			<?php echo esc_html__('documentation page for full setup instructions.', 'tijarah' ); ?>
		</div>

        <form action='options.php' method='post'>
	        <?php
	        settings_fields('tijarah_activate_license_group');
	        do_settings_sections('tijarah_activate_license_section');
	        submit_button();
	        ?>
        </form>		
    </div>
<?php }

// License input fields init
function tijarah_activate_license_init() {

	register_setting( 'tijarah_activate_license_group', 'tijarah_activate_license_option', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => NULL,
    ) );

	add_settings_section( 'tijarah_activate_license_section', __( 'License Settings', 'tijarah' ), 'tijarah_activate_license_section_callback' , 'tijarah_activate_license_section' );

	function tijarah_activate_license_section_callback() {
	 	echo '<p>'.__('Please enter your purchase code' , 'tijarah').'</p>';
	}

	add_settings_field( 'tijarah_activate_license_input_field', __('Purchase Code', 'tijarah'), 'tijarah_activate_license_setting_callback' , 'tijarah_activate_license_section', 'tijarah_activate_license_section' );

	function tijarah_activate_license_setting_callback() { ?>

	    <input type='text' class="regular-text" name="tijarah_activate_license_option" value="<?php echo get_option('tijarah_activate_license_option') ?>">

	    <p class="description">
	    	<?php

	    	$tijarah_activate_license = !empty( get_option('tijarah_activate_license_option') ) ? get_option('tijarah_activate_license_option') : '';

	    	$product_id = wp_remote_get( 'https://themebing.com/purchase-code-verify/item-id.php?purchase_code='.$tijarah_activate_license );

	    	if ( !is_wp_error($product_id) && isset( $product_id['body'] ) ) {
	 
				if ( $product_id['body'] === '"25768255"' ) { ?>

		    		<h3><?php echo esc_html__( 'Congratulations! Your theme is now successfully activated.', 'tijarah' ) ?></h3>

		    	<?php } else { ?>
		    		<strong><?php echo esc_html__( '( Not activated! )','tijarah' ) ?></strong>
		    		<?php printf(__('Enter your purchase code (e.g %s).', 'tijarah'), 'd54e2c8d-e075-4e4d-a10a-e9bf64r64rdbc');?>
		    		<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-"><?php echo esc_html__( 'See how to get your purchase code', 'tijarah' ) ?></a>

	    		<?php }
	    	} ?>
	    	
	    </p>

	<?php
	}
}
add_action( 'admin_init', 'tijarah_activate_license_init' );

// Admin notice for license key
function tijarah_admin_license_notice(){

	$tijarah_activate_license = !empty( get_option('tijarah_activate_license_option') ) ? get_option('tijarah_activate_license_option') : '';

	$product_id = wp_remote_get( 'https://themebing.com/purchase-code-verify/item-id.php?purchase_code='.$tijarah_activate_license );

	if ( !is_wp_error($product_id) && isset( $product_id['body'] ) ) {
		if ( $product_id['body'] !== '"25768255"' ) { ?>
			<div class="notice notice-error is-dismissible">
				<p>
					<strong>
				        <p><?php echo esc_html__( 'This theme requires license key to install core plugin and auto updates.', 'tijarah' ) ?></p>
				        <span><a href="<?php echo admin_url( 'admin.php?page=activate-license' ); ?>"><?php echo esc_html__( 'Activate License','tijarah' ) ?></a></span> |
				        <span><a href="<?php echo esc_url( 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-' ); ?>" target="_blank"><?php echo esc_html__( 'Get Your Purchase Code','tijarah' ) ?></a></span>
			        </strong>
		        </p>
		    </div>
		<?php }
	} ?>

<?php
}
add_action('admin_notices', 'tijarah_admin_license_notice');