<?php

/**
 * CRUD modal en PHP y MySQL
 * 
 * Este archivo muestra el listado de registros y las opciones para agregar,
 * editar y eliminar registros desde ventanas modal de Bootstrap
 * @author MRoblesDev
 * @version 1.0
 * https://github.com/mroblesdev
 * 
 */

session_start();

require 'config/database.php';

$sqlPeliculas = "SELECT p.id, p.titulo, p.precio, p.stock, p.img_url, cp.categoria_nombre AS categoria 
FROM productos p JOIN categoria_productos cp ON p.categoria = cp.id_categoria";
$peliculas = $conn->query($sqlPeliculas);

$dir = "posters/";

?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <div class="container py-3">

        <h2 class="text-center">Productos</h2>

        <hr>

        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th width="45%">Precio</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <!-- <th>Imagen</th> -->
                    <th>Acciónes</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $peliculas->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['titulo']; ?></td>
                        <td><?= $row['precio']; ?></td>
                        <td><?= $row['stock']; ?></td>
                        <td><?= $row['categoria']; ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row['id']; ?>"><i class="fa-solid fa-trash"></i></i> Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <p class="text-center">Desarrollado por <a href="#">Olger Quispe</a></p>
        </div>
    </footer>

    <?php
    $sqlGenero = "SELECT id_categoria, categoria_nombre FROM categoria_productos";
    $generos = $conn->query($sqlGenero);
    ?>

    <?php include 'nuevoModal.php'; ?>

    <?php $generos->data_seek(0); ?>

    <?php include 'editaModal.php'; ?>
    <?php include 'eliminaModal.php'; ?>
    
    <script>
        let nuevoModal = document.getElementById('nuevoModal')
        let editaModal = document.getElementById('editaModal')
        let eliminaModal = document.getElementById('eliminaModal')

        nuevoModal.addEventListener('shown.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre').focus()
        })

        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre').value = ""
            nuevoModal.querySelector('.modal-body #descripcion').value = ""
            nuevoModal.querySelector('.modal-body #genero').value = ""
            nuevoModal.querySelector('.modal-body #poster').value = ""
        })

        editaModal.addEventListener('hide.bs.modal', event => {
            editaModal.querySelector('.modal-body #titulo').value = ""
            editaModal.querySelector('.modal-body #precio').value = ""
            editaModal.querySelector('.modal-body #stock').value = ""
            editaModal.querySelector('.modal-body #genero').value = ""
            //editaModal.querySelector('.modal-body #img_poster').value = ""
            //editaModal.querySelector('.modal-body #poster').value = ""
        })

        editaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let input = editaModal.querySelector('.modal-body #id')
            let inputId = editaModal.querySelector('.modal-body #titulo')
            let inputNombre = editaModal.querySelector('.modal-body #precio')
            let inputDescripcion = editaModal.querySelector('.modal-body #stock')
            let inputGenero = editaModal.querySelector('.modal-body #genero')
            //let poster = editaModal.querySelector('.modal-body #img_poster')

            let url = "getPelicula.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    input.value = data.id
                    inputId.value = data.titulo
                    inputNombre.value = data.precio
                    inputDescripcion.value = data.stock
                    inputGenero.value = data.categoria
                    //poster.src = '<?= $dir ?>' + data.id + '.jpg'

                }).catch(err => console.log(err))

        })

        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })
    </script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>