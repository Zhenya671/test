<?php

require_once("model/File.php");

$object = new File();

if(isset($_POST['submit'])){
    $file = $_FILES['upload'];
    $object
        ->set($file)
        ->maxSize(100)
        ->type()
        ->executableType()
        ->diskFreeCheck($file)
        ->name('zalupa')
        ->directory("content");

    if ($object->upload()){
         echo 'Upload successful<br>';
         $object->showInfo();
    } else {
        echo $object->report();
    }


}