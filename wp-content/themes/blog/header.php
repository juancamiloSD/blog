<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<meta name="description" content="<?php if ( is_single() ) {
	single_post_title('', true);
	} else {
		bloginfo('name'); echo " - "; bloginfo('description');
	}
	?>" />
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.png" type="image/x-icon" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- =========inicio menu header=============================================================== -->
<?php $url = get_site_url(); ?>

<div class="container">
	<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-4 pt-1">
				<a class="link-secondary" href="#">Subscribe</a>
			</div>
			<div class="col-4 text-center">
				<a class="blog-header-logo text-dark" href="/endeavor">Large</a>
			</div>
			<div class="col-4 d-flex justify-content-end align-items-center">
				<form role="search" method="get" class="search-form d-flex justify-content-end align-items-center" action="http://localhost/endeavor/">
					<input type="submit" class="visually-hidden search-submit searchInput" value="Buscar">
					<div class="box">
						<input id="OtroTema" type="search" class="search-field" placeholder="Buscar..." value="" name="s" title="Buscar:">        
					</div>
					<div onclick="search();" class="searchInput">
						<i class="fa fa-search" aria-hidden="true"></i>
					</div>											
				</form>
				<a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
			</div>
		</div>
  	</header>
	<div class="py-2 mb-2">
		<ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
			<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
					'relation' => 'AND',
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
						),
				);
				$loop = new WP_Query( $args ); 
				$categories = get_terms('category');
				if($categories){
					$count = 0;
					foreach($categories as $category){
						$term_name = $category->name;
						echo '<li class="nav-item" role="presentation"><button class="nav-link '. ($count == 0 ? 'active' : '') .'" id="'.$category->slug.'-tab" data-bs-toggle="tab" data-bs-target="#nav-'.$category->slug.'" type="button" role="tab" aria-controls="'.$category->slug.'" aria-selected="'.($count === 0 ? 'true' : 'false').'">' . $term_name . '</button></li>';
						$count++;
					}
				}
			?>
		</ul>	
		<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order' => 'ASC',
				'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
					),
			);
			$loop = new WP_Query( $args ); 
			$categories = get_terms('category'); ?>
			<div class="tab-content pt-2" id="myTabContent">
				<?php
					if($categories){
						$countContent = 0;
						foreach($categories as $category){
							$term_name = $category->name; 
							?>
							<div class="tab-pane fade <?php echo ($countContent == 0 ? 'active show' : '') ?>" id="nav-<?php echo $category->slug ?>" role="tabpanel" aria-labelledby="nav-<?php echo $category->slug ?>-tab">
								<?php 
									$countContent++; 
									$args = array(
										'cat' => $category->term_id,
										'posts_per_page' => 1, 
										'orderby' => 'title', 
										'order' => 'ASC', 
										'paged' => $paged,
									);
									$args2 = array(
										'cat' => $category->term_id,
										'posts_per_page' => -1,
										'orderby' => 'title', 
										'order' => 'ASC', 
										'paged' => $paged,
									)
								?>
								<?php 
									$wp_query = new WP_Query($args); 
									$wp_query2 = new WP_Query($args2); 
								?>
								<?php 
									$thumb_id = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
									$thumb_url = $thumb_url_array[0];								
								?>
								<div class="posts-home">
									<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
										<?php
											$wpblog_fetrdimg = wp_get_attachment_url( get_post_thumbnail_id($wp_query->ID) ); 
										?>
										<div class="p-4 p-md-5 mb-4 text-white rounded" style="background-image: url('<?php echo $wpblog_fetrdimg ?>');background-repeat: no-repeat;background-size: cover;)">
											<div class="col-md-6 px-0">
												<h1 class="display-4 fst-italic"><?php the_title(); ?></h1>
												<p class="lead my-3"><?php echo the_excerpt(); ?></p>
												<p class="lead mb-0"><a href="<?php the_permalink(); ?>" class="text-white fw-bold">Continue reading...</a></p>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
								<div class="row mb-1">
									<?php $countRelated = 0; ?>
									<?php while ($wp_query2->have_posts()) : $wp_query2->the_post(); ?>
										<?php if($countRelated != 0) : ?>
											<div class="col-md-6">
												<div class="card mb-3">
													<?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
													<div class="card-body mb-3">
														<ul class="list-unstyled d-flex mb-1 customTags">
															<?php
																$posttags = get_the_tags();
																if (!empty($posttags)) {
																	foreach($posttags as $tag) {
																		// echo $tag->name . ' '; 
																		echo '<li class="p-2"><strong class="d-inline-block text-primary"><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></strong></li>';
																	}
																}
															?>
														</ul>
														<h5 class="card-title"><?php the_title(); ?></h5>
														<small><em><b>Autor: </b><?php (the_author()); ?></em></small>
														<p class="card-text mb-1"><small class="text-muted"><?php echo get_the_date(); ?></small></p>
														<p class="card-text"><?php echo the_excerpt(); ?></p>
														<a href="<?php the_permalink(); ?>" class="stretched-link continue">Continue reading</a>
													</div>
												</div>
											</div>
										<?php endif; ?>
										<?php $countRelated++; ?>
									<?php endwhile; ?>
								</div>
								<?php wp_reset_query(); ?>
							</div>
						<?php  } 
					} ?>
			</div>
	</div>
</div>

