<?php
session_start();
require 'db.php';

if(sizeof($_POST) > 0){
    if(isset($_POST['id'])){
        $updateText->execute(array(':id' => $_POST['id'], ':text' => $_POST['text']));
    }else{
        $insert->execute(array(':text' => $_POST['text']));
    }
}

if(sizeof($_GET) > 0){
    if(isset($_GET['delete'])){
        $delete->execute(array(':id' => $_GET['delete']));
    }
    elseif(isset($_GET['status']) && isset($_GET['id'])){
        $updateDone->execute(array(':id' => $_GET['id'], ':status' => $_GET['status']));
    }

    if(isset($_GET['show'])){
        if($_GET['show'] === 'todo' || $_GET['show'] === 'done' || $_GET['show'] === 'all'){
            $_SESSION['show'] = $_GET['show'];
        }
    }
}

if(isset($_SESSION['show']) && $_SESSION['show'] === 'done'){
    $stms = $db->prepare('SELECT * from todo WHERE done = 1');
    $stms->execute();
}elseif(isset($_SESSION['show']) && $_SESSION['show'] === 'todo'){
    $stms = $db->prepare('SELECT * from todo WHERE done = 0');
    $stms->execute(); 
}else{
    $stms = $db->prepare('SELECT * from todo');
    $stms->execute(); 
}


require 'form.php'

?>