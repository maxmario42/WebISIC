<?php
class Controller1{
  
   function __construct(){
    echo "<p> Nuevo controlador Base</p>";
    $this->view= new View1(); //creacion de una nuev vista cada vez que ejecuta un nuevo controlador
   }
}
?>