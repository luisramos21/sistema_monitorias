

<div class="container">
    <h2>Monitores</h2>
    <a  href="<?php echo base_url(); ?>index.php/monitores/save" class="btn btn-success">Nuevo Monitor</a>

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($data as $value) {
                ?>
                <tr>
                    <td><?php echo $value['cedula']; ?></td>
                    <td><?php echo $value['nombres']; ?></td>
                    <td><?php echo $value['apellidos']; ?></td>
                    <td><?php echo $value['celular']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                </tr>
                <?php
            }
            ?>

    </table>
</div>