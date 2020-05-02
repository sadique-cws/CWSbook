<?php 

$connect = mysqli_connect('localhost','root','','cwsbook') or die("db error");


//for session
session_start();


function redirect($page){
    echo "<script>window.open('$page.php','_self')</script>";
}


//insert function
function insertData($table,$fields){
    global $connect;
    
    $col = implode(",",array_keys($fields));
    $row = implode("','",array_values($fields));
    
    
    $query = mysqli_query($connect,"INSERT INTO $table($col) VALUE ('$row')");
    
    
    return ($query)?true:false;
}

//Count data
function countData($table,$cond){
    global  $connect;
    
    $query = mysqli_query($connect,"SELECT * FROM $table where $cond");
    $count = mysqli_num_rows($query);
    
    return $count;
}


//retrive data
function callingData($table,$cond=NULL,$single=false){
    $array = array();
    global $connect;
    if($cond==NULL){
        $query = mysqli_query($connect,"SELECT * FROM $table");
    }
    else{
        $query = mysqli_query($connect,"SELECT * FROM $table $cond");
    }
    
    if($single==false){
        while($row = mysqli_fetch_array($query)){
            $array[] = $row;
        }
    }
    elseif($single==true){
        $array = mysqli_fetch_array($query);
    }
    return $array;
}

//retrive join data
function callingJoinData($table1,$table2,$cond=NULL,$single=false){
    $array = array();
    global $connect;
    if($cond==NULL){
        $query = mysqli_query($connect,"SELECT * FROM $table1 $table2");
    }
    else{
        $query = mysqli_query($connect,"SELECT * FROM $table1 $table2 $cond");
    }
    
    if($single==false){
        while($row = mysqli_fetch_array($query)){
            $array[] = $row;
        }
    }
    elseif($single==true){
        $array = mysqli_fetch_array($query);
    }
    return $array;
}



?>