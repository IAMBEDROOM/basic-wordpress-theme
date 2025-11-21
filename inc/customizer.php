<?php
/**
 * Basic WordPress Theme Customizer
 *
 * @package Basic_WordPress_Theme
 */

/**
 * Register Customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function basic_wp_theme_customize_register( $wp_customize ) {

	// Section: Theme Options
	$wp_customize->add_section(
		'basic_wp_theme_options',
		array(
			'title'    => __( 'Theme Options', 'basic-wordpress-theme' ),
			'priority' => 30,
		)
	);

	// 1. Background Color
	$wp_customize->add_setting(
		'theme_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_bg_color',
			array(
				'label'    => __( 'Background Color', 'basic-wordpress-theme' ),
				'section'  => 'basic_wp_theme_options',
				'settings' => 'theme_bg_color',
			)
		)
	);

	// 2. Accent Color
	$wp_customize->add_setting(
		'theme_accent_color',
		array(
			'default'           => '#0073aa',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_accent_color',
			array(
				'label'    => __( 'Accent Color', 'basic-wordpress-theme' ),
				'section'  => 'basic_wp_theme_options',
				'settings' => 'theme_accent_color',
			)
		)
	);

	// 3. Header Layout
	$wp_customize->add_setting(
		'header_layout',
		array(
			'default'           => 'centered',
			'sanitize_callback' => 'basic_wp_theme_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'header_layout',
		array(
			'label'    => __( 'Header Layout', 'basic-wordpress-theme' ),
			'section'  => 'basic_wp_theme_options',
			'settings' => 'header_layout',
			'type'     => 'select',
			'choices'  => array(
				'centered' => __( 'Centered', 'basic-wordpress-theme' ),
				'wide'     => __( 'Wide', 'basic-wordpress-theme' ),
			),
		)
	);

	// 4. Footer Text
	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'footer_copyright',
		array(
			'label'    => __( 'Footer Text', 'basic-wordpress-theme' ),
			'section'  => 'basic_wp_theme_options',
			'settings' => 'footer_copyright',
			'type'     => 'text',
		)
	);

}
add_action( 'customize_register', 'basic_wp_theme_customize_register' );

/**
 * Sanitize select options
 *
 * @param string $input   The input from the setting.
 * @param object $setting The setting object.
 * @return string The sanitized input.
 */
function basic_wp_theme_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Output Customizer CSS variables.
 */
function basic_wp_theme_customizer_css() {
	$bg_color     = get_theme_mod( 'theme_bg_color', '#ffffff' );
	$accent_color = get_theme_mod( 'theme_accent_color', '#0073aa' );
	?>
	<style type="text/css">
		:root {
			--theme-bg: <?php echo esc_attr( $bg_color ); ?>;
			--theme-accent: <?php echo esc_attr( $accent_color ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'basic_wp_theme_customizer_css' );