<?php
	// No-js message
?>
<div class="error sunrise-plugin-notification hide-if-js">
	<p><?php echo $notifications['js']; ?> <a href="http://enable-javascript.com/" target="_blank"><?php _e( 'Instructions', $this->textdomain ); ?></a>.</p>
</div>
<?php
	// Options reseted
	if ( $_GET['message'] == 1 ) {
		?>
		<div class="updated sunrise-plugin-notification">
			<p><?php echo $notifications['reseted']; ?><small class="hide-if-no-js"><?php _e( 'Click to close', $this->textdomain ); ?></small></p>
		</div>
		<?php
	}
	// Options not reseted
	if ( $_GET['message'] == 2 ) {
		?>
		<div class="error sunrise-plugin-notification">
			<p><?php echo $notifications['not-reseted']; ?><small class="hide-if-no-js"><?php _e( 'Click to close', $this->textdomain ); ?></small></p>
		</div>
		<?php
	}
	// Saved
	if ( $_GET['message'] == 3 ) {
		?>
		<div class="updated sunrise-plugin-notification">
			<p><?php echo $notifications['saved']; ?><small class="hide-if-no-js"><?php _e( 'Click to close', $this->textdomain ); ?></small></p>
		</div>
		<?php
	}
	// No changes
	if ( $_GET['message'] == 4 ) {
		?>
		<div class="error sunrise-plugin-notification">
			<p><?php echo $notifications['not-saved']; ?><small class="hide-if-no-js"><?php _e( 'Click to close', $this->textdomain ); ?></small></p>
		</div>
		<?php
	}
?>