<?php
class View1{
   function __construct(){
      echo "<p> Nueva Vista base</p>"; 
   }

   function render($nombre){
      require 'views/'.$nombre.'.php';
   }
}
?>