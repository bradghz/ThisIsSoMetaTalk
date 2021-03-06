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
				<span class='symbol'><a href="#">twitterbird</a></span>
				<span class='symbol'><a href="#">githubalt</a></span>
				<span class='symbol'><a href="#">wordpress</a></span>
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
					<h3>Project</h3>
				</a>
			</div>
			<div class="project-member">
				<a href="#">
					<h3>Project</h3>
				</a>
			</div>
			<div class="project-member">
				<a href="#">
					<img src="https://placeholdit.imgix.net/~text?txtsize=34&w=200&h=200" />
					<h3>Project</h3>
				</a>
			</div>
			<div class="project-member">
				<a href="#">
					<img src="https://placeholdit.imgix.net/~text?txtsize=34&w=200&h=200" />
					<h3>Project</h3>
				</a>
			</div>
		</div>
	</div>

</article><!-- #post -->
