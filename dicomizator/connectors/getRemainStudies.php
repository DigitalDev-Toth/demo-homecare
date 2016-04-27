<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$dbconn = pg_connect("host=186.67.103.122 port=5435 dbname=test user=postgres password=justgoon") or die('NO HAY CONEXION: ' . pg_last_error());
	$sql = "SELECT * 
			from exams ";
			$pk='-';
	$result = pg_query($dbconn,$sql) or die("SQL Error 1: " . pg_last_error());
	while ($rows = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		$sql = "SELECT exams.exam,exams.date_created,studies.url,studies.status,studies.description, studies.image,studies.result
		from studies  
		left join exams on studies.exam = exams.exam
		where exams.exam=".$rows['exam'];
		
		$restImages = pg_query($dbconn,$sql) or die("SQL Error 1: " . pg_last_error());
	    while ($rowsImages = pg_fetch_array($restImages, null, PGSQL_ASSOC)) {
	        $images[] = array(
	            'id' => $rowsImages['image'],
	            'status' => $rowsImages['status'],
	            'description' => $rowsImages['description'],
	            'result' => $rowsImages['result'],
	            'url' => $rowsImages['url'],
	            ); 
	    }
	    $pk = pkExam($rows['date_created']);

        $exams["data"][] = array(
            'id' => $rows['exam'],
            'date' => $rows['date_created'],
            'pk' => $pk,
            'images' => json_encode($images)
        );
        $images = null;
    }

    echo json_encode($exams);

    function pkExam($dateE){
    	$sqlPacs = "SELECT pk from study where study_datetime = '".$dateE."' ";
		$dbconnEX = pg_connect("host=186.67.103.122 port=5435 dbname=pacsdb user=postgres password=justgoon") or die('NO HAY CONEXION: ' . pg_last_error());
		$pacsResults = pg_query($dbconnEX,$sqlPacs) or die("SQL Error 1: " . pg_last_error());
		$pacsPK = pg_fetch_array($pacsResults, null, PGSQL_ASSOC);
		$pk = $pacsPK['pk'];
		return $pk;
    }
 ?>