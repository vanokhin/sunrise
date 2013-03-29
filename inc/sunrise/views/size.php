<tr>
	<th scope="row"><label for="sunrise-plugin-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<input type="number" min="<?php echo $option['min']; ?>" max="<?php echo $option['max']; ?>" value="<?php echo $settings[$option['id']][0]; ?>" name="<?php echo $option['id']; ?>[]" id="sunrise-plugin-field-<?php echo $option['id']; ?>" class="regular-text" style="width:80px" />
		<select name="<?php echo $option['id']; ?>[]" id="sunrise-plugin-field-2-<?php echo $option['id']; ?>" style="width:60px">
			<?php
				foreach ( $option['units'] as $value ) {
					$selected = ( $settings[$option['id']][1] == $value ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $value; ?></option>
					<?php
				}
			?>
		</select>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>