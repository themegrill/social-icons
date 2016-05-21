<tr>
	<td class="sort <?php echo esc_attr( $name ); ?>"></td>
	<td class="social_label"><input type="text" class="input_text" placeholder="<?php esc_attr_e( 'Social Label', 'social-icons' ); ?>" name="_si_icon_labels[]" value="<?php echo esc_attr( $icon['label'] ); ?>" /></td>
	<td class="social_url"><input type="text" class="input_text" placeholder="<?php esc_attr_e( "http://", 'social-icons' ); ?>" name="_si_icon_urls[]" value="<?php echo esc_url( $icon['url'] ); ?>" /></td>
	<td width="1%"><a href="#" class="delete"><?php _e( 'Delete', 'social-icons' ); ?></a></td>
</tr>
