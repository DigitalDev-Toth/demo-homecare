<?php  header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Dicomizator</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="js/datepicker/css/datepicker.css">
    <link rel="stylesheet" media="screen" href="tools/css/fileinput.css">

</head>

<body>
    <!--<?php
//include 'navbar.html'; ?>-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!--<div id="patient" class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingreso Paciente</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="hidden" id="patient">
                                <div id="rutDiv" class="input-group">
                                    <span class="input-group-addon">Rut:</span>
                                    <input type="text" name="" id="rut" class="form-control" value="" required="required" pattern="" title="" placeholder="Rut">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div id="nameDiv" class="input-group">
                                    <span class="input-group-addon">Nombre:</span>
                                    <input type="text" name="" id="name" class="form-control" value="" required="required" pattern="" title="" placeholder="Nombre Paciente">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div id="nameDiv" class="input-group">
                                    <span class="input-group-addon">Apellido:</span>
                                    <input type="text" name="" id="lastname" class="form-control" value="" required="required" pattern="" title="" placeholder="Apellido Paciente">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <br>
                                <div id="sexDiv" class="input-group input-group-success">
                                    <span class="input-group-addon">Sexo:</span>
                                    <select name="" id="gender" class="form-control" style="position:static">
                                        <option value="">SELECCIONE</option>
                                        <option value="M">Hombre</option>
                                        <option value="F">Mujer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <br>
                                <div id="dateDiv" class="input-group date">
                                    <input id="date" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <br>
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                <br>
                                <button id="next" type="button" class="btn btn-success">Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div id="dicom" class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><span id="text"></span></strong> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-center">
                                <legend>Capturar Imagen </legend>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div id="my_camera" class="text-center center-block img-responsive"></div>
                                    </div>
                                     <button id="capture" type="button" class="btn btn-success">Capturar <i class="fa fa-picture-o fa-fw"></i></button>
                                </div>

                            </div>
                            <div id="toUpload" >
                               <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <legend>Subir Imagen</legend>
                                    <form action="" method="POST" role="form">
                                        <div class="form-group">
                                            <input name="images[]" id="imageUploader" type="file" multiple="true" class="file-loading" data-show-upload="true" data-show-preview="true">
                                            <input type="hidden" name="calendar" id="calendar" class="form-control" value="" required="required" pattern="" title="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="preview" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <legend>Capturas</legend>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-sm-12 col-md-1 col-lg-1">
                                <button id="back" type="button" class="btn btn-danger" style="display:none;">Atras</button>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-sm-12 col-md-1 col-lg-1">
                                <button id="save" type="button" class="btn btn-success">Guardar</button>
                            </div>
                            <div class="col-md-offset-8 col-xs-12 col-sm-12 col-md-1 col-lg-1">
                                <button data-loading-text="Enviando Dicom..." id="send" type="button" class="btn btn-success"><i class="fa fa-cloud-upload fa-fw"></i> Enviar a PACS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/webcamjs/webcam.js"></script>
<script src="js/modal-wait/bootstrap-wait.js"></script>
<script src="js/datepicker/js/bootstrap-datepicker.js"></script>
<script src="js/jquery.rut/jquery.Rut.js"></script>
    <script type="text/javascript" src="tools/js/fileinput.js"></script>
    <script type="text/javascript" src="tools/js/fileinput_locale_es.js"></script>
<style type="text/css">
.skip {
    opacity: 0.1;
}

.hidden {
    display: none;
}
.fa-stack {
    margin-left: 36%;
    margin-top: 36%;
    position: absolute;
}
</style>
<script type="text/javascript">
var patientArray;

function test(el) {
    if ($(el).text() == 'Borrar') {
        $(el).parent().children().next().addClass('skip');
        $($(el).parent().parent().children()[0]).removeClass('hidden');
        $(el).text('Activar');
    } else {
        $(el).parent().children().next().removeClass('skip');
        $($(el).parent().parent().children()[0]).addClass('hidden');
        $(el).text('Borrar');
    }
}

function take_snapshot() {
    Webcam.snap(function(data_uri) {
        console.log(data_uri);
        var html = "";
        html += '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">' +
            '<div class="panel panel-success">' +
            '<div class="panel-body">' +
            '<span class="fa-stack fa-lg hidden">' +
            '<i class="fa fa-ban fa-stack-2x text-danger"></i>' +
            '</span>' +
            '<div id="my_result">' +
            '<a class="close text-danger" onclick="test(this);">Borrar</a>' +
            '<img class="captura img-responsive" src="' + data_uri + '"/>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        $("#preview").append(html);
    });
}

