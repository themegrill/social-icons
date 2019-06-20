<?php
/**
 * Social Icons Widget.
 *
 * Displays Social Icons widget.
 *
 * @extends  SI_Widget
 * @version  1.4.0
 * @package  Social_Icons/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Widget_Social_Icons Class
 */
class SI_Widget_Social_Icons extends SI_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'social-icons widget_social_icons';
		$this->widget_description = __( 'Displays Social Network Icons.', 'social-icons' );
		$this->widget_id          = 'themegrill_social_icons';
		$this->widget_name        = __( 'Social Icons', 'social-icons' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Social Icons', 'social-icons' ),
				'label' => __( 'Title', 'social-icons' ),
			),
			'description'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'social-icons' ),
				'desc'  => __( 'Short description to be displayed above the icons.', 'social-icons' ),
			),
			'show_label' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'show_label',
				'label' => __( 'Show icon label', 'social-icons' ),
			),
			'show_greyscale' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show Greyscale icons', 'social-icons' ),
			),
			'open_tab' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Open links in new tab', 'social-icons' ),
			),
			'add_nofollow' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Add nofollow', 'social-icons' ),
			),
			'background_style' => array(
				'type'  => 'select',
				'std'   => 'square',
				'label' => __( 'Background Style', 'social-icons' ),
				'options' => array(
					'none'           => __( 'None', 'social-icons' ),
					'square'         => __( 'Square', 'social-icons' ),
					'rounded'        => __( 'Rounded', 'social-icons' ),
					'square centre'  => __( 'Square Centre', 'social-icons' ),
					'rounded centre' => __( 'Rounded Centre', 'social-icons' ),
				),
			),
			'socicon_size' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 14,
				'max'   => 40,
				'std'   => 16,
				'label' => __( 'Choose Icon Size', 'social-icons' ),
			),
			'icon_padding' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 10,
				'max'   => 80,
				'std'   => 10,
				'label' => __( 'Choose Icon Padding', 'social-icons' ),
			),
			'socicon_sortable' => array(
				'type'  => 'social_icons',
				'class' => 'socicon-sortable',
				'label' => __( 'Sortable Socicon', 'social-icons' ),
				'desc'  => sprintf( __( 'Note that icons above are for reference and not how they will look on front-end. %1$sList of icons supported%2$s', 'social-icons' ), '<br><a target="_blank" href="' . esc_url( 'http://www.socicon.com/chart.php' ) . '">', '</a>' ),
				'btn'   => __( 'Add Icon', 'social-icons' ),
				'std'   => si_get_default_sortable_socicons(),
			),
		);

		parent::__construct();

		// Hooks.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_print_footer_scripts', array( $this, 'admin_js_templates' ) );
		add_action( 'social_icons_widget_field_social_icons', array( $this, 'widget_field_social_icons' ), 10, 4 );
		add_action( 'social_icons_widget_settings_sanitize_option', array( $this, 'widget_sanitize_social_icons' ), 10, 4 );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			wp_enqueue_style( 'social-icons-general' );
		}
	}

	/**
	 * JavaScript field templates.
	 */
	public function admin_js_templates() {
		?><script type="text/html" id="tmpl-social-icons-field">
			<?php $this->list_field_template(); ?>
		</script><?php
	}

	/**
	 * Outputs the social icons settings update form.
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 * @param  array  $setting
	 * @param  array  $instance
	 */
	public function widget_field_social_icons( $key, $value, $setting, $instance ) {
		$show_label = isset( $instance['show_label'] ) ? 'show-icons-label' : 'hide-icons-label';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
			<ul class="social-icons-list <?php echo esc_attr( $show_label ); ?>"
				data-url-field-id="<?php echo $this->get_field_id( 'url-fields' ); ?>"
				data-url-field-name="<?php echo $this->get_field_name( 'url-fields' ); ?>"
				data-label-field-id="<?php echo $this->get_field_id( 'label-fields' ); ?>"
				data-label-field-name="<?php echo $this->get_field_name( 'label-fields' ); ?>"
			><?php
				foreach ( $value as $key => $field ) {
					$this->list_field_template( array(
						'url-value'        => $field['url'],
						'url-field-id'     => $this->get_field_id( 'url-fields' ),
						'url-field-name'   => $this->get_field_name( 'url-fields' ),
						'label-value'      => $field['label'],
						'label-field-id'   => $this->get_field_id( 'label-fields' ),
						'label-field-name' => $this->get_field_name( 'label-fields' ),
					) );
				}
			?></ul>
			<div class="social-icons-add-button">
				<button class="button button-secondary"><?php echo $setting['btn'] ?></button>
			</div>
			<?php if ( isset( $setting['desc'] ) ) : ?>
				<small><?php echo wp_kses_post( $setting['desc'] ); ?></small>
			<?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Sanitize the social icons value of a setting.
	 *
	 * @param  array  $instance
	 * @param  array  $new_instance
	 * @param  string $key
	 * @param  array  $setting
	 * @return array
	 */
	public function widget_sanitize_social_icons( $instance, $new_instance, $key, $setting ) {
		if ( 'social_icons' === $setting['type'] ) {
			$instance = array();

			$icon_urls     = $new_instance['url-fields'];
			$icon_labels   = $new_instance['label-fields'];
			$icon_url_size = sizeof( $icon_urls );
			$allowed_icons = si_get_allowed_socicons();

			for ( $i = 0; $i < $icon_url_size; $i ++ ) {
				if ( ! empty( $icon_urls[ $i ] ) ) {
					$icon_url   = esc_url_raw( $icon_urls[ $i ] );
					$icon_name  = si_get_social_icon_name( $icon_url );
					$icon_label = si_clean( $icon_labels[ $i ] );

					// Validate the icon supported.
					if ( ! in_array( $icon_name, $allowed_icons ) ) {
						continue;
					}

					$instance[ $icon_name . '_' . $i ] = array(
						'url'   => $icon_url,
						'label' => $icon_label,
					);
				}
			}
		}

		return $instance;
	}

	/**
	 * Generates template for field item.
	 * @param array $args
	 */
	protected function list_field_template( $args = array() ) {
		$defaults = array(
			'url-field-id'     => '',
			'url-field-name'   => '',
			'url-value'        => '',
			'label-field-id'   => '',
			'label-field-name' => '',
			'label-value'      => '',
		);

		$args = wp_parse_args( $args, $defaults );

		$icon_color = '';
		$icon_class = 'dashicons dashicons-plus';
		if ( $icon = si_get_social_icon_name( $args['url-value'] ) ) {
			$icon_color = get_socicon( $icon );
			$icon_class = 'socicon socicon-' . $icon;
		}

		?><li class="social-icons-field">
			<div class="social-icons-wrap">
				<div class="social-icons-inputs"><?php
					printf( '<input class="widefat social-icons-field-url" id="%1$s" name="%2$s[]" type="text" placeholder="%3$s" value="%4$s">', $args['url-field-id'], $args['url-field-name'], esc_url( __( 'http://', 'social-icons' ) ), esc_attr( $args['url-value'] ) );
					printf( '<input class="widefat social-icons-field-label" id="%1$s" name="%2$s[]" type="text" placeholder="%3$s" value="%4$s">', $args['label-field-id'], $args['label-field-name'], esc_attr( __( 'Label', 'social-icons' ) ), esc_attr( $args['label-value'] ) );
				?></div>
			</div>
			<span class="social-icons-field-handle <?php echo $icon_class; ?>" style="background-color: <?php echo esc_attr( $icon_color ); ?>"></span>
			<a class="social-icons-field-remove" href="#">
				<span class="dashicons dashicons-no-alt"></span>
			</a>
		</li><?php
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

		$icon_class = false;
		$color_type = 'text';
		$class_list = array();

		// Label class.
		if ( $instance['show_label'] ) {
			$class_list[] = 'show-icons-label';
		}

		// Greyscale class.
		if ( $instance['show_greyscale'] ) {
			$icon_class   = '#555';
			$class_list[] = 'social-icons-greyscale';
		}

		// Background class.
		if ( $instance['background_style'] ) {
			$class_list[] = 'icons-background-' . $instance['background_style'];

			if ( 'none' !== $instance['background_style'] ) {
				$color_type = 'background';
			}
		}

		// Custom icon padding and font size.
		$icon_padding   = empty( $instance['icon_padding'] ) ? 10 : $instance['icon_padding'];
		$icon_font_size = empty( $instance['socicon_size'] ) ? 16 : $instance['socicon_size'];

		?>
		<?php if ( ! empty( $instance['description'] ) ) : ?>
			<p><?php echo $instance['description']; ?></p>
		<?php endif; ?>

		<ul class="social-icons-lists <?php echo esc_attr( implode( ' ', $class_list ) ); ?>">

			<?php
			$count = 0;
			foreach ( $instance['socicon_sortable'] as $title => $field ) :

				$class      = str_replace( '_' . $count, '', $title );
				$icon_color = false !== $icon_class ? $icon_class : get_socicon( $class );
				$background = 'text' !== $color_type ? 'background-color: ' . $icon_color : 'color: ' . $icon_color;
				$nofollow   = ! empty( $instance['add_nofollow'] ) ? 'rel="nofollow"' : '';
				?>

				<li class="social-icons-list-item">
					<a href="<?php echo esc_url( $field['url'] ); ?>" <?php echo ( $instance['open_tab'] ? 'target="_blank"' : '' ); ?> <?php echo $nofollow; ?> class="social-icon">
						<span class="socicon socicon-<?php echo esc_attr( $class ); ?>" style="padding: <?php echo esc_attr( $icon_padding ); ?>px; font-size: <?php echo esc_attr( $icon_font_size ); ?>px; <?php echo esc_attr( $background ); ?>"></span>

						<?php if ( $instance['show_label'] ) : ?>
							<span class="social-icons-list-label"><?php echo esc_html( $field['label'] ); ?></span>
						<?php endif; ?>
					</a>
				</li>

			<?php
			$count++;
			endforeach; ?>

		</ul>

		<?php

		$this->widget_end( $args );
	}
}
