<?php
/*
Plugin Name: Facebook Plugin Page
Description: The Page plugin lets you easily embed and promote any Facebook Page on your website. Just like on Facebook, your visitors can like and share the Page without leaving your site. [ Plugin Trang cho phép bạn dễ dàng nhúng và quảng cáo bất kỳ Trang Facebook nào trên trang web của bạn. Giống như trên Facebook, khách truy cập có thể thích và chia sẻ Trang mà không cần rời khỏi trang web của bạn. ]
Author: Quach Quang Ngoc
Version: 2.8
Author URI: http://dev.sps.vn/
*/

if ( ! defined( 'WPINC' ) ) {
  die;
}
define( 'FBP_URL', plugin_dir_url(__FILE__) );
define( 'FBP_DIR', plugin_dir_path(__FILE__) );

/**
*
*/
class Facebook_Plugin_Page {

	private static $instance = null;

	private function __construct() {
		$this->includes();

		add_action( 'widgets_init', array($this, 'register_widgets') );
		add_action( 'wp_footer', array($this, 'faebook_sdk_load') );
	}

	function faebook_sdk_load() {
		?>
    <!-- Plugin: Facebook Plugin Page -->
		<div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- /Plugin: Facebook Plugin Page -->
		<?php
	}

	static function register_widgets() {
		register_widget( 'Facebook_Plugin_Page_Widget' );
	}

	function includes() {
		include_once FBP_DIR . 'class.fbpp-widget.php';
	}

	public static function get_instance() {
		if(empty(self::$instance))
			self::$instance = new self();
		return self::$instance;
	}
}

return Facebook_Plugin_Page::get_instance();

