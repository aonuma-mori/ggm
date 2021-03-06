<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eccube\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class TopController extends AbstractController
{
  /**
   * @Route("/", name="homepage")
   * @Template("index.twig")
   */
  public function index()
  {
    /**
     * 商品リンクの出し分け　トップ3
     */
    if (env("APP_ENV") == "prod") {
      $product_links = [
        "/products/list?category_id=8",
        "/products/list?category_id=9",
        "/products/list?category_id=10",
      ];
    } else {
      $product_links = [
        "/products/list?category_id=10",
        "/products/list?category_id=7",
        "/products/list?category_id=11",
      ];
    }

    /**
     * TwitterのRSSを読み込む
     * 
     * twitter RSS service: http://twitter-great-rss.herokuapp.com/
     * url: http://twitter-great-rss.herokuapp.com/feed/user?name=GGM06605451&url_id_hash=4aabb9cbdf72d63df551b752ac8f63181466b24c
     */
    $rss_url = "http://twitter-great-rss.herokuapp.com/feed/user?name=GGM06605451&url_id_hash=4aabb9cbdf72d63df551b752ac8f63181466b24c";
    $rss = file_get_contents($rss_url);
    $rss = simplexml_load_string($rss);
    foreach ($rss->channel as $v) {
      $tweet = $v->item->description;
    }
    $dummy = preg_match('/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/', $tweet, $matches);
    $tweet = preg_replace("/<img(.|\s)*?>/","",$tweet);
    $tweet = preg_replace("/<a.*?<\/a>/","",$tweet);
    $image = $matches[0];

    /**
     * Wordpress RSS
     * 
     * url: https://ggm-do.com/blog/feed/
     */
    if (env("APP_ENV") == "dev") {
      $wp_rss_url = "https://ggm-do.com/blog/feed/";
      // $wp_rss_url = "http://127.0.0.1:9100/blog/feed/";
    } else {
      $wp_rss_url = "https://ggm-do.com/blog/feed/";
    }

    if ($this->httpstatus($wp_rss_url) == "200") {
      $wp_rss = file_get_contents($wp_rss_url);
      $wp_rss = simplexml_load_string($wp_rss);
      // $wp_blog_array = json_decode(json_encode($wp_rss->channel->item), true);
      $wp_rss_object = $wp_rss->channel->item;
    } else {
      $wp_rss_object = array();
    }
    // dump($wp_rss->channel->item);



    log_debug('log_debug:GGMログメッセージ');
    // log_alert('log_alert:GGMログメッセージ');
    // log_critical('log_critical:GGMログメッセージ');
    // log_error('log_error:GGMログメッセージ');
    // log_warning('log_warning:GGMログメッセージ');
    // log_notice('log_warning:GGMログメッセージ');
    // log_info('log_info:GGMログメッセージ');
    // log_debug('log_debug:GGMログメッセージ');

    return [
      'wp' => $wp_rss_object,
      'tweet' => $tweet,
      'image_url' => $image,
      'product_links' => $product_links,
    ]; 
  }

  
  /**
   * RSSなどのHTTPステータスを確認する
   * 
   * 200: true
   */
  public function httpstatus($url) {

    $curl = "curl -LI ".$url." -o /dev/null -w '%{http_code}\n' -s";
    $httpstatus = exec($curl, $error);
    // logging
    // log_info('GGMログメッセージ');

    // var_dump($httpstatus);
    return $httpstatus;
  }
}



