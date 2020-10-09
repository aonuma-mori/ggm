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
    $image = $matches[0];

    /**
     * Wordpress RSS
     * 
     * url: https://ggm-do.com/blog/feed/
     */
    if (env("APP_ENV") == "dev") {
      $wp_rss_url = "https://ggm-do.com/blog/feed/";
      // $wp_rss_url = "http://localhost:9100/blog/feed/rss2/";
    } else {
      $wp_rss_url = "https://ggm-do.com/blog/feed/";
    }
    $wp_rss = file_get_contents($wp_rss_url);
    $wp_rss = simplexml_load_string($wp_rss);

    // foreach ($wp_rss->channel->item as $item) {
      var_dump($wp_rss->channel);

    // }

    



    return [
      'wp' => $wp_rss->channel->item,
      'tweet' => $tweet,
      'image_url' => $image,
    ];
  }
}



