<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
	<div id="container-noticias" class="container container-noticias" style="margin-bottom:45px;">
		<div class="row">
    		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">	
    		<?php if ( have_posts() ) : ?>
    			<?php while (have_posts()) : the_post(); ?>
    			<article>
    					<h2 class="title"><?php the_title(); ?></h2>
    					<?php the_content(); ?>
    			</article>
    			<?php endwhile; ?>   
    			<div class="pagination d-flex justify-content-between">
    			  <p class="nav-previous"><?php previous_post_link( '%link', __( '<i class="fa fa-angle-left"></i> Anterior', 'twentyeleven' ) ); ?></p>
    			  <p  class="nav-next"><?php next_post_link( '%link', __( 'Siguiente <i class="fa fa-angle-right"></i>', 'twentyeleven' ) ); ?></p>
    			</div>
    		<?php endif; ?>
    		
    		</div>
    		<sidebar class="col-xs-12 col-sm-12 col-md-4">
	            <div class="container_categories">
	                <h2>Categorías</h2>
	                <?php $cats = get_categories(); ?>
					<?php foreach($cats as $cat) : ?>
						<?php $id = $cat->cat_ID; $category_link = get_category_link( $id ); ?>
						<div id="category-<?php echo $id ?>" class="child-category">
							<a class="d-flex" href="<?php echo esc_url( $category_link ); ?>">
								<h5 class="title_category"><?php echo $cat->name; ?></h5>
								<span class="count"><?php echo $cat->category_count; ?></span>
							</a>
						</div>
					<?php endforeach; ?>
	            </div>
			</sidebar>
    		</div>	
    		<?php wp_reset_query(); ?>
		</div>
</div>
<?php get_footer(); ?>