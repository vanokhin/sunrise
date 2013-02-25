<?php $triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="sunrise-plugin-triggable hide-if-js"' : ''; ?>
<tr<?php echo $triggable; ?>>
	<th scope="row"><label for="sunrise-plugin-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<div class="sunrise-plugin-color-picker">
			<input type="text" value="<?php echo $settings[$option['id']]; ?>" name="<?php echo $option['id']; ?>" id="sunrise-plugin-field-<?php echo $option['id']; ?>" class="regular-text sunrise-plugin-color-picker-value sunrise-plugin-prevent-clickout" style="width:100px" />
			<span class="sunrise-plugin-color-picker-preview sunrise-plugin-clickout"></span>
		</div>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>