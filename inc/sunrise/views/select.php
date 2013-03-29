<?php
		$trigger = ( $option['trigger'] ) ? ' data-trigger="true" data-trigger-type="select"' : '';
		$triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="sunrise-plugin-triggable hide-if-js"' : '';
?>
<tr<?php echo $trigger, $triggable; ?>>
	<th scope="row"><label for="sunrise-plugin-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<select name="<?php echo $option['id']; ?>" id="sunrise-plugin-field-<?php echo $option['id']; ?>" class="sunrise-plugin-select">
			<?php
				foreach ( $option['options'] as $value => $label ) {
					$selected = ( $settings[$option['id']] == $value ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $label; ?></option>
					<?php
				}
			?>
		</select>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>