<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Truly_Minimal
 */

$format = get_post_format();
$supported_formats = get_theme_support( 'post-formats' );

if ( ! in_array( $format, $supported_formats[0] ) )
    $format = 'single';

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', $format ); ?>

			<?php truly_minimal_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>