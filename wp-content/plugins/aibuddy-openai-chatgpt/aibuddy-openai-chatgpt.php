<?php
/**
 * Plugin Name: AiBud WP - ChatGPT, OpenAI, Content & Image Generator WordPress plugin
 * Plugin URI: https://stylemixthemes.com/aibud-wp/
 * Description: GPT WordPress plugin provides with chatbot, image & content generator, model finetuning, WooCommerce product writer, SEO optimizer, content translator and text proofreading features, etc.
 * Author: StylemixThemes
 * Author URI: https://stylemixthemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: aibuddy-openai-chatgpt
 * Version: 1.1.8
 */

require_once __DIR__ . '/vendor/autoload.php';

define( 'AI_BUDDY_VERSION', '1.1.8' );
define( 'AI_BUDDY_PATH', __DIR__ );
define( 'AI_BUDDY_FILE', __FILE__ );
define( 'AI_BUDDY_FILES_PATH', plugin_dir_url( __FILE__ ) );

$ai_buddy_plugin = new AiBuddy\Plugin( 'ai_buddy', __FILE__ );

require __DIR__ . '/includes/hooks.php';
require __DIR__ . '/includes/class-ai-buddy.php';
