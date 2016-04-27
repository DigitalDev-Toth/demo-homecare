<?php
session_start();
if(!isset($_SESSION['Username'])) { header("location: ../../../login.php?error=hack"); header('Content-Type: text/html; charset=latin1');  }
?>
<link href="../../tools/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="../../tools/bootstrap/js/bootstrap.min.js" /></script>
<?php
include("../../libs/db.class.php");
$calendar = NEW DB("calendar", "id");

//$patient = $_GET['patient'];
$currentCalendar= $_GET['calendar'];
/*
$sql = "SELECT calendar.* , exam.name as examen from calendar , calendar_exam, exam where patient = $patient and calendar_exam.calendar = calendar.id AND calendar_exam.exam = exam.id";
$result = $calendar->doSql($sql);

//echo '<a target="editFromCalendar" href="bioscan://<>id='.$currentCalendar.'<>"><img border="0" src="../../../images/iconMenu/scan.png"></a></td>';
//echo 'Escanear';
$path = '../../../uploads';

$tableO="<table class='table table-bordered table-condensed'>";
$tableO.="<tr class='active'><td colspan='4' class='text-center' >Ordenes Medicas</td></tr><tr><td>N</td><td>Examen</td><td>Fecha</td><td>Imagen</td></tr>";

$i=0;
do{
	$date = strtotime($result['date_c']);
	$year = date('Y', $date);
	$month = date('m', $date);
	$day = date('d', $date);
	$dir = "$year/$month/$day";
	//Ordenes Medicas
	$file = "$path/ordenes/$dir/".$result['id'].".png";
	if(file_exists($file)){
		$i++;
		$tableO.="<tr><td>".$i."</td><td>".$result['examen']."</td><td>".$dir."</td><td><a href='$file' target='_blank' ><img src='../../../images/search.png' ></a></td></tr>";
	}

}while($result = pg_fetch_assoc($calendar->actualResults));
$tableO.="</table>";
if($i==0){
	$tableO= "";
}

$i=0;
$tableC="<table class='table table-bordered table-condensed'>";
$tableC.="<tr class='active'><td colspan='4' class='text-center' >Examen de creatinina</td></tr><tr><td>N</td><td>Examen</td><td>Fecha</td><td>Imagen</td></tr>";
$result = $calendar->doSql($sql);
do{
	$date = strtotime($result['date_c']);
	$year = date('Y', $date);
	$month = date('m', $date);
	$day = date('d', $date);
	$dir = "$year/$month/$day";
	//Creatina
	$file = "$path/exams/$dir/".$result['id'].".png";
	if(file_exists($file)){
		$i++;
		$tableC.="<tr><td>".$i."</td><td>".$result['examen']."</td><td>".$dir."</td><td><a href='$file' target='_blank' > <img src='../../../images/search.png' > </a></td></tr>";
	}

}while($result = pg_fetch_assoc($calendar->actualResults));
$tableC.="</table>";
if($i==0){
	$tableC= "";
}
$i=0;
$tableOt="<table class='table table-bordered table-condensed'>";
$tableOt.="<tr class='active'><td colspan='4' class='text-center >Otros Documentos</td></tr><tr><td>N</td><td>Examen</td><td>Fecha</td><td>Imagen</td></tr>";
$result = $calendar->doSql($sql);
do{
	$date = strtotime($result['date_c']);
	$year = date('Y', $date);
	$month = date('m', $date);
	$day = date('d', $date);
	$dir = "$year/$month/$day";
	//Otros Documentos
	$file = "$path/otros/$dir/".$result['id'].".png";
	if(file_exists($file)){
		$i++;
		$tableOt.="<tr><td>".$i."</td><td>".$result['examen']."</td><td>".$dir."</td><td><a href='$file' target='_blank' > <img src='../../../images/search.png' > </a></td></tr>";

	}
}while($result = pg_fetch_assoc($calendar->actualResults));
$tableOt.="</table>";
if($i==0){
	$tableOt= "";
}

*/
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" media="screen" href="../../tools/file-upload/css/fileinput.css">
    <script type="text/javascript" src="../../tools/file-upload/js/fileinput.js"></script>
</head>
<div class="container-fluid">
 <!--
<div class="panel panel-default">

  <div class="panel-body">

   <div class="row text-center">
		<?php
		//echo '<a target="editFromCalendar" href="bioscan://<>id='.$currentCalendar.'<>"><img border="0" src="../../../images/iconMenu/scan.png"></a>';
		?>

		<br>
		<p>Escanear Nuevo Documento</p>
	</div>
	<div class="row">
		<div class="col-md-1">
			<div id="tOrder">
			</div>
		</div>
		<div class="col-md-1">
			<div id="tCrea">
			</div>
		</div>
			<div class="col-md-1">
			<div id="tOth">
			</div>
		</div>
	</div>


  </div>

