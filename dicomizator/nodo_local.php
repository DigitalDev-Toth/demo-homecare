<?php
$ip = $_SERVER['SERVER_ADDR'];
include 'connectors/db.conf.php';
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$sql = "SELECT * FROM node WHERE type='local'";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
$portDcm = $row['port'];
$institution = $row['institution'];
$aetitle = $row['aetitle'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nodo Local</title>
    <style type="text/css">
    .upper {
        text-transform: uppercase;
    }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <?php include 'navbar.html'; ?>
    <div class="container">
        <legend>
            <h1 class="text-center">Nodo Local</h1>
        </legend>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">IP:</span>
                            <input type="text" id="ip" class="form-control" value="192.168.0.175" placeholder="IP" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">AET:</span>
                            <input type="text" id="aetitle" required="required" class="form-control upper" placeholder="AETITLE">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Puerto:</span>
                            <input type="number" id="port" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="PUERTO">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Inst:</span>
                            <input type="text" id="institution" class="form-control upper" placeholder="Institución">
                        </div>
                    </div>
                    <legend class="text-center"><i style="color:#B2B1BB;" class="fa fa-heartbeat"></i>
                    </legend>
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="save" class="btn btn-large btn-block btn-success">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <label>Toth!</label>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap text/javascript -->
    <script type="javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var port = '<?php echo $portDcm; ?>';
    var aetitle = '<?php echo $aetitle; ?>';
    var ip = '<?php echo $ip; ?>';
    var institution = '<?php echo $institution; ?>';
    $(document).ready(function() {
        if(aetitle){
            $('#aetitle , #port , #institution').each(function(index, el) {
                $(el).parent().addClass('has-success has-feedback')
                $(el).attr('disabled', 'disabled');
                $("#save").attr('disabled', 'disabled');
            });
            $('#ip').val(ip);
            $('#port').val(port);
            $('#aetitle').val(aetitle);
            $('#institution').val(institution);
        }
        $("#port").keydown(function(event) {
            // Allow only backspace and delete
            if (event.keyCode == 46 || event.keyCode == 8) {
                // let it happen, don't do anything
            } else {
                // Ensure that it is a number and stop the keypress
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
            }
        });
        $('#aetitle , #port , #institution').click(function(event) {
            $(this).parent().removeClass('has-error has-feedback');
        });
        $('#save').click(function(event) {
            var nulos = 0;
            $('#aetitle , #port , #institution').each(function(index, el) {
                if ($(el).val() == "") {
                    $(el).parent().addClass('has-error has-feedback')
                    nulos = 1;
                }
            });
            if (nulos == 0) {
                var port = $('#port').val();
                var aetitle = $('#aetitle').val();
                var institution = $('#institution').val();
                $.post('connectors/saveNodes.php', {
                    ip: 'localhost',
                    port: port,
                    aetitle: aetitle,
                    institution: institution,
                    type: 'l'
                }, function(data, textStatus, xhr) {
                    console.log(data);
                    $('#aetitle , #port , #institution').each(function(index, el) {
                        $(el).parent().addClass('has-success has-feedback')
                        $(el).attr('disabled', 'disabled');
                        $("#save").attr('disabled', 'disabled');
                    });
                });
            }
        });
    });
    </script>
</body>

</html>
