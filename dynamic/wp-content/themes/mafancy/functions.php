<?php

// My Functions

function my_logo()
{
	global $post;
	if ( is_front_page() && is_home() ) {
		echo '<h1 class="logo"><a href="' . home_url( '/' ) . '"><img alt="' . get_bloginfo( 'name' ) . '" height="108" src="' . get_template_directory_uri() . '/img/logo@2x.png" width="428"></a></h1>' . "\n";
	} else {
		echo '<div class="logo"><a href="' . home_url( '/' ) . '"><img alt="' . get_bloginfo( 'name' ) . '" height="108" src="' . get_template_directory_uri() . '/img/logo@2x.png" width="428"></a></div>' . "\n";
	}
}

function my_menu( $theme_location )
{
	wp_nav_menu( array(
		'theme_location'  => $theme_location,
		'container'       => false,
		'menu_class'      => "menu-{$theme_location}",
		'fallback_cb'     => false,
		'depth'           => 1,
	) );
}

function my_thumb()
{
	global $post;
	$thumbID = get_post_thumbnail_id( $post->ID );
	if ( $thumbID ) {
		$source = wp_get_attachment_image_src( $thumbID, get_field( 'tile-size', $post->ID ) );
		if ( $source ) {
			echo $source[0];
		}
	}
}

function my_category()
{
	global $post;
	$arr  = array();
	$cats = get_the_category( $post->ID );
	foreach( $cats as $cat ) {
		$arr[] = $cat->name;
	}
	echo implode( ', ', $arr );
}

function my_full_image( $field = 'imagem', $css_class = '' )
{
	global $post;
	$img = get_field( $field );
	if ( $img ) {
		echo '<img src="' . $img['url'] . '" alt="' . $img['alt'] . '" class="' . $css_class . '">' . "\n";
	}
}

function my_related_query()
{
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if ($tags) {
		$tag_ids = array();
		foreach( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
		return array(
			'tag__in'             => $tag_ids,
			'post_type'           => $post->post_type,
			'post__not_in'        => array( $post->ID ),
			'posts_per_page'      => 4,
			'ignore_sticky_posts' => true
		);
	}
}

// Filters

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_filter( 'post_class', 'my_post_class' );

function my_post_class( $classes )
{
	global $post;
	$tileSize = get_field( 'tile-size', $post->ID );
	if ( $tileSize ) {
		$sizes = array(
			'post-thumbnail' => '',
			'horizontal'     => 'w2',
			'vertical'       => 'h2',
			'double'         => 'w2 h2',
		);
		$classes[] = $sizes[$tileSize];
	}
	return $classes;
}

add_filter( 'acf/settings/show_admin', 'my_acf_show_admin' );

function my_acf_show_admin( $show )
{
	return get_current_user_id() == 1;
}

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );

function my_toolbars( $toolbars )
{
	$toolbars['Very Simple'] = array();
	$toolbars['Very Simple'][1] = array( 'bold', 'italic', 'link', 'unlink' );
	return $toolbars;
}

add_filter( 'next_posts_link_attributes', 'my_next_posts_link_attributes' );

function my_next_posts_link_attributes()
{
	return 'class="button next-posts"';
}

// Actions

add_action( 'wp_footer', 'my_footer' );

function my_footer()
{
	?><div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=646707978808262&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));
	</script><?php
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );

function my_scripts()
{
	global $post;

	// CSS
	wp_enqueue_style( 'my-css', get_template_directory_uri() . '/css/screen.css', array(), filemtime( TEMPLATEPATH . '/css/screen.css' ) );

	// jQuery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.11.2.min.js', false, '1.11.2', true );
	wp_enqueue_script( 'jquery' );

	// JS
	wp_enqueue_script( 'packery', get_template_directory_uri() . '/js/lib/packery.pkgd.min.js', array(), '1.3.2', true );
	wp_register_script( 'my-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'packery' ), filemtime( TEMPLATEPATH . '/js/scripts.js' ), true );

	if ( ! is_single() && ! is_page() && ! is_404() ) {
		global $wp_query, $query_string;
		if ( $wp_query->max_num_pages > $wp_query->paged ) {
			$query = wp_parse_args( $query_string, array(
				'paged' => 1,
				'post_status' => 'publish',
			) );
			wp_localize_script( 'my-js', 'myIS', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'my_infinite_scroll_nonce' ),
				'query'   => $query,
				'max'     => $wp_query->max_num_pages,
			) );
		}
	}
	wp_enqueue_script( 'my-js' );

	// View Count
	if ( is_single() )
	{
		wp_register_script( 'my-view-count', get_template_directory_uri() . '/js/single.js', array( 'jquery' ), filemtime( TEMPLATEPATH . '/js/single.js' ), true );
		wp_localize_script( 'my-view-count', 'myAjax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'post_id' => $post->ID,
			'nonce'   => wp_create_nonce( 'my_view_count_nonce' ),
		) );
		wp_enqueue_script( 'my-view-count' );
	}
}

