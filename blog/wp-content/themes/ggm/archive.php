<?php get_template_part('inc/meta'); ?>
<?php get_template_part('inc/nav'); ?>

<?php
if (is_year()) {
  $date_name = get_query_var('year').'年';
} elseif (is_month()) {
  $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月';
}else{
  $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月'.get_query_var('day').'日';
}
?>

<ol class="breadcrumb mb10 breadcrumb-101 pl10">
  <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
  <li><?php echo $date_name; ?></li>
</ol>

<div class="container mt70">
  <div class="row">
    <div class="col-sm-12 col-md-9">

      <div class="mb30 fs14 article-caption">Archive <strong>"<?php echo $date_name; ?>"</strong>を表示しています。</div>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="article-contents mb30">
          <div class="fs18 index-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
          <div class="fs11 text-right mr15"><?php the_time('Y.n.j D'); ?></div>
          <div class="fs13 wp-contents">
            <!-- icatch image -->
            <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bland-icon.png" class="float-left" style="margin:0 15px 0 0; width: 45px;"> -->

            <?php
            $thumbnail_id = get_post_thumbnail_id();
            $eimg = wp_get_attachment_image_src( $thumbnail_id , 'small' );
            // var_dump($eimg[0]);
            // the_post_thumbnail('thumbnail');
            ?>
            <?php if ($eimg[0]) { ?>
            <div class="trim-thumbnail float-left"><img src="<?php echo $eimg[0]; ?>" class="top-thumbnali"></div>
            <?php } ?>

            <?php if (!empty(get_the_excerpt())) {
                $excerpt = preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', get_the_excerpt());
                echo $excerpt;
            } ?>

          </div>
          <div class="top-post-meta">
            <div class="top-category"><?php the_category(); ?></div>
            <div class="top-tags"><?php the_tags("<span class='tag'>","","</span>"); ?></div>
          </div>

        </div>
        <?php endwhile; else: ?>
            <div>記事がありません。</div>
        <?php endif; ?>

        <?php if( function_exists("the_pagination") ) the_pagination(); ?>
    </div>




    <div class="col-md-3">
      <?php get_template_part('sidebar'); ?>
    </div>
  </div>
</div>


<?php get_template_part('inc/footer'); ?>
