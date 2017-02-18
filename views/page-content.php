<?php
/**
 * Backend social icon page template.
 *
 * @package WP JS Templating Trial
 */

?>
<div class="wrap">
	<h1>
	<?php esc_html_e( 'Social Icons', 'wp-js-templating-trail' ); ?>
	</h1>
	<form method="post">
		<table class="form-table" id="social-icons-listing-table">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Title' ); ?></th>
					<th><?php esc_html_e( 'URL' ); ?></th>
					<th><?php esc_html_e( 'Open in new window' ); ?></th>
					<th><?php esc_html_e( 'Action' ); ?></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<?php wp_nonce_field( '_wjtt_nonce_action', 'wjtt_nonce' ); ?>
		<input id="wjtt-add-button" type="button" value="<?php esc_html_e( '+ Add', '' ); ?>" class="button" />
		<input id="wjtt-save" type="submit" value="<?php esc_html_e( 'Save', '' ); ?>" class="button button-primary" />
	</form>
</div>
