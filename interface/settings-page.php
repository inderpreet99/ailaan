<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Ailaan Settings</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'ailaan-settings' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="ailaan_message">Message</label></th>
				<td>
					<textarea id="ailaan_message" name="ailaan_message"><?php echo get_option( 'ailaan_message' ); ?></textarea>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>