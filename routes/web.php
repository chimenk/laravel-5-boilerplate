<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
Route::get('print', function() {
    $tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
    $file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
    $handle = fopen($file, 'w');
    $condensed = Chr(27) . Chr(33) . Chr(4);
    $bold1 = Chr(27) . Chr(69);
    $bold0 = Chr(27) . Chr(70);
    $initialized = chr(27).chr(64);
    $condensed1 = chr(15);
    $condensed0 = chr(18);
    $Data  = $initialized;
    $Data .= $condensed1;
    $Data .= "==========================\n";
    $Data .= "|     ".$bold1."OFIDZ MAJEZTY".$bold0."      |\n";
    $Data .= "==========================\n";
    $Data .= "Ofidz Majezty is here\n";
    $Data .= "We Love PHP Indonesia\n";
    $Data .= "We Love PHP Indonesia\n";
    $Data .= "We Love PHP Indonesia\n";
    $Data .= "We Love PHP Indonesia\n";
    $Data .= "We Love PHP Indonesia\n";
    $Data .= "--------------------------\n";
    fwrite($handle, $Data);
    fclose($handle);
    copy($file, "//192.168.1.8/lx310");  # Lakukan cetak
    unlink($file);
});

Route::get('lang/{lang}', 'LanguageController@swap');

Route::get('rf', function() {
    $conn = fsockopen('192.168.1.201', '80', $errno, $errstr, 15);
    if($conn){
        $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">1</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
        $newLine="\r\n";
        fputs($conn, "POST /iWsService HTTP/1.0".$newLine);
        fputs($conn, "Content-Type: text/xml".$newLine);
        fputs($conn, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
        fputs($conn, $soap_request.$newLine);
        $buffer="";
        while($Response=fgets($conn, 1024)){
            $buffer=$buffer.$Response;
        }
    }else{
        echo 'koneksi gagal';
    }
    $buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
    $buffer=explode("\r\n",$buffer);
    for($a=0;$a<count($buffer);$a++){
        $data=Parse_Data($buffer[$a],"<Row>","</Row>");
        $PIN=Parse_Data($data,"<PIN>","</PIN>");
        $DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
        $Verified=Parse_Data($data,"<Verified>","</Verified>");
        $Status=Parse_Data($data,"<Status>","</Status>");
        echo $PIN.'-'.$DateTime.'-'.$Verified.'-'.$Status.'<br>';
    }
});

function Parse_Data($data,$p1,$p2){
    $data=" ".$data;
    $hasil="";
    $awal=strpos($data,$p1);
    if($awal!=""){
        $akhir=strpos(strstr($data,$p1),$p2);
        if($akhir!=""){
            $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
        }
    }
    return $hasil;  
}

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});

Route::get('qrc', function() {
	$data = QrCode::size(200)->generate('Make me into a QrCode!');
	return response()->json($data, 200);
});

Route::get('py', function() {
	// $command = escapeshellcmd('ssh pi@192.168.1.7 "ls -la"');
	// $output = shell_exec($command);
	// echo $output;
    $connection = ssh2_connect('192.168.1.7', 22);
    ssh2_auth_password($connection, 'pi', 'qwerty');
    $stream = ssh2_exec($connection, 'python /home/pi/test.py');
});