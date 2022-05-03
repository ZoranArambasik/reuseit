<?php

add_action( 'init', 'create_menu' );

function create_menu() {
	register_post_type( 'topslider',
		array(
			'labels' => array(
				'name' => __( 'Toppbild' ),
				'add_new'            => 'Lägg till',
				'singular_name' => __( 'Toppbild' )
			),
		'public' => true,
		'has_archive' => true,
		'publicly_queryable'  => false,    // <-- This will stop archive and single view
		'menu_position' => 13,
		'menu_icon' => 'dashicons-format-image'
		)

	);




}



