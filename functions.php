<?php
include 'database.php';


function get_usuario_seguro($id,$nombre)
{
    $pdo = Database::connect();
    $status=[];
    $sql = "SELECT * FROM Prueba1 where ID_e = '{$id}' and Nombre_Completo = '{$nombre}'";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        
        if($row=$query->fetch(PDO::FETCH_ASSOC)){
            $status['message'] = "Usuario valido";
        }else{
            $status['message'] = "Usuario invalido";
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    Database::disconnect();
    return $status;
}

function get_all_usuario_seguro()
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM Prueba1";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        $seguro=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
          $item=array(
              "ID_e"=>$row['ID_e'],
              "Nombre_Completo"=>$row['Nombre_Completo'],
              "Seguridad_Social"=>$row['Seguridad_Social'],
          );
          array_push($seguro,$item);
        }
        $all_seguros_info =  $seguro;
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    Database::disconnect();
    return $all_seguros_info;
}

function get_un_seguro_info($id)
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM Prueba1 where ID_e = {$id} ";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();

        $seguro=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
          $item=array(
              "ID_e"=>$row['ID_e'],
              "Nombre_Completo"=>$row['Nombre_Completo'],
              "Seguridad_Social"=>$row['Seguridad_Social'],
          );
          array_push($seguro,$item);
        }
        $seguro_info = $seguro;
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    Database::disconnect();
    return $seguro_info;
}




function update_seguro_info($id,$nombre,$seguro)
{
    $pdo = Database::connect();
    $sql = "UPDATE Prueba1 SET Nombre_Completo = '{$nombre}', Seguridad_Social = '{$seguro}' where ID_e = '{$id}'";
    $status = [];

    try {

        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Dato actualizado";
        }
        else{
            $status['message'] = "Dato no actualizado";
        }

    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }

    Database::disconnect();
    return $status;
}


function add_seguro_info($id,$nombre,$seguro)
{
    $pdo = Database::connect();
    $sql = "INSERT INTO Prueba1(`ID_e`,`Nombre_Completo`,`Seguridad_Social`) VALUES('{$id}', '{$nombre}','{$seguro}')";
    $status = [];
    
    try {
        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Seguro ingresado";
        }
        else{
            $status['message'] = "Seguro no ingresado";
        }
    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }
    Database::disconnect();
    return $status;
}

function delete_seguro_info($id)
{
    $pdo = Database::connect();
    $sql ="DELETE FROM Prueba1 where ID_e = '{$id}'";
    $status = [];

    try {

        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Dato eliminado";
        }
        else{
            $status['message'] = "Dato no ha sido eliminado";
        }

    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }

    Database::disconnect();
    return $status;
}