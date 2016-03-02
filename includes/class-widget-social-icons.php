<?php
/**
 * Social Icons Widget.
 *
 * Displays Social Icons widget.
 *
 * @extends  TG_Widget
 * @version  1.0.0
 * @package  Social_Icons/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include widget abstract class.
if ( ! class_exists( 'TG_Widget' ) ) {
	include_once( 'abstract/abstract-social-icons-widget.php' );
}

/**
 * TG_Widget_Social_Icons Class
 */
class TG_Widget_Social_Icons extends TG_Widget {

	/**
	 * List of supported icons.
	 * @var array
	 */
	protected $icons = array(
		'modelmayhem', 'mixcloud', 'drupal', 'swarm', 'istock', 'yammer', 'ello', 'stackoverflow', 'persona', 'triplej', 'houzz', 'rss', 'paypal', 'odnoklassniki', 'airbnb', 'periscope', 'outlook', 'coderwall', 'tripadvisor', 'appnet', 'goodreads', 'tripit', 'lanyrd', 'slideshare', 'buffer', 'disqus', 'vkontakte', 'whatsapp', 'patreon', 'storehouse', 'pocket', 'mail', 'blogger', 'technorati', 'reddit', 'dribbble', 'stumbleupon', 'digg', 'envato', 'behance', 'delicious', 'deviantart', 'forrst', 'play', 'zerply', 'wikipedia', 'apple', 'flattr', 'github', 'renren', 'friendfeed', 'newsvine', 'identica', 'bebo', 'zynga', 'steam', 'xbox', 'windows', 'qq', 'douban', 'meetup', 'playstation', 'android', 'snapchat', 'twitter', 'facebook', 'googleplus', 'pinterest', 'foursquare', 'yahoo', 'skype', 'yelp', 'feedburner', 'linkedin', 'viadeo', 'xing', 'myspace', 'soundcloud', 'spotify', 'grooveshark', 'lastfm', 'youtube', 'vimeo', 'dailymotion', 'vine', 'flickr', '500px', 'instagram', 'wordpress', 'tumblr', 'twitch', '8tracks', 'amazon', 'icq', 'smugmug', 'ravelry', 'weibo', 'baidu', 'angellist', 'ebay', 'imdb', 'stayfriends', 'residentadvisor', 'google', 'yandex', 'sharethis', 'bandcamp', 'itunes', 'deezer', 'medium', 'telegram', 'openid', 'amplement'
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'social-icons widget_social_icons';
		$this->widget_description = __( 'Displays Social Icons Slots.', 'social-icons' );
		$this->widget_id          = 'themegrill_social_icons';
		$this->widget_name        = __( 'Social Icons', 'social-icons' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Social Icons', 'social-icons' ),
				'label' => __( 'Title', 'social-icons' )
			),
			'description'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'social-icons' ),
				'desc'  => __( 'Short description to be displayed above the icons.', 'social-icons' )
			),
			'show_label' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'show_label',
				'label' => __( 'Show icon label', 'social-icons' )
			),
			'show_greyscale' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show Greyscale icons', 'social-icons' )
			),
			'open_tab' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Open links in new tab', 'social-icons' )
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
				)
			),
			'socicon_size' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 14,
				'max'   => 40,
				'std'   => 16,
				'label' => __( 'Choose Icon Size', 'social-icons' )
			),
			'socicon_sortable' => array(
				'type'  => 'social_icons',
				'class' => 'socicon-sortable',
				'label' => __( 'Sortable Socicon', 'social-icons' ),
				'desc'  => sprintf( __( 'Note that icons above are for reference and not how they will look on front-end. %sList of icons supported%s', 'social-icons' ), '<br><a target="_blank" href="' . esc_url( 'http://www.socicon.com/chart.php' ) . '">', '</a>' ),
				'btn'   => __( 'Add Icon', 'social-icons' ),
				'std'   => array(
					'twitter' => array(
						'url'   => 'https://twitter.com/',
						'label' => __( 'Follow Me', 'social-icons' )
					),
					'facebook' => array(
						'url'   => 'http://facebook.com/',
						'label' => __( 'Friend me on Facebook', 'social-icons' )
					)
				)
			)
		);

		parent::__construct();

		// Hooks
		add_action( 'admin_print_footer_scripts', array( $this, 'admin_js_templates' ) );
		add_action( 'social_icons_widget_field_social_icons', array( $this, 'widget_field_social_icons' ), 10, 4 );
		add_action( 'social_icons_widget_settings_sanitize_option', array( $this, 'widget_sanitize_social_icons' ), 10, 4 );
	}

	/**
	 * JavaScript templates.
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
						'label-field-name' => $this->get_field_name( 'label-fields' )
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

			for ( $i = 0; $i < count( $new_instance['url-fields'] ); $i++ ) {
				$url   = esc_url_raw( $new_instance['url-fields'][ $i ] );
				$label = sanitize_text_field( $new_instance['label-fields'][ $i ] );

				if ( $url ) {
					$instance[ sanitize_key( $this->get_icon( $url ) ) ] = array(
						'url'   => $url,
						'label' => $label
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

		$icon_class = 'dashicons dashicons-plus';
		if ( $icon = $this->get_icon( $args['url-value'] ) ) {
			$icon_class = 'socicon socicon-' . $icon;
		}

		?><li class="social-icons-field">
			<div class="social-icons-wrap">
				<div class="social-icons-inputs"><?php
					printf( '<input class="widefat social-icons-field-url" id="%1$s" name="%2$s[]" type="text" placeholder="%3$s" value="%4$s">', $args['url-field-id'], $args['url-field-name'], esc_attr( __( 'http://', 'social-icons' ) ), esc_url( $args['url-value'] ) );
					printf( '<input class="widefat social-icons-field-label" id="%1$s" name="%2$s[]" type="text" placeholder="%3$s" value="%4$s">', $args['label-field-id'], $args['label-field-name'], esc_attr( __( 'Label', 'social-icons' ) ), esc_attr( $args['label-value'] ) );
				?></div>
			</div>
			<span class="social-icons-field-handle <?php echo $icon_class; ?>"></span>
			<a class="social-icons-field-remove" href="#">
				<span class="dashicons dashicons-no-alt"></span>
			</a>
		</li><?php
	}

	/**
	 * Returns an icon identifier for given website url.
	 * @param  $url
	 * @return string
	 */
	protected function get_icon( $url ) {
		$icon = '';

		if ( $url = strtolower( $url ) ) {
			if ( strstr( $url, 'feed' ) ) {
				$icon = 'rss';
			} elseif( strstr( $url, 'vk.com' ) ) {
				$icon = 'vkontakte';
			} elseif ( strstr( $url, 'last.fm' ) ) {
				$icon = 'lastfm';
			} elseif ( strstr( $url, 'youtu.be' ) ) {
				$icon = 'youtube';
			} elseif ( strstr( $url, 'plus.google.com' ) ) {
				$icon = 'googleplus';
			} elseif ( strstr( $url, 'feedburner.google.com' ) ) {
				$icon = 'mail';
			}

			if ( ! $icon ) {
				foreach ( $this->icons as $icon_name ) {
					if ( strstr( $url, $icon_name ) ) {
						$icon = $icon_name;
						break;
					}
				}
			}
		}

		return apply_filters( 'social_icons_field_get_icon', $icon, $url );
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

		$class_list = array();

		// Label class
		if ( $instance['show_label'] ) {
			$class_list[] = 'show-icons-label';
		}

		// Greyscale class
		if ( $instance['show_greyscale'] ) {
			$class_list[] = 'social-icons-greyscale';
		}

		// Background class
		if ( $instance['background_style'] ) {
			$class_list[] = 'icons-background-' . $instance['background_style'];
		}

		?>
		<?php if ( ! empty( $instance['description'] ) ) : ?>
			<p><?php echo $instance['description']; ?></p>
		<?php endif; ?>

		<ul class="social-icons-lists <?php echo esc_attr( implode( ' ', $class_list ) ); ?>">

			<?php foreach ( $instance['socicon_sortable'] as $title => $field ) : ?>

				<li class="social-icons-list-item">
					<a href="<?php echo esc_url( $field['url'] ); ?>" <?php echo ( $instance['open_tab'] ? 'target="_blank"' : '' ); ?> class="social-icon">
						<span class="socicon socicon-<?php echo esc_attr( $title ); ?>" style="font-size: <?php echo esc_attr( $instance['socicon_size'] ); ?>px"></span>

						<?php if ( $instance['show_label'] ) : ?>
							<span class="social-icons-list-label"><?php echo esc_html( $field['label'] ); ?></span>
						<?php endif; ?>
					</a>
				</li>

			<?php endforeach; ?>

		</ul>

		<?php

		$this->widget_end( $args );
	}
}
