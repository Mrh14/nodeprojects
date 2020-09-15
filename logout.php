<?php


if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])){
    setcookie('email',$_COOKIE['email'],time() - 1555200 , '/');
    setcookie('pass',$_COOKIE['pass'],time() -  1555200, '/' );
    setcookie('usertype',$_COOKIE['usertype'],time() -  1555200, '/' );setcookie('iduser',$_COOKIE['iduser'],time() -  1555200, '/' );

    header('location: login');
}

else{

    header('location: ./');
}




