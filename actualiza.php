<?php
session_start();
require 'config/database.php';

// Verificar si se ha enviado un formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $stock = $conn->real_escape_string($_POST['stock']);
    $genero = $conn->real_escape_string($_POST['genero']);
    //$categoria = $conn->real_escape_string($_POST['genero']);

    $sql = "UPDATE productos SET titulo = '$titulo', precio = '$precio', stock = '$stock', categoria = $genero  WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['msg'] = "Producto actualizado exitosamente, $id, $titulo, $precio, $stock, $categoria";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error al actualizar el producto: " . $conn->error;
        $_SESSION['color'] = "danger";
    }

    // Redirige a la página de inicio (index.php)
    header('Location: index.php');
    exit;
} else {
    echo "Acceso denegado";
}
?>
