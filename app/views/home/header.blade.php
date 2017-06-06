<div class="mdl-layout__header-row">
  <span class="mdl-layout-title">Todo List</span>
  <!-- Add spacer, to align navigation to the right -->
  <div class="mdl-layout-spacer"></div>
  <!-- Navigation. We hide it in small screens. -->
  <button id="demo-menu-lower-right"
        class="mdl-button mdl-js-button mdl-button--icon">
  <i class="material-icons">more_vert</i>
</button>

<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right">
    <?php
    if (Session::has('user')) {  ?>
      <a href="deconnexion"><li class="mdl-menu__item">Deconnexion</li></a>
      <a href="profil"><li class="mdl-menu__item">Profile</li></a>
 <?php   } else { ?>
      <a href="connexion"><li class="mdl-menu__item">Connexion</li></a>
      <a href="inscription"><li class="mdl-menu__item">Inscription</li></a>
    <?php }?>
</ul>
</div>
