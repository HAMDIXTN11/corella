<?php
/** WooCommerce main template */
if (!defined('ABSPATH')) { exit; }
get_header('shop');
	woocommerce_content();
get_footer('shop');