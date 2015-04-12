// Wait DOM
jQuery(document).ready(function ($) {


	// ########## Tabs ##########

	// Nav tab click
	$('#sunrise-tabs span').click(function (event) {
		// Hide tips
		$('.sunrise-spin, .sunrise-success-tip').hide();
		// Remove active class from all tabs
		$('#sunrise-tabs span').removeClass('nav-tab-active');
		// Hide all panes
		$('.sunrise-pane').hide();
		// Add active class to current tab
		$(this).addClass('nav-tab-active');
		// Show current pane
		$('.sunrise-pane:eq(' + $(this).index() + ')').fadeIn(300);
		// Save tab to cookies
		createCookie(pagenow + '_last_tab', $(this).index(), 365);
	});

	// Auto-open tab by link with hash
	if (strpos(document.location.hash, '#tab-') !== false) $('#sunrise-tabs span:eq(' + document.location.hash.replace('#tab-', '') + ')').trigger('click');
	// Auto-open tab by cookies
	else if (readCookie(pagenow + '_last_tab') != null) $('#sunrise-tabs span:eq(' + readCookie(pagenow + '_last_tab') + ')').trigger('click');
	// Open first tab by default
	else $('#sunrise-tabs span:eq(0)').trigger('click');


	// ########## Ajaxed form ##########

	$('#sunrise-form').ajaxForm({
		beforeSubmit: function() {
			$('.sunrise-success-tip').hide();
			$('.sunrise-spin').fadeIn(200);
			$('.sunrise-submit').attr('disabled', true);
			$('.sunrise-notice').fadeOut(400);
		},
		success: function() {
			$('.sunrise-spin').hide();
			$('.sunrise-success-tip').show();
			setTimeout(function() {
				$('.sunrise-success-tip').fadeOut(200);
			}, 2000);
			$('.sunrise-submit').attr('disabled', false);
		}
	});


	// ########## Reset settings confirmation ##########

	$('.sunrise-reset').click(function () {
		if (!confirm($(this).attr('title'))) return false;
		else return true;
	});

	// ########## Color picker ##########

	$('.sunrise-color-picker').each(function (i) {
		$(this).find('.sunrise-color-picker-wheel').filter(':first').farbtastic('.sunrise-color-picker-value:eq(' +
			i + ')');
		$(this).find('.sunrise-color-picker-value').focus(function () {
			$('.sunrise-color-picker-wheel:eq(' + i + ')').show();
		});
		$(this).find('.sunrise-color-picker-value').blur(function () {
			$('.sunrise-color-picker-wheel:eq(' + i + ')').hide();
		});
		$(this).find('.sunrise-color-picker-button').click(function (e) {
			$('.sunrise-color-picker-value:eq(' + i + ')').focus();
			e.preventDefault();
		});
	});

	// ########## Media manager ##########

	$('.sunrise-media-button').each(function () {
		var $button = $(this),
			$val = $(this).parents('.sunrise-media').find('input:text'),
			file;
		$button.on('click', function (e) {
			e.preventDefault();
			// If the frame already exists, reopen it
			if (typeof (file) !== 'undefined') file.close();
			// Create WP media frame.
			file = wp.media.frames.customHeader = wp.media({
				// Title of media manager frame
				title: sunrise.media_title,
				button: {
					//Button text
					text: sunrise.media_insert
				},
				// Do not allow multiple files, if you want multiple, set true
				multiple: false
			});
			//callback for selected image
			file.on('select', function () {
				var attachment = file.state().get('selection').first().toJSON();
				$val.val(attachment.url).trigger('change');
			});
			// Open modal
			file.open();
		});
	});

	// ########## Image radio ##########

	$('.sunrise-image-radio').each(function () {
		var $this = $(this),
			$options = $this.find('a'),
			$value = $this.find('input');
		// Image click
		$options.on('click', function (e) {
			// Remove selected class from all options
			$options.removeClass('sunrise-image-radio-selected');
			// Add selected class to the current option
			$(this).addClass('sunrise-image-radio-selected');
			// Set new value
			$value.val($(this).data('value'));
			e.preventDefault();
		});
		// Activate selected image
		$options.filter('[data-value="' + $value.val() + '"]').addClass('sunrise-image-radio-selected');
	});

	// ########## Cookie utilities ##########

	function createCookie(name, value, days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString()
		} else var expires = "";
		document.cookie = name + "=" + value + expires + "; path=/"
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length)
		}
		return null
	}

	// ########## Strpos tool ##########

	function strpos(haystack, needle, offset) {
		var i = haystack.indexOf(needle, offset);
		return i >= 0 ? i : false;
	}

});