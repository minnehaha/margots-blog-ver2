<?php
/**
 * @package Truly_Minimal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php truly_minimal_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
        <?php the_excerpt(); ?>
        <?php print('<a href="' . esc_url(get_permalink()).'" class="more-link">Read more...</a>'); ?>
        <?php //the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'truly_minimal' ), true ); ?>
		<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'truly_minimal' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'truly_minimal' ) );
				if ( $categories_list && truly_minimal_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'truly_minimal' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'truly_minimal' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> / </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'truly_minimal' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> / </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'truly_minimal' ), __( '1 Comment', 'truly_minimal' ), __( '% Comments', 'truly_minimal' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'truly_minimal' ), '<span class="sep"> / </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php do_action( 'truly-minimal-after-entry' ); ?>
</article><!-- #post-## -->
