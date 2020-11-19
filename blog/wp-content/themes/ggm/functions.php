<?php

/* トップバナーのコピーライト */
function fetch_copy() {
  /**
   * TwitterのRSSから取得して、もし取得できなかったら固定文から取得する。
   */
  $rss_url = "http://twitter-great-rss.herokuapp.com/feed/user?name=aonuma_moriri&url_id_hash=4aabb9cbdf72d63df551b752ac8f63181466b24c";
  $rss = file_get_contents($rss_url);
  $rss = simplexml_load_string($rss);
  
  $tweets = json_decode(json_encode($rss->channel), true);
  // var_dump($tweets["item"][0]);
  $n=0;
  foreach ($tweets["item"] as $num => $v) {
    if (preg_match("/@/",$v["description"])) {
      continue;
    } else {
      $tweet = $description."<span class='tweet-count'>Tweet count</span>".$num;
    }
  }
  $dummy = preg_match('/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/', $tweet, $matches);
  $tweet = preg_replace("/<img(.|\s)*?>/","",$tweet);
  // var_dump($tweet);
  $image = $matches[0];
  $image_tag = "<img src='".$image."' class='top-twitter-icon' id='top-twitter-icon'>";
  // $tweet = mb_substr($tweet,5,1);
  $tweet = "";
  
  if ($tweet) {
    return $tweet.$image_tag;
  } else {
    $copys = [
      "Don't think too much about your propensity.<br>This is because propensity is an entertainment for the wealthy and a luxury worry.",
      "Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich in seinem Bett zu einem ungeheuren Ungeziefer verwandelt.",
      "Beware that, when fighting monsters, you yourself do not become a monster… for when you gaze long into the abyss. The abyss gazes also into you.",
    ];
    $select_num = mt_rand(0, count($copys)-1);
    return $copys[$select_num];
  }
  

  
}

/* Sidebar */
if ( function_exists('register_sidebar') ) register_sidebar();

/* icatch image */
add_theme_support('post-thumbnails');

/* Media html tag */
function image_wrap($html, $id, $caption, $title, $align, $url, $size, $alt){
  $html = <<< EOM
<a href="#" class="image-anc" data-toggle="modal" data-target="#modalid_{$id}" rel="noopener noreferrer"><img src="{$url}" alt="{$title}" class="image-link alignleft size-{$size} modalid_{$id}" width="100%"></a>
<!-- Modal setting -->
<div class="modal fade" id="modalid_{$id}" tabindex="-1" role="dialog" aria-labelledby="modalid_{$id}Label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">    
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
        <img src="{$url}" width="100%" alt="{$title}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
EOM;
  $html = preg_replace("/\n/","", $html);
  $html = preg_replace("/\s+/"," ", $html);
  $html = preg_replace("/\s+/"," ", $html);
  $html = '<div id="imageblock" class="imageblock col-sm-12 col-md-12 col-lg-6">'."\n".$html."\n".'</div>'."\n";
	return $html;
}
add_filter('image_send_to_editor','image_wrap',10,8);


/* Pagenation */
function the_pagination() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<div class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<i class="fas fa-angle-left"></i>',
    // 'next_text'    => '&rarr;',
    'next_text'    => '<i class="fas fa-angle-right"></i>',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</div>';
}

/* 抜粋の文字数調整 */
function twpp_change_excerpt_length( $length ) {
  return 400; 
}
add_filter( 'excerpt_length', 'twpp_change_excerpt_length', 999 );
/* 抜粋の[...]の変更 */
function twpp_change_excerpt_more( $more ) {
  return '......';
}
add_filter( 'excerpt_more', 'twpp_change_excerpt_more' );