<?php
  use Core\Router;
  use Core\H;
  use App\Models\Users;
  $menu = Router::getMenu('menu_acl');
  $userMenu = Router::getMenu('user_menu');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-info sticky-top">
  <!-- Brand and toggle get grouped for better mobile display -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="container">
    <a class="navbar-brand d-none d-lg-block" href="<?=PROOT?>home"><?=MENU_BRAND?></a>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse small" id="main_menu">
      <ul class="navbar-nav mr-auto">
        <?= H::buildMenuListItems($menu); ?>
      </ul>
      <ul class="navbar-nav mr-2">
        <?= H::buildMenuListItems($userMenu,"dropdown-menu-right"); ?>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div>
</nav>
