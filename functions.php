<?php

function my_theme_enqueue_styles() {

    $parent_style = 'divi-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function additional_theme_menu_color_options($wp_customize) {
	// add a setting for the menu button color
	$wp_customize->add_setting( 'et_divi[header_button]', array(
		'default'		=> 'rgba(0,0,0,0.6)',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'et_sanitize_alpha_color',
	) );
	// Add a control to change the menu button color
	$wp_customize->add_control( new ET_Divi_Customize_Color_Alpha_Control( $wp_customize, 'et_divi[header_button]', array(
		'label'		=> esc_html__( 'Menu Button Background Color', 'Divi' ),
		'section'	=> 'et_divi_header_primary',
		'settings'	=> 'et_divi[header_button]',
	) ) );
	// add a setting for the menu button text color
	$wp_customize->add_setting( 'et_divi[header_button_text_color]', array(
		'default'		=> 'rgba(0,0,0,0.6)',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'et_sanitize_alpha_color',
	) );
	// Add a control to change the menu button text color
	$wp_customize->add_control( new ET_Divi_Customize_Color_Alpha_Control( $wp_customize, 'et_divi[header_button_text_color]', array(
		'label'		=> esc_html__( 'Menu Button Text Color', 'Divi' ),
		'section'	=> 'et_divi_header_primary',
		'settings'	=> 'et_divi[header_button_text_color]',
	) ) );

	// add a setting for the menu link color on single posts
	$wp_customize->add_setting( 'et_divi[main_nav_single_post_color]', array(
		'default'		=> '#5b5c5c',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'et_sanitize_alpha_color',
	) );
	// Add a control to change the menu link color on single posts
	$wp_customize->add_control( new ET_Divi_Customize_Color_Alpha_Control( $wp_customize, 'et_divi[main_nav_single_post_color]', array(
		'label'		=> esc_html__( 'Text Color on Single Post', 'Divi' ),
		'section'	=> 'et_divi_header_primary',
		'settings'	=> 'et_divi[main_nav_single_post_color]',
	) ) );
	// add a setting for the menu link color on other pages
	$wp_customize->add_setting( 'et_divi[main_nav_other_page_color]', array(
		'default'		=> '#5b5c5c',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'et_sanitize_alpha_color',
	) );
	// Add a control to change the menu link color on other pages
	$wp_customize->add_control( new ET_Divi_Customize_Color_Alpha_Control( $wp_customize, 'et_divi[main_nav_other_page_color]', array(
		'label'		=> esc_html__( 'Text Color on other pages', 'Divi' ),
		'section'	=> 'et_divi_header_primary',
		'settings'	=> 'et_divi[main_nav_other_page_color]',
	) ) );
	// add a setting for the menu link color on dark template pages
	$wp_customize->add_setting( 'et_divi[main_nav_other_page_color]', array(
		'default'		=> '#5b5c5c',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'et_sanitize_alpha_color',
	) );
	// Add a control to change the menu link color on dark template pages
	$wp_customize->add_control( new ET_Divi_Customize_Color_Alpha_Control( $wp_customize, 'et_divi[main_nav_other_page_color]', array(
		'label'		=> esc_html__( 'Text Color on other pages', 'Divi' ),
		'section'	=> 'et_divi_header_primary',
		'settings'	=> 'et_divi[main_nav_other_page_color]',
	) ) );
	// add a setting for the secondary menu link color on mobile
	$wp_customize->add_setting( 'et_divi[mobile_menu_secondary_link_color]', array(
		'default'		=> '#546570',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'et_sanitize_alpha_color',
	) );
	// Add a control to change the secondary menu link color on mobile
	$wp_customize->add_control( new ET_Divi_Customize_Color_Alpha_Control( $wp_customize, 'et_divi[mobile_menu_secondary_link_color]', array(
		'label'		=> esc_html__( 'Text Color of secondary menu links on mobile', 'Divi' ),
		'section'	=> 'et_divi_header_secondary',
		'settings'	=> 'et_divi[mobile_menu_secondary_link_color]',
	) ) );
}

add_action('customize_register', 'additional_theme_menu_color_options', 12);


//  This function adds linkedIn and YouTube social icion options
if ( ! function_exists( 'et_load_core_options' ) ) {

	function et_load_core_options() {

		global $shortname, $$themename;
		require_once get_template_directory() . esc_attr( "/options_{$shortname}.php" );
		$newOptions = [];
		foreach ($options as $i => $optionArray) {
			$newOptions[] = $optionArray;
			if (isset($optionArray['id']) && $optionArray['id'] == 'divi_show_google_icon') {

				$showOptions = array( 
					"name" =>esc_html__( "Show Linked In Icon", $themename ),
                   	"id" => $shortname."_show_linkedin_icon",
                   	"type" => "checkbox2",
                   	"std" => "on",
                   	"desc" =>esc_html__( "Here you can choose to display the LINKED IN Icon. ", $themename ) );

				$newOptions[] = $showOptions;

				$showOptions2 = array( 
					"name" =>esc_html__( "Show Youtube Icon", $themename ),
                   	"id" => $shortname."_show_youtube_icon",
                   	"type" => "checkbox2",
                   	"std" => "on",
                   	"desc" =>esc_html__( "Here you can choose to display the Youtube Icon. ", $themename ) );

				
				$newOptions[] = $showOptions2;
			}

			if (isset($optionArray['id']) && $optionArray['id'] == 'divi_google_url') {

				$urlOptions = array( "name" =>esc_html__( "Linked In Profile Url", $themename ),
		                   "id" => $shortname."_linkedin_url",
		                   "std" => "#",
		                   "type" => "text",
		                   "validation_type" => "url",
						   "desc" =>esc_html__( "Enter the URL of your LinkedIn Profile. ", $themename ) );

				$urlOptions2 = array( "name" =>esc_html__( "Youtube Url", $themename ),
		                   "id" => $shortname."_youtube_url",
		                   "std" => "#",
		                   "type" => "text",
		                   "validation_type" => "url",
						   "desc" =>esc_html__( "Enter the URL of your Youtube Channel. ", $themename ) );

				$newOptions[] = $urlOptions;
				
				$newOptions[] = $urlOptions2;
			}
		}

		$options = $newOptions;
		
	}

}

// Allow SVG uploads

function allow_svgimg_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'allow_svgimg_types');