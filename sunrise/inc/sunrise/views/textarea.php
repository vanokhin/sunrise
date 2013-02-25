<?php $triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="sunrise-plugin-triggable hide-if-js"' : ''; ?>
<tr<?php echo $triggable; ?>>
	<th scope="row"><label for="sunrise-plugin-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<textarea name="<?php echo $option['id']; ?>" id="sunrise-plugin-field-<?php echo $option['id']; ?>" class="regular-text sunrise-plugin-textarea" rows="<?php echo ( isset( $option['rows'] ) ) ? $option['rows'] : 5; ?>"><?php echo stripslashes( $settings[$option['id']] ); ?></textarea>
		<p class="description"><?php echo $option['desc']; ?></p>
	</td>
</tr>