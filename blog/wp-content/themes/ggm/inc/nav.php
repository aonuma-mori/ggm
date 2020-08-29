  <div class="ggm-header-bar"></div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
      <img src="/html/template/default/assets/img/favicons/icon-32x32.png" width="30" height="30" class="d-inline-block align-top" alt="">
      GGM
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/">Shop <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/blog/#">
            Blog
          </a>
        </li>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/blog/#">
            Archives
          </a>
        </li>
        <li class="nav-item dropdown active">
          <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">Pages</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="dropdown-menu">
            <a class="dropdown-item" href="/blog/#">Blog top</a>
            <a class="dropdown-item" href="/blog/#">Gallery</a>
            <a class="dropdown-item" href="/blog/#">Link</a>
            <a class="dropdown-item" href="/blog/#">Profile</a>
            <a class="dropdown-item" href="/blog/#">About us</a>
          </div>
        </li>
      </ul>
    </div>
    <!-- SPでは表示しないようにする（別の場所に移動） -->
    <form method="get" action="http://localhost:9100/blog/" class="searchform form-inline ggm-search-from" role="search" method="get" id="searchform" class="searchform" >
      <input type="text" name="s" maxlength="50" class="search-name form-control mr-sm-2 border-light" placeholder=" Blog search" />
      <button id="searchsubmit" class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    </form>

    <!-- <form role="search" method="get" id="searchform" class="searchform" action="http://localhost:9100/blog/">
      <div>
        <label class="screen-reader-text" for="s">検索:</label>
        <input type="text" value="hoge" name="s" id="s">
        <input type="submit" id="searchsubmit" value="検索">
      </div>
    </form> -->
  </nav>
