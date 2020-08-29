<?php

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

