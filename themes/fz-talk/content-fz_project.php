<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="fz-width-wrap">
		<header class="entry-header group">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="fz-team-member-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_single() ) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
			<?php endif; // is_single() ?>

			<div class="entry-meta">
				<span class='symbol'><a href="#">githubalt</a></span>
				<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
	</div>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<div class="fz-width-wrap">
		<div class="entry-additionals">
			<div class="project-lead project-member">
				<a href="#">
					<img src="https://placeholdit.imgix.net/~text?txtsize=34&w=200&h=200" />
					<h3>Person</h3>
				</a>
			</div>
			<div class="project-member">
				<a href="#">
					<img src="https://placeholdit.imgix.net/~text?txtsize=34&w=200&h=200" />
					<h3>Person</h3>
				</a>
			</div>
			<div class="project-member">
				<a href="#">
					<img src="https://placeholdit.imgix.net/~text?txtsize=34&w=200&h=200" />
					<h3>Person</h3>
				</a>
			</div>
			<div class="project-member">
				<a href="#">
					<img src="https://placeholdit.imgix.net/~text?txtsize=34&w=200&h=200" />
					<h3>Person</h3>
				</a>
			</div>
		</div>
	</div>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->