<tr>
	<th scope="row"><?php echo $option['name']; ?></th>
	<td class="sunrise-plugin-checkbox-group">
		<?php
			foreach ( $option['options'] as $checkbox => $label ) {
				$checked = ( $settings[$option['id']][$checkbox] == 'on' ) ? ' checked="checked"' : '';
				$field_id = 'sunrise-plugin-field-' . $option['id'] . '-' . $checkbox;
				?>
				<label for="<?php echo $field_id; ?>"><input type="checkbox" name="<?php echo $option['id']; ?>[<?php echo $checkbox; ?>]" id="<?php echo $field_id; ?>"<?php echo $checked; ?> /> <?php echo $label; ?></label><br/>
				<?php
			}
		?>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>