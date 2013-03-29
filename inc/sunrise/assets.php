<?php

	// Enqueue backend assets
	if ( is_admin() ) {
		wp_enqueue_style( $this->slug . '-backend', $this->assets( 'css', 'backend.css' ), false, $this->version, 'all' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->slug . '-backend', $this->assets( 'js', 'backend.js' ), array( 'jquery' ), $this->version, false );
	}

	// Enqueue frontend assets
	else {
		wp_enqueue_style( $this->slug . '-frontend', $this->assets( 'css', 'frontend.css' ), false, $this->version, 'all' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->slug . '-frontend', $this->assets( 'js', 'frontend.js' ), array( 'jquery' ), $this->version, false );
	}
?>