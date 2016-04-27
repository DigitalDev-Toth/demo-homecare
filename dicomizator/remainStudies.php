<?php  header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Dicomizator</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
</head>

<body>
    <?php include 'navbar.html'; ?>
   <div class="container">
       <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="example" class="table table-condensed table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th class="success">ID</th>
                        <th>Fecha</th>
                         <th>Mirror</th>
                    </tr>
                </thead>
            </table>
           </div>
       </div>
   </div>

</body>
<script src="//code.jquery.com/jquery.js"></script>

<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
//"url": 'connectors/getRemainStudies.php',
    function format(d) {
        // `d` is the original data object for the row
        var html = "";
        html += '<table class="table table-condensed table-bordered" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<th>ID</th>' +
            '<th>PRUEBA APLICADA</th>' +
            '<th>ESTADO EXAMEN</th>' +
            '<th>RESULTADO</th>' +
            '<th>IMAGEN</th>' +
            '<tr>';
        for (var i = 0; i < d.length; i++) {
            html += '<tr>' +
                '<td>' + d[i].id + '</td>' +
                '<td>' + (d[i].description != null ? d[i].description : '-')+ '</td>' +
                '<td>' + (d[i].status == 1 ? 'FINALIZADA' : 'ANALIZANDO')+ '</td>' +
                 (d[i].result == 0 ? '<td class="success"> NORMAL</td>' : (d[i].result != 0 ? '<td class="danger"> ANORMAL</td>' : '<td> - </td>') )+
                '<td> <a href="' + d[i].url + '" target="_blank" ><i class="fa fa-eye fa-2x"></i></a> </td>' +
                '</tr>';
        };
        html += '</table>';
        return html;
    }
    var ajaxComplete = false;
    $(document).ready(function() {
                var table = $('#example').DataTable({
            "ajax": {
                "url": 'connectors/getRemainStudies.php',
                "data": function(d) {
                    ajaxComplete = true;
                }
            },
            "aaSorting": [],
            "serverSide": false,
            "processing": true,
            "deferRender": true,
            "columns": [{
                "class": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": '-'
                    }, {
                        "data": "id"
                    }, {
                        "data": "date"
                    }, {
                        "data": "pk"
                    }],
            "order": [
                [1, 'asc']
            ],
            "fnDrawCallback": function(oSettings) {

                if (ajaxComplete) {
                    if(oSettings.json.data[0].id != ""){
                        $('table tbody tr').each(function(index, el) {
                            var row = table.row(el);
                            var json = $.parseJSON(row.data().images);
                            row.child(format(json)).show();
                            $(el).addClass('shown');
                            $('input[type=search]').addClass('form-control');
                        });
                    }
                }

            },
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                console.log(aData.pk);
                var mirror =  aData.pk != null ? ('<a href="http://demo.biopacs.com/newbiopacs/mirror-std-v2/application/?study=' + aData.pk + '" target="_blank" > <img src="https://erad.cl/demo-pacs/assets/images/mirror.png" alt=""></a>') : '-';
                 $('td:eq(3)', nRow).html(mirror);
            },
            "fnInfoCallback": function(oSettings, iStart, iEnd, iMax, iTotal, sPre) {

            }
        });
    });
</script>

</html>
