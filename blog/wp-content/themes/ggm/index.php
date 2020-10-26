<?php get_template_part('inc/meta'); ?>


<body id="page_homepage" class="front_page ggm">
  <div class="ggm-wrapper ggm-blog">
  <?php get_template_part('inc/nav'); ?>

  <div class="ggm-contents"> 
    <div class="ggm-block-div">
      <div id="top-banner" class="jumbotron">
      <div id="device" v-bind:class="[[width_type]]">
      <img class="top-sp" src="/html/template/default/assets/img/top/ggm-top02-sp.jpg" id="top-banner-img">
      <img class="top-pc" src="/html/template/default/assets/img/top/ggm-top02-pc.jpg" id="top-banner-img">
    </div>
    <div class="ggm-top-text-block">
      <p class="">
        <?php echo fetch_copy(); ?>
      </p>
    </div>
  </div><!-- ggm-contents -->

  <div class="container" id="blog-block">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-9 col-lg-8" id="main-block">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="blog-item">
          <div class="blog-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </div>
          <div class="blog-summary">
            <?php
              $thumbnail_id = get_post_thumbnail_id();
              $eimg = wp_get_attachment_image_src( $thumbnail_id , 'small' );
              // var_dump($eimg[0]);
              // the_post_thumbnail('thumbnail');
            ?>
            <?php if ($eimg[0]) { ?>
            <div class="trim-thumbnail float-left"><img src="<?php echo $eimg[0]; ?>" class="top-thumbnali"></div>
            <?php } ?>
            <?php
            // echo get_the_excerpt();
            if (!empty(get_the_excerpt())) {
              $excerpt = preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', get_the_excerpt());
              $excerpt = str_replace('&times; Close ', '', $excerpt);
              $excerpt = trim($excerpt);
              echo $excerpt. " "."<a href='".get_the_permalink()."'>read more.</a>";
            }
            ?>
            <div class="blog-meta">
              <p class="datetime text-right">2020-08-25 09:00</p>
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
    

<!-- 
        <div class="blog-item">
          <div class="blog-title">
          Google Cloud SDK をMac OS X環境にインストール (gcloudコマンド）
          </div>
          <div class="blog-summary">
            texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            <div class="blog-meta">
              <p class="datetime text-right">2020-08-25 09:00</p>
              <p class="catefory">
                <a href="#">foo</a>
                <a href="#">bar</a>
                <a href="#">baz</a>
              </p>
              <p class="tags">
                <a href="#">foo</a>
                <a href="#">bar</a>
                <a href="#">baz</a>
              </p>
            </div>
          </div>
        </div> -->

        <div>
        <?php if( function_exists("the_pagination") ) the_pagination(); ?>
        </div>
      </div><!-- col main -->

      <div class="col-xs-12 col-sm-4 col-md-3 col-lg-4" id="side-block">
        <!--sidebar-->
        <?php get_template_part('sidebar'); ?>
        <!--sidebar-->
        <?php get_template_part('inc/admintools'); ?>

        <!-- <ul>
          <li><a href="">foobar</a></li>
          <li><a href="">foobar</a></li>
          <li><a href="">foobar</a></li>
          <li><a href="">foobar</a></li>
          <li><a href="">foobar</a></li>
        </ul> -->
      </div><!-- col sub -->
    </div><!-- row -->
  </div><!-- blog-block -->



  <?php get_template_part('inc/products'); ?>  

  </div><!-- ggm-wrapper -->

  <?php get_template_part('inc/footer'); ?>   
            
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