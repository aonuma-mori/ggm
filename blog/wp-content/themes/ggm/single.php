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
      <div class="col-sm-8 col-md-9 col-lg-8" id="main-block">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="blog-item">
          <h1 class="blog-title">
            <?php the_title(); ?>
          </h1>
          <div class="blog-text">
            <?php the_content(); ?>
            <br clear="both">
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
    
      </div><!-- col main -->
        
      <div class="col-sm-4 col-md-3 col-lg-4" id="side-block">
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