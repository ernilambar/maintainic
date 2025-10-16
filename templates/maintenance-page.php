<?php
/**
 * Maintenance Page Template
 *
 * @package Maintainic
 */

use Maintainic\Setup\Option;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get options.
$site_title       = Option::get( 'site_title' );
$headline         = Option::get( 'page_headline' );
$content          = Option::get( 'page_content' );
$background_image = Option::get( 'background_image' );
$background_color = Option::get( 'background_color' );
$text_color       = Option::get( 'text_color' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html( $site_title ); ?></title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: Arial, sans-serif;
			background: <?php echo esc_attr( $background_color ); ?>;
			<?php if ( ! empty( $background_image ) ) : ?>
			background-image: url('<?php echo esc_url( $background_image ); ?>');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			<?php endif; ?>
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			color: <?php echo esc_attr( $text_color ); ?>;
		}

		.container {
			background: #fff;
			padding: 40px;
			border-radius: 4px;
			text-align: center;
			max-width: 500px;
			width: 90%;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		h1 {
			font-size: 2rem;
			font-weight: normal;
			margin-bottom: 30px;
			color: <?php echo esc_attr( $text_color ); ?>;
		}

		p {
			font-size: 1rem;
			line-height: 1.5;
			color: <?php echo esc_attr( $text_color ); ?>;
			opacity: 0.8;
			margin-bottom: 20px;
		}

		.footer {
			font-size: 0.9rem;
			color: #999;
			margin-top: 30px;
		}

		@media (max-width: 768px) {
			.container {
				padding: 30px 20px;
				margin: 20px;
			}

			h1 {
				font-size: 1.5rem;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<h1><?php echo esc_html( $headline ); ?></h1>
		<p><?php echo wp_kses_post( nl2br( $content ) ); ?></p>
	</div>
</body>
</html>
