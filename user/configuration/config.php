<?php
  function connexion(){
      $user="fcpoxwpy_digitaldata";
      $password="FCPO2019@";
      $db=null;
      $host="mysql:dbname=fcpoxwpy_digitaldata; host=localhost;charset=utf8";


      try{
          $db=new PDO($host,$user,$password);
      }catch (PDOException $e){
          echo "<pre>";
          print_r($e);
          echo "</pre>";

      }
      return $db;
  }

  function insertdata($sql,$data=array()){

      $db= connexion();

      $query=$db->prepare($sql);
      return $query->execute($data);
  }
  function insertdatalast($sql,$data=array()){

      $db= connexion();

      $query=$db->prepare($sql);
       $query->execute($data);
      return $db->lastInsertId();


  }

  function selectalldata($sql){

      $db=connexion();

      $query=$db->prepare($sql);
      $query->execute();

      return $query->fetchAll(PDO::FETCH_OBJ);

  }

  function selectdata($sql,$data=array() ){

      $db=connexion();

      $query=$db->prepare($sql);
      $query->execute($data);

      return $query->fetchAll(PDO::FETCH_OBJ);
  }

  function selectonedata($sql){

      $db=connexion();

      $query=$db->prepare($sql);
      $query->execute();

      return $query->fetch(PDO::FETCH_ASSOC);

  }

  function countdata($sql){

      $db=connexion();

      $query=$db->prepare($sql);
      $query->execute();
      $row_count =$query->fetchColumn();
      return $row_count;
  }

  function updatedata($sql, $data=array()){

      $db=connexion();
      $query=$db->prepare($sql);
     return $query->execute($data);

  }

  function deletedata($sql){

      $db=connexion();

      $query=$db->prepare($sql);
     return $query->execute();
  }



?>
