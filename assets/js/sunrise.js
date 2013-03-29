// Wait DOM
jQuery(document).ready(function($) {


	// ########## Tabs ##########

	// Nav tab click
	$('#sunrise-plugin-tabs span').click(function(event) {
		// Hide tips
		$('.sunrise-plugin-spin, .sunrise-plugin-success-tip').hide();
		// Remove active class from all tabs
		$('#sunrise-plugin-tabs span').removeClass('nav-tab-active');
		// Hide all panes
		$('.sunrise-plugin-pane').hide();
		// Add active class to current tab
		$(this).addClass('nav-tab-active');
		// Show current pane
		$('.sunrise-plugin-pane:eq(' + $(this).index() + ')').show();
		// Save tab to cookies
		sunriseCreateCookie( pagenow + '_last_tab', $(this).index(), 365 );
	});

	// Auto-open tab by link with hash
	if ( sunriseStrpos( document.location.hash, '#tab-' ) !== false )
		$('#sunrise-plugin-tabs span:eq(' + document.location.hash.replace('#tab-','') + ')').trigger('click');
	// Auto-open tab by cookies
	else if ( sunriseReadCookie( pagenow + '_last_tab' ) != null )
		$('#sunrise-plugin-tabs span:eq(' + sunriseReadCookie( pagenow + '_last_tab' ) + ')').trigger('click');
	// Open first tab by default
	else
		$('#sunrise-plugin-tabs span:eq(0)').trigger('click');


	// ########## Ajaxed form ##########

	$('#sunrise-plugin-options-form').ajaxForm({
		beforeSubmit: function() {
			$('.sunrise-plugin-success-tip').hide();
			$('.sunrise-plugin-spin').fadeIn(200);
			$('.sunrise-plugin-submit').attr('disabled', true);
		},
		success: function() {
			$('.sunrise-plugin-spin').hide();
			$('.sunrise-plugin-success-tip').show();
			setTimeout(function() {
				$('.sunrise-plugin-success-tip').fadeOut(200);
			}, 2000);
			$('.sunrise-plugin-submit').attr('disabled', false);
		}
	});


	// ########## Reset settings confirmation ##########

	$('.sunrise-plugin-reset').click(function() {
		if (!confirm($(this).attr('title')))
			return false;
		else
			return true;
	});


	// ########## Notifications ##########

	$('.sunrise-plugin-notification').css({
		cursor: 'pointer'
	}).on('click', function(event) {
		$(this).fadeOut(100, function() {
			$(this).remove();
		});
	});


	// ########## Triggables ##########

	// Select
	$('tr[data-trigger-type="select"] select').each(function(i) {

		var // Input data
		name = $(this).attr('name'),
		index = $(this).find(':selected').index();

		//alert( name + ' - ' + index );

		// Hide all related triggables
		$('tr.sunrise-plugin-triggable[data-triggable^="' + name + '="]').hide();

		// Show selected triggable
		$('tr.sunrise-plugin-triggable[data-triggable="' + name + '=' + index + '"]').show();

		$(this).change(function() {

			index = $(this).find(':selected').index();

			// Hide all related triggables
			$('tr.sunrise-plugin-triggable[data-triggable^="' + name + '="]').hide();

			// Show selected triggable
			$('tr.sunrise-plugin-triggable[data-triggable="' + name + '=' + index + '"]').show();
		});
	});

	// Radio
	$('tr[data-trigger-type="radio"] .sunrise-plugin-radio-group').each(function(i) {

		var // Input data
		name = $(this).find(':checked').attr('name'),
		index = $(this).find(':checked').parent('label').parent('div').index();

		// Hide all related triggables
		$('tr.sunrise-plugin-triggable[data-triggable^="' + name + '="]').hide();

		// Show selected triggable
		$('tr.sunrise-plugin-triggable[data-triggable="' + name + '=' + index + '"]').show();

		$(this).find('input:radio').each(function(i2) {

			$(this).change(function() {

				alert();

				// Hide all related triggables
				$('tr.sunrise-plugin-triggable[data-triggable^="' + name + '="]').hide();

				// Show selected triggable
				$('tr.sunrise-plugin-triggable[data-triggable="' + name + '=' + i2 + '"]').show();
			});
		});
	});


	// ########## Clickouts ##########

	$(document).on('click', function(event) {
		if ( $('.sunrise-plugin-prevent-clickout:hover').length == 0 )
			$('.sunrise-plugin-clickout').hide();
	});


	// ########## Upload buttons ##########

	$('.sunrise-plugin-upload-button').click(function(event) {

		// Define upload field
		window.sunrise_current_upload = $(this).attr('rel');

		// Show thickbox with uploader
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// Prevent click
		event.preventDefault();
	});

	window.send_to_editor = function(html) {

		var url;

		if ( jQuery(html).filter('img:first').length > 0 )
			url = jQuery(html).filter('img:first').attr('src');
		else
			url = jQuery(html).filter('a:first').attr('href');

		// Update upload textfield value
		$('#sunrise-plugin-field-' + window.sunrise_current_upload).val(url);

		// Hide thickbox
		tb_remove();
	}


	// ########## Color picker ##########

	$('.sunrise-plugin-color-picker-preview').each(function(index) {
		$(this).farbtastic('.sunrise-plugin-color-picker-value:eq(' + index + ')');
		$('.sunrise-plugin-color-picker-value:eq(' + index + ')').focus(function(event) {
			$('.sunrise-plugin-color-picker-preview').hide();
			$('.sunrise-plugin-color-picker-preview:eq(' + index + ')').show();
		});
	});

});


// ########## Cookie utilities ##########

function sunriseCreateCookie(name,value,days){
	if(days){
		var date=new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires="; expires="+date.toGMTString()
	}else var expires="";
	document.cookie=name+"="+value+expires+"; path=/"
}
function sunriseReadCookie(name){
	var nameEQ=name+"=";
	var ca=document.cookie.split(';');
	for(var i=0;i<ca.length;i++){
		var c=ca[i];
		while(c.charAt(0)==' ')c=c.substring(1,c.length);
		if(c.indexOf(nameEQ)==0)return c.substring(nameEQ.length,c.length)
	}
	return null
}


// ########## Strpos tool ##########

function sunriseStrpos( haystack, needle, offset) {
	var i = haystack.indexOf( needle, offset );
	return i >= 0 ? i : false;
}