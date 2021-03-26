<?php
get_header();
global $wp_query;
?>

<section class="container-videos container" style="margin-top: 100px;">
	<div class="row">
		<div class="col-xs-12">
			<h1>
				ARTICULOS O PÁGINAS ENCONTRADAS
			</h1>
			<div class="col-xs-12 col-md-4 col-md-offset-4">
				<form id="searchform" class="searchvideos" action="<?php bloginfo('url'); ?>/" method="get" role="search">
					<div class="form-group has-feedback has-search">
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
    					<input class="form-control" type="text" name="s" placeholder="Buscar"/>
					</div>
					<input type="hidden" name="post_type" value="videos" />
					<input class="inlineSubmit hidden" id="searchsubmit" type="submit" alt="Search" value="Buscar" />
				</form>
			</div>
		</div>	
		<div class="col-xs-12">
			<h2 class="search-title col-sx-12" style="margin-bottom:35px;margin-top:15px"> 
			<?php echo $wp_query->found_posts; ?>
			<?php _e( ' resultados encontrados para', 'locale' ); ?>: "<?php the_search_query(); ?>"</h2>
			<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) { the_post(); ?>
			<div class="row">
				<div class="col-xs-12">
					<?php the_content(); ?>
				</div>
			</div>
			<?php } 
			?>
			<div class="wp-pagenavi" role="navigation">
				<?php echo paginate_links(); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</section>


<?php get_footer(); ?>