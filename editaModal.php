<!-- Modal edita registro -->
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editaModalLabel">Editar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actualiza.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" id="id" name="id">

                    <div class="mb-2">
                        <label for="nombre" class="form-label">Titulo:</label>
                        <input type="text" name="titulo" id="titulo" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="precio" class="form-label">Precio:</label>
                        <!--<textarea name="descripcion" id="descripcion" class="form-control form-control-sm" rows="5" required></textarea>-->
                        <input type="number" name="precio" id="precio" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="stock" class="form-label">Stock:</label>
                        <!--<textarea name="descripcion" id="descripcion" class="form-control form-control-sm" rows="5" required></textarea>-->
                        <input type="number" name="stock" id="stock" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="genero" class="form-label">Categoria:</label>
                        <select name="genero" id="genero" class="form-select  form-select-sm" required>
                            <option value="">Seleccionar...</option>
                            <?php while ($row_genero = $generos->fetch_assoc()) { ?>
                                <option value="<?php echo $row_genero["id_categoria"]; ?>"><?= $row_genero["categoria_nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <img id="img_poster" width="100" class="img-thumbnail">
                    </div>

                    <!--<div class="mb-3">
                        <label for="poster" class="form-label">Poster:</label>
                        <input type="file" name="poster" id="poster" class="form-control form-control-sm" accept="image/jpeg">
                    </div>-->

                    <div class="d-flex justify-content-end pt2">
                        <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary ms-1"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>