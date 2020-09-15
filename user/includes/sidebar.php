<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>



    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>


                <li>

                    <?php if(isset($_COOKIE['usertype']) ){  if($_COOKIE['usertype'] !='user'){ ?>



                    <a href="<?=$_COOKIE['usertype'] == 'client' ? 'reserver' :'events' ; ?>" class="waves-effect">
                        <i class="dripicons-clock"></i>
                        <span> <?=$_COOKIE['usertype'] == 'client' ? 'Les' :'Mes' ; ?>  disponibilités <span class="badge badge-success badge-pill float-right"></span></span>
                    </a>

                    <a href="reservations" class="waves-effect">
                        <i class="dripicons-document"></i>
                        <span> <?=$_COOKIE['usertype'] == 'client' ? 'Mes' :'Les' ; ?>  réservations<span class="badge badge-success badge-pill float-right"></span></span>
                    </a>

                    <?php if($_COOKIE['usertype'] =='client' ){ ?>
                    <a href="abonnements" class="waves-effect">
                        <i class="dripicons-briefcase"></i>
                        <span>Abonnements<span class="badge badge-success badge-pill float-right"></span></span>
                    </a>
                    <?php } if($_COOKIE['usertype'] =='admin' ){  ?>
                        <a href="users" class="waves-effect">
                            <i class="dripicons-user "></i>
                            <span>Utilisateurs<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>

                        <a href="packs" class="waves-effect">
                            <span class="fa fa-dropbox pl-1 pr-3"></span>
                            <span>Mes packs<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>
                        <a href="questions" class="waves-effect">
                            <i class="dripicons-question "></i>
                            <span>Les questions<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>
                        <a href="abonnes" class="waves-effect">
                            <i class="dripicons-user-group "></i>
                            <span>Mes abonnés<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>

                            <a href="categories" class="waves-effect">
                                <i class="dripicons-view-thumb "></i>
                                <span>Les catégories<span class="badge badge-success badge-pill float-right"></span></span>
                            </a>

                    <?php }} if($_COOKIE['usertype'] =='user' ){

                    $req2=$bdd->prepare('select * from user_acl where iduser =?');
                    $req2->execute(array(intval($_COOKIE['iduser'])));
                    while($ar2 = $req2->fetch()){


                        if($ar2['permission']=='disponibilites'){
                            echo '  <a href="events" class="waves-effect"> <i class="dripicons-clock"></i>
                        <span> Mes disponibilités <span class="badge badge-success badge-pill float-right"></span></span>
                        </a>';
                        }

                        if($ar2['permission']=='reservations'){
                            echo ' <a href="reservations" class="waves-effect">
                            <i class="dripicons-document"></i>
                            <span> Les réservations<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>';
                        }

                        if($ar2['permission']=='packs'){
                            echo ' <a href="packs" class="waves-effect">
                            <span class="fa fa-dropbox pl-1 pr-3"></span>
                            <span>Mes packs<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>';

                        }

                        if($ar2['permission']=='questions'){
                            echo '<a href="questions" class="waves-effect">
                            <i class="dripicons-question "></i>
                            <span>Les questions<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>';
                        }

                        if($ar2['permission']=='abonnes'){
                            echo ' <a href="abonnes" class="waves-effect">
                            <i class="dripicons-user-group "></i>
                            <span>Mes abonnés<span class="badge badge-success badge-pill float-right"></span></span>
                        </a>  ';
                        }
                    }  ?>

                </li>

                <?php } } ?>

            </ul>


        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>