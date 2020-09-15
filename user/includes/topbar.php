<div class="topbar">

    <div class="topbar-left	d-none d-lg-block">
        <div class="text-center">

            <a href="<?=$url?>" class="logo text-light ">
                <img src="assets/icons/logo.png" alt="Finance" data-retina="assets/img/logo1.png" data-width="184" data-height="40" width="184" height="40">
            </a>
        </div>
    </div>

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">

            <?php if(isset($_COOKIE['email'])){ ?>


            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <a class="dropdown-item" href="<?echo $url;?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Accueil Visio</a>
                    <a class="dropdown-item" href="events"><span class="badge badge-success mt-1 float-right"></span><i class="mdi mdi-settings m-r-5 text-muted"></i> Events </a>
                    <a class="dropdown-item" href="logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Déconnexion</a>
                </div>
            </li>

<?php } else { ?>

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link arrow-none waves-effect nav-user"  href="login.php" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <button class="btn btn-outline-light">Se Connecter</button>
                    </a>

                </li>

            <?php }  ?>
        </ul>


        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>