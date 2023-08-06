<!DOCTYPE html>
<html lang="en">
<head>
    <title>Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<?php require 'views/header.php' ?>
    <body>

        <div class="container">
            <br />
            <h3 align="center">REGISTRARA INVENTRARIO</h3>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Importe primero los archivos excel antes de registrar las ventas</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <span id="message"></span>
                        <form method="post" id="import_excel_form" enctype="multipart/form-data">
                            <tr>
                                <td width="25%" align="right">Selecionar un archivo Excel</td>
                                <td width="50%"><input type="file" name="import_excel" /></td>
                                <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="Cargar Ventas" /></td>
                            </tr>
                            </table>
                        </form>
                        <br/>

                    </div>
                </div>
                <div class="panel-heading">
                    <form action="<?php echo constant('URL'); ?>inventarios/registrar" method="post">
                        <div class="container">
                            <div class="row">
                                <select class="col-2" name="dia" id="">
                                    <option value="Dia">Dia</option>
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sabado">Sabado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>

                                    
                                <select class="col-2 offset-1" name="semana" id="">
                                    <option value="Semana">Semana</option>
                                    <?php                    
                                    include_once 'models/buscarsem.php';
                                    foreach($this->buscarsem as $row){
                                        $inventario = new Buscarsemanas();
                                        $inventario = $row;
                                    ?>
                                    <option value="<?php echo $inventario->sem ?>"><?php echo $inventario->sem ?></option>
                                    <?php } ?>
                                </select>
                                <input type="submit" class="col-2 offset-1" value="Registrar Ventas">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </body>
    <?php require 'views/footer.php' ?>
</html>
<script>
    $(document).ready(function(){
        $('#import_excel_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo constant('URL'); ?>inventarios/import",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    $('#import').attr('disabled', 'disabled');
                    $('#import').val('Importing...');
                },
                success:function(data){
                    $('#message').html(data);
                    $('#import_excel_form')[0].reset();
                    $('#import').attr('disabled', false);
                    $('#import').val('Import');
                }
            })
        });
    });
</script>