<?php get_template_part('inc/meta'); ?>

<body id="page_homepage" class="front_page ggm">
  <div class="ggm-wrapper ggm-blog">
  <?php get_template_part('inc/nav'); ?>

  <!-- <div class="ggm-contents"> 
    <div class="ggm-block-div">
      <div id="top-banner" class="jumbotron">
      <div id="device" v-bind:class="[[width_type]]">
      <img class="top-sp" src="/html/template/default/assets/img/top/ggm-top02-sp.jpg" id="top-banner-img">
      <img class="top-pc" src="/html/template/default/assets/img/top/ggm-top02-pc.jpg" id="top-banner-img">
    </div>
    <div class="ggm-top-text-block">
    <p class="">
      Adventure is not outside man; it is within.
    </p>
    </div>
  </div> -->
  <!-- ggm-contents -->

  <div class="container" id="blog-block">
    <div class="row">
    <?php /* category */
    $cat = get_the_category();
    $cat_link = get_category_link($cat[0]->cat_ID);
    ?>
    <div class="col-sm-8 col-md-9 col-lg-8" id="category-block">
      <div class="ggm-article-caption">Category <strong>"<?php echo $cat[0]->name; ?>"</strong>を表示しています。</div>
      
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="blog-item">
          <h1 class="blog-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h1>
          <p class="datetime text-right"><?php the_time('Y年m月d日'); ?></p>
          <div class="blog-text">
            <?php //the_content(); ?>
            <?php
              $description = $post->post_content;
              $description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$description);
              $description = wp_strip_all_tags($description);
              $description = preg_replace('/\[.*\]/','',$description);
              $description = mb_strimwidth($description,0,220,"...");
              echo $description;
            ?>
            <br clear="both">
            <div class="blog-meta">
              
                <?php the_category(); ?>
              <p class="tags">
              <?php the_tags("","",""); ?>
              </p>
            </div>
          </div>      

        </div><!-- blog-item -->
        <?php endwhile; else: ?>
          <div class="blog-item">記事がありません。</div>
        <?php endif; ?>
    
      </div><!-- col main -->
        
      <div class="col-sm-4 col-md-3 col-lg-4" id="side-block">
        <!--sidebar-->
        <?php get_template_part('sidebar'); ?>
        <!--sidebar-->
        <?php get_template_part('inc/admintools'); ?>
      </div><!-- col sub -->

    </div><!-- row -->
  </div><!-- blog-block -->



<div class="ec-layoutRole__mainBottom">
  <div class="ggm-ec-role ec-role">
    <div class="container eyecatch-block">
      <div class="row">
        <div class="col-sm-4 eyecatch-block eyecatch-block-01">
          <a href="#">
            <img src="/html/template/default/assets/img/top/eyecatch-01.jpg" class="eyecatch-img eyecatch-img-01">
          </a>
          <div class="text-center eyecatch-title eyecatch-title01">鞣し生成り麻縄</div>
          <div class="eyecatch-summary">麻縄本来の色と艶、強度を備えています。手入れの仕方次第で何年も品質を保持できます。<br>
            <a href="#">商品を見る</a>
          </div>
        </div>
        <div class="col-sm-4 eyecatch-block eyecatch-block-02">
          <a href="#">
            <img src="/html/template/default/assets/img/top/eyecatch-02.jpg" class="eyecatch-img eyecatch-img-02">
          </a>
          <div class="text-center eyecatch-title eyecatch-title02">素麻縄</div>
          <div class="eyecatch-summary">生の麻縄そのままの状態です。お好みの油で鞣してお使いください。<br>
            <a href="#">商品を見る</a></div>
          </div>
          <div class="col-sm-4 eyecatch-block eyecatch-block-03">
            <a href="#">
              <img src="/html/template/default/assets/img/top/eyecatch-03.jpg" class="eyecatch-img eyecatch-img-03">
            </a>
            <div class="text-center eyecatch-title eyecatch-title03">染麻縄</div>
            <div class="eyecatch-summary">色がついていてかっこいい。カラーSAMPLEから選べます。オリジナル色もできます。<br>
              <a href="#">商品を見る</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php get_template_part('inc/footer'); ?>   
  </div><!-- ggm-wrapper -->


            
  <!-- Topへ戻る -->
  <div
    id="ggm-pagetop-arrow"
    class="ec-blockTopBtn pagetop"
    style="
      width:50px;
      height:50px;
      font-size:28px;
      padding-top: 4px;
      border-radius: 50%;
      background: #666;
    ">
    <i class="fas fa-arrow-up"></i>
  </div>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

  <script>
    var eccube_lang = {
        "common.delete_confirm":"削除してもよろしいですか?"
    }
  </script>  <script src="/html/template/default/assets/js/function.js"></script>
  <script src="/html/template/default/assets/js/eccube.js"></script>
    <script>
  // top-banner js
  </script>
  <script src="/html/user_data/assets/js/customize.js"></script>
  <script src="/html/template/default/assets/js/ggm.js"></script>
</body>
</html>
