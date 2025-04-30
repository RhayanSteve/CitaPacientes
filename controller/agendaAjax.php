<?php
header('Content-Type: application/json');
include("../model/conexion.php");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'listar':
        $sql = "select idCita,nombrePaciente,fechaCita,
case 
when especialidad = 1 then 'Medicina General'
when especialidad = 2 then 'Pediatría'
when especialidad = 3 then 'Dermatología' else 'Sin Asignar' end especialidad
from citas_pacientes";
        $result = $conexion->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    case 'eliminar':
        $id = $_POST['id'];
        if ($id > 0) {
            $sql = $conexion->prepare("DELETE FROM citas_pacientes WHERE idCita=?");
            $sql->bind_param("i", $id);
            $sql->execute();
            echo json_encode(['mensaje' => 'Eliminado correctamente']);
            
        } else {
            echo json_encode(['error' => true, 'mensaje' => 'No se pudo eliminar la cita']);
        }
        break;

    case 'registrar':
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $especialidad = $_POST['especialidad'];
        $fechaFormateada = DateTime::createFromFormat('d/m/Y', $fecha);
        $fechaReg = $fechaFormateada->format('Y-m-d');
        
        $sql = $conexion->prepare("INSERT INTO `doc_agenda_citas`.`citas_pacientes` (`nombrePaciente`, `fechaCita`, `especialidad`) 
            VALUES (?, ?, ?)");
        $sql->bind_param("sss", $nombre, $fechaReg, $especialidad);
    
        if ($sql->execute()) {
            echo json_encode(['mensaje' => 'Cita registrada correctamente']);
        } else {
            echo json_encode(['error' => true, 'mensaje' => 'Error al Registrar']);
        }
        break;
            
           

}