function upload(data_uri, index, total) {
    var fin = 0;
    if (index == (total - 1)) {
        fin = 1;
    }
    Webcam.upload(data_uri, 'connectors/upload.php?index=' + index, function(code, text) {});
}
var imageNumbers = 0;
$(document).ready(function() {
    $("#imageUploader").fileinput({
        uploadUrl: "connectors/uploadImage.php",
        uploadAsync: true,
        showPreview: true,
        allowedFileExtensions: ['png', 'jpg', 'gif','jpeg','JPG'],
        maxFileCount: 100,
        elErrorContainer: '#kv-error-1',
        language: "es"
    }).on('filebatchpreupload', function(event, data, id, index) {
        console.log("subiendo");
        console.log(data.files.length);
    }).on('fileuploaded', function(event, data, id, index) {
        console.log("Listo");
        imageNumbers++;
        if(imageNumbers == data.files.length){
            setTimeout(function() {
                waitingDialog.show('Creando Dicom...', {dialogSize: 'sm', progressType: 'warning'});
                var patient = patientArray[0];
                var rut = patientArray[1];
                var birthdate = patientArray[2];
                var gender = patientArray[3];
                var lastname = patientArray[4];
                $.post('connectors/img2dcm.php', {
                    total: imageNumbers,
                    patient: patient,
                    rut: rut,
                    gender: gender,
                    birthdate: birthdate,
                    lastname: lastname
                }, function(data, textStatus, xhr) {
                    console.log(data);
                    waitingDialog.hide();
                    imageNumbers =0;
                    setTimeout(function() {
                       // $.get('connectors/remove.php', function(data) {
                         //   console.log(data);
                        //});
                    }, 2000);
                });
            }, 1000);
        }


    }).on('fileuploaderror', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            console.log('File upload error');
            console.log(data);
        });





    $("#rut").focus(function(event) {
        $("#rut").attr("placeholder", "Rut");

    });
    $('#name , #rut , #gender, #date, #lastname').click(function(event) {
        $(this).parent().removeClass('has-error has-feedback');
    });
    $("#rut").Rut({
        on_error: function() {
            $("#rutDiv").parent().addClass('has-error has-feedback');
            $("#rut").val("");
            $("#rut").attr("placeholder", "Rut invalido, reingrese");
        },
        on_success: function() {
            var rut = $("#rut").val();
            $("#rutDiv").parent().removeClass('has-error has-feedback');
            $.post('connectors/findPatient.php', {rut: rut}, function(data, textStatus, xhr) {
                if(parseInt(data) != 0) {
                    var json = $.parseJSON(data);
                    $('#patient').val(json.id);
                    $('#name').val(json.name);
                    $('#lastname').val(json.lastname);
                    $('#gender').val(json.gender);
                    $('#date').val(json.birthdate);
                }else {
                    $('#patient').val("");
                    $('#name').val("");
                    $('#lastname').val("");
                    $('#gender').val("");
                    $('#date').val("");
                }
            });
        }
    });
    $('.input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    })
    $('#dicom').css('enabled', 'none');
    $( "body" ).keyup(function(e) {
        var code = e.keyCode || e.which;
        if(code == 73){
            console.log('taking');
            take_snapshot();
        }
    });

    $('#capture').click(function(event) {
        take_snapshot();
    });
    $('#save').click(function(event) {
        var total = $('.captura').length;
        var retorno = false;
        if ($('.captura').not('.skip').length != 0) {
            waitingDialog.show('Creando Dicom...', {dialogSize: 'sm', progressType: 'warning'});
            $('.captura').not('.skip').each(function(index, el) {
                Webcam.upload($(el).attr('src'), 'connectors/upload.php?index=' + index, function(code, text) {
                    if (text == (total - 1)) {
                        var patient = patientArray[0];
                        var rut = patientArray[1];
                        var birthdate = patientArray[2];
                        var gender = patientArray[3];
                        var lastname = patientArray[4];
                        //console.log('?total='+total+'&patient='+patient+'&rut='+rut+'&gender='+gender+'&birthdate='+birthdate+'&lastname='+lastname);
                        $.post('connectors/img2dcm.php', {
                            total: total,
                            patient: patient,
                            rut: rut,
                            gender: gender,
                            birthdate: birthdate,
                            lastname: lastname
                        }, function(data, textStatus, xhr) {
                            console.log(data);
                            waitingDialog.hide();
                        });
                    }
                });
            });
        } else alert('debes capturar algo');
    });
    $('#send').click(function(event) {
        waitingDialog.show('Enviando', {dialogSize: 'sm', progressType: 'primary'});
        $.ajax({
            url: 'connectors/sendDcm.php',
            type: 'POST'
        })
        .done(function(data) {
            console.log(data);
            waitingDialog.hide();
        });
    });
    $('#next').click(function(event) {
        var nulos = 0;
        /*$('#name , #rut , #gender, #date, #lastname').each(function(index, el) {
            if (el.type == "select-one") {
                if ($(el).find('option:selected').val() == "") {
                    $(el).parent().addClass('has-error has-feedback')
                    nulos = 1;
                }
            } else {
                if ($(el).val() == "") {
                    $(el).parent().addClass('has-error has-feedback')
                    nulos = 1;
                }
            }
        });*/
        if (nulos == 0) {
            $('#patient').fadeOut('5000', function() {
                $('#dicom').fadeIn('5000', function() {
                    $('#back').css('display', '');
                    var name = $('#name').val();
                    var lastname = $('#lastname').val();
                    $('#text').text(name + " " + lastname);
                    var rut = $('#rut').val();
                    var birthdate = $('#date').val();
                    var gender = $('#gender option:selected').val();
                    //console.log($('#patient').val());
                    if($('#patient').val() == ""){
                        $.post('connectors/savePatient.php', {name:name, lastname:lastname, rut:rut, gender:gender, birthdate:birthdate}, function(data, textStatus, xhr) {
                        });
                    }
                    patientArray = [name, rut, birthdate, gender, lastname];
                    Webcam.set({
                        width: 320,
                        height: 240,
                        image_format: 'jpeg',
                        jpeg_quality: 100,
                        force_flash: false
                    });
                    Webcam.attach('#my_camera');
                });
            });
        }

    });

    $('#back').click(function(event) {
        patientArray = [];
        $('#name').val('');
        $('#lastname').val('');
        $('#rut').val('');
        $('#date').val('');
        $($("#gender option")[0]).attr('selected', 'selected')
        $('#dicom').fadeOut('400', function() {
            $('#patient').fadeIn('400', function() {
                Webcam.reset();
            });
        });
    });
});
</script>

</html>
