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

    return [
      'tweet' => $tweet,
      'image_url' => $image,
    ];
  }
}



