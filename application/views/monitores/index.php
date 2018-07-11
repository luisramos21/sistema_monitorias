<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Listado de Monitores</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h2>Monitores</h2>
            <a  href="<?php echo base_url();?>index.php/monitores/save" class="btn btn-success">Nuevo</a>

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

    </body>
</html>
