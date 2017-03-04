<?php
class Facebook_Plugin_Page_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'fbpp_widget',
			'description' => 'Facebook Plugin Page Widget',
		);
		parent::__construct( 'fbpp_widget', 'Facebook Plugin Page', $widget_ops );

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		//debug($args);
		// outputs the content of the widget
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );

    $page_url = !empty( $instance['page_url'] ) ? esc_url($instance['page_url']) : '' ;


    $tab = !empty($instance['tab']) ? sanitize_key($instance['tab']) : '';
    $width = !empty($instance['width']) ? absint($instance['width']) : '340';
    $height = !empty($instance['height']) ? sanitize_text_field($instance['height']) : '500';
    $small_header = !empty($instance['small_header']) ? sanitize_key($instance['small_header']) : 'false';
    $hide_cover = !empty($instance['hide_cover']) ? sanitize_key($instance['hide_cover']) : 'false';
    $adapt_container_width = !empty($instance['adapt_container_width']) ? sanitize_key($instance['adapt_container_width']) : 'true';
    $show_facepile = !empty($instance['show_facepile']) ? sanitize_key($instance['show_facepile']) : 'true';


		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo '<div class="fb-page" data-href="'.$page_url.'" data-tabs="'.$tab.'" data-small-header="'.$small_header.'" data-adapt-container-width="'.$adapt_container_width.'" data-width="'.$width.'" data-height="'.$height.'" data-hide-cover="'.$hide_cover.'" data-show-facepile="'.$show_facepile.'"><div class="fb-xfbml-parse-ignore"><blockquote cite="'.$page_url.'"><a href="'.$page_url.'">'.esc_html($page_url).'</a></blockquote></div></div>';

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$taxs = get_taxonomies(array('public'=>true), OBJECT);
		//debug($instance);
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $page_url = !empty($instance['page_url']) ? esc_url($instance['page_url']) : 'https://www.facebook.com/www.sps.vn/';
		$tab = !empty($instance['tab']) ? sanitize_key($instance['tab']) : '';
    $width = !empty($instance['width']) ? absint($instance['width']) : '340';
    $height = !empty($instance['height']) ? sanitize_text_field($instance['height']) : '';
    $small_header = !empty($instance['small_header']) ? sanitize_key($instance['small_header']) : 'false';
    $hide_cover = !empty($instance['hide_cover']) ? sanitize_key($instance['hide_cover']) : 'false';
    $adpt_container_width = !empty($instance['adpt_container_width']) ? sanitize_key($instance['adpt_container_width']) : 'true';
		$show_facepile = !empty($instance['show_facepile']) ? sanitize_key($instance['show_facepile']) : 'true';

		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('page_url'); ?>">URL trang</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" type="text" value="<?php echo esc_attr( $page_url ); ?>">
		</p>

    <p>
    <label for="<?php echo $this->get_field_id('tab'); ?>">Tab</label>
    <select class="widefat" id="<?php echo $this->get_field_id( 'tab' ); ?>" name="<?php echo $this->get_field_name( 'tab' ); ?>">
      <option value="" <?php selected( $tab, "", true ); ?>>&nbsp;</option>
      <option value="timeline" <?php selected( $tab, "timeline", true ); ?>>Timeline</option>
      <option value="events" <?php selected( $tab, "events", true ); ?>>Events</option>
      <option value="messages" <?php selected( $tab, "messages", true ); ?>>Messages</option>
    </select>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('width'); ?>">Chiều rộng</label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('height'); ?>">Chiều cao</label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('small_header'); ?>">Sử dụng tiêu đề nhỏ</label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'small_header' ); ?>" name="<?php echo $this->get_field_name( 'small_header' ); ?>" type="checkbox" value="true" <?php checked( $small_header, 'true', true ); ?>>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('hide_cover'); ?>">Ẩn ảnh bìa</label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'hide_cover' ); ?>" name="<?php echo $this->get_field_name( 'hide_cover' ); ?>" type="checkbox" value="true" <?php checked( $hide_cover, 'true', true ); ?>>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('adpt_container_width'); ?>">Phù hợp với chiều rộng vùng chứa plugin</label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adpt_container_width' ); ?>" name="<?php echo $this->get_field_name( 'adpt_container_width' ); ?>" type="checkbox" value="true" <?php checked( $adpt_container_width, 'true', true ); ?>>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('show_facepile'); ?>">Hiển thị khuôn mặt của bạn bè</label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'show_facepile' ); ?>" name="<?php echo $this->get_field_name( 'show_facepile' ); ?>" type="checkbox" value="true" <?php checked( $show_facepile, 'true', true ); ?>>
    </p>


		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['page_url'] = esc_url($new_instance['page_url']);

    $instance['tab'] = ( ! empty( $new_instance['tab'] ) ) ? sanitize_key( $new_instance['tab'] ) : '';
    $instance['width'] = ( ! empty( $new_instance['width'] ) ) ? absint( $new_instance['width'] ) : '100';
    $instance['height'] = ( ! empty( $new_instance['height'] ) ) ? absint( $new_instance['height'] ) : '500';
    $instance['small_header'] = ( ! empty( $new_instance['small_header'] ) ) ? sanitize_key( $new_instance['small_header'] ) : 'false';
    $instance['hide_cover'] = ( ! empty( $new_instance['hide_cover'] ) ) ? sanitize_key( $new_instance['hide_cover'] ) : 'false';
    $instance['adapt_container_width'] = ( ! empty( $new_instance['adapt_container_width'] ) ) ? sanitize_key( $new_instance['adapt_container_width'] ) : 'true';
    $instance['show_facepile'] = ( ! empty( $new_instance['show_facepile'] ) ) ? sanitize_key( $new_instance['show_facepile'] ) : 'true';


		return $instance;
	}
}