</div>
  -->
  <br>
  <legend>Documentos</legend>
    	<div class="row">
    		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
    		    <div id="showDocs">
    		    <table class="table table-striped table-bordered">
    		    	<thead>
    		    		<tr>
    		    			<th>ID</th>
    		    			<th>Archivo</th>
    		    			<th>Ver</th>
    		    			<th>Eliminar</th>
    		    		</tr>
    		    	</thead>
    		    	<tbody id="tbody">
                       <td>
    		    			<td>12</td>
    		    			<td>Examen</td>
    		    			<td><a class="btn btn-info" type="submit" href="../../../uploads/pdfs/'+urlsDown+'" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
    		    			<td><a class="btn btn-danger" onclick="deletePdf(\''+urlsDown+'\')" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
    		    		</td>
    		    	</tbody>
    		    </table>
    			</div>
    			<div id="toUpload" style="display:none">
			       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			            <form action="" method="POST" role="form">
			                <div class="form-group">
			                    <input name="files" id="pdfFile" type="file" multiple="true" class="file-loading" data-show-upload="true" data-show-preview="true">
			                    <input type="hidden" name="calendar" id="calendar" class="form-control" value="" required="required" pattern="" title="">
			                </div>
						 <button id="close" type="submit" class="btn btn-primary">Salir</button>
			            </form>
			        </div>
    			</div>
    		</div>
    		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    			<div class="dropdown">
				  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				    Acciones
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="viewDocs">Ver documentos</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="upload">Subir documento</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="scan">Escanear documento</a></li>
				  </ul>
				</div>
    		</div>
    	</div>




</div>
</body>
</html>

<script type="text/javascript">
/*
var order = "<?php echo $tableO;?>";
var crea = "<?php echo $tableC;?>";
var oth = "<?php echo $tableOt;?>";

$("#tOrder").html(order);
$("#tCrea").html(crea);
$("#tOth").html(oth);
*/
var calendar = "<?php echo $currentCalendar;?>";
$(document).ready(function() {
	$("#pdfFile").fileinput({
        uploadAsync: false,
        uploadUrl: "uploadPdf.php",
        uploadExtraData: function() {
            return {
                calendar: calendar
            };
        },
        multiple: true,
        showUpload:true,
        previewFileType:'text',
        allowedFileExtensions: ["pdf","jpg","jpeg","png"],
        previewClass: "bg-warning"
    });

	$("#upload").click(function(event) {
		$("#showDocs").fadeOut('fast', function() {
			$("#toUpload").fadeIn();
		});
	});
	$("#viewDocs").click(function(event) {
		$("#toUpload").fadeOut('fast', function() {
			viewDoc(calendar);
			$("#showDocs").fadeIn();
		});
	});
	viewDoc(calendar);


});

function viewDoc (calendar) {

	$.ajax({
		url: 'listDocs.php',
		type: 'POST',
		data: {calendar: calendar},
	})
	.done(function(e) {
		var json = JSON.parse(e);
		var flag = false;
		if(json.length){
			var html='';
			for (var i = 0; i < json.length; i++) {
				for (var j in json[i] ) {
					if(j>1){
						flag =true;
						var urlsDown = json[i][1]+"/"+json[i][j];
						html += '<tr><td>'+json[i][1] +'</td>';
						html += '<td>'+json[i][j] +'</td><td> <a class="btn btn-info" type="submit" href="../../../uploads/pdfs/'+urlsDown+'" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a> </td>';
						html += '<td> <a class="btn btn-danger" onclick="deletePdf(\''+urlsDown+'\')" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> </td></tr>';
						//../../../uploads/pdfs/'+urlsDown+'
					}
				};
			};
			$("#tbody").html("").html(html);
		}else{

		}

		if(!flag){
			$("#tbody").html("<tr><td colspan='4'>Sin documentos</td></tr>");
		}
	});

}

function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
function deletePdf (file) {

	if(confirm("Seguro que desea eliminar el documento :"+file)){
		$.post('deletePdf.php', {file:file}, function(data, textStatus, xhr) {
			if(data == 'OK'){
				viewDoc(calendar);
				alert("Documento eliminado");
			}else{
				alert("Error al elimnar el documento");
			}
		});
	}

}
</script>