add_action( 'admin_menu', 'remove_menus' );

function remove_menus()
{
	global $menu;
	$restricted = array( __('Tools'), __('Comments') );
	end( $menu );
	while ( prev( $menu ) ) {
		$value = explode( ' ', $menu[key( $menu )][0] );
		if ( in_array( $value[0] != NULL ? $value[0] : "" , $restricted ) ) {
			unset( $menu[key( $menu )] );
		}
	}
}

// Ajax

add_action( 'wp_ajax_my_view_count', 'my_view_count' );
add_action( 'wp_ajax_nopriv_my_view_count', 'my_view_count' );

function my_view_count()
{
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'my_view_count_nonce' ) ) {
		exit( 'No naughty business please' );
	}

	$postID = $_REQUEST['post_id'];
	if ( ! $postID ) {
		die();
	}
	$views  = intval( get_post_meta( $postID, '_views', true ) );
	if ( ! $views ) {
		$views = 0;
	}
	$ok = update_post_meta( $postID, '_views', $views + 1 );

	if ( $ok === false ) {
		$result['type']  = 'error';
		$result['count'] = $views;
	} else {
		$result['type']  = 'success';
		$result['count'] = $views + 1;
	}

	if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
		$result = json_encode( $result );
		echo $result;
	} else {
		header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
	}

	die();
}

add_action( 'wp_ajax_my_infinite_scroll', 'my_infinite_scroll' );
add_action( 'wp_ajax_nopriv_my_infinite_scroll', 'my_infinite_scroll' );

function my_infinite_scroll()
{
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'my_infinite_scroll_nonce' ) ) {
		exit( 'No naughty business please' );
	}

	$query = new WP_Query( $_REQUEST['query'] );
	while( $query->have_posts() ) {
		$query->the_post();
		get_template_part( 'loop' );
	}

	die();
}

// Views Column

add_action( 'manage_posts_custom_column' , 'custom_columns', 10, 2 );
add_action( 'pre_get_posts', 'manage_wp_posts_be_qe_pre_get_posts', 1 );
add_filter( 'manage_posts_columns' , 'add_views_column' );
add_filter( 'manage_edit-post_sortable_columns', 'manage_sortable_columns' );

function custom_columns( $column, $post_id )
{
	switch ( $column ) {
		case 'views':
			echo get_post_meta( $post_id, '_views', true );
			break;
	}
}

function manage_wp_posts_be_qe_pre_get_posts( $query )
{
	if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
		switch( $orderby ) {
			case 'views' :
				$query->set( 'meta_key', '_views' );
				$query->set( 'orderby', 'meta_value_num' );
				break;
		}
	}
}

function add_views_column( $columns )
{
	return array_merge( $columns, array('views' => __('Views')) );
}

function manage_sortable_columns( $sortable_columns )
{
	$sortable_columns['views'] = 'views';
	return $sortable_columns;
}


// Register Theme Features

add_action( 'after_setup_theme', 'custom_theme_features' );

function custom_theme_features()
{
	// Head
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	// Images
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 265, 265, true );
	add_image_size( 'horizontal', 530, 265, true );
	add_image_size( 'vertical', 265, 530, true );
	add_image_size( 'double', 530, 530, true );
	// Tags in Html 5
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	// Editor style
	// add_editor_style();
	// Options Pages
	acf_add_options_page( array(
		'page_title' => 'Personalizar',
		'position'   => 21,
		'menu_slug'  => 'acf-options',
		'redirect'   => true,
	) );
	acf_add_options_sub_page( array(
		'page_title' 	=> 'TV',
		'menu_title'	=> 'TV',
		'parent_slug'	=> 'acf-options',
	) );
	acf_add_options_sub_page( array(
		'page_title' 	=> 'Rodapé',
		'menu_title'	=> 'Rodapé',
		'parent_slug'	=> 'acf-options',
	) );
}

// Register Navigation Menus

add_action( 'init', 'custom_navigation_menus' );

function custom_navigation_menus()
{
	$locations = array(
		'site' => 'Páginas',
		'categories' => 'Categorias',
		'social' => 'Redes Sociais',
	);
	register_nav_menus( $locations );
}

// Register Sidebar

add_action( 'widgets_init', 'custom_sidebar' );

function custom_sidebar()
{
	$args = array(
		'id'            => 'sidebar',
		'name'          => 'Widgets Rodapé',
		'class'         => 'widget',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	);
	register_sidebar( $args );
}
