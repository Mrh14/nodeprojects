<?php


 function requis($cooki,$non,$oui){

    if($cooki == 'oui' ){
        if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])  and isset($_COOKIE['usertype']))
        {
           return exit("<script type=\"text/javascript\">window.location.replace(\"" . $oui ."\");</script>");

        }

        else if(!isset($_COOKIE['email']) and !isset($_COOKIE['pass']) and !isset($_COOKIE['usertype']))
        {
            return true;

        }
    }
    else if($cooki == 'non' ){
        if(!isset($_COOKIE['email']) and !isset($_COOKIE['pass']) and !isset($_COOKIE['usertype']))
        {
            return exit("<script type=\"text/javascript\">window.location.replace(\"" . $oui ."\");</script>");

        }

        else{
           return true;
        }
    }




}




 function requisadmin($cooki,$non,$oui){

    if($cooki == 'oui' ){
        if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])  and isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='admin')
        {
           return exit("<script type=\"text/javascript\">window.location.replace(\"" . $oui ."\");</script>");

        }

        else if(!isset($_COOKIE['email']) and !isset($_COOKIE['pass']) and !isset($_COOKIE['usertype']))
        {
            return true;

        }
    }
    else if($cooki == 'non' ){
        if(!isset($_COOKIE['email']) and !isset($_COOKIE['pass']) and !isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='admin')
        {
            return exit("<script type=\"text/javascript\">window.location.replace(\"" . $oui ."\");</script>");

        }

        else{
           return true;
        }
    }




}






function found(){

            if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])  and isset($_COOKIE['usertype']))
            {
                return $_COOKIE['usertype'];
            }else{ return '';  }


}




