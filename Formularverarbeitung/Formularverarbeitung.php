<?php
#*************************************************************************************#


				#***********************************#
				#********** CONFIGURATION **********#
				#***********************************#

				#********** INCLUDES **********#
				require_once('../include/config.inc.php');
				require_once('../include/form.inc.php');


#*************************************************************************************#


				#******************************************#
				#********** INITIALIZE VARIABLES **********#
				#******************************************#
				
				$monthsArray 	= array('01'=>'Januar', '02'=>'Februar', '03'=>'März', '04'=>'April', '05'=>'Mai', '06'=>'Juni', '07'=>'Juli', '08'=>'August', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Dezember');

				$name 			= NULL;
				$ort 				= NULL;
				$day 				= NULL;
				$month 			= NULL;
				$year 			= NULL;
				$jaNein 			= NULL;
				$message 		= NULL;
				
				$errorName 		= NULL;
				$errorOrt 		= NULL;
				
				$success 		= NULL;


#*************************************************************************************#


				#**********************************#
				#********** PROCESS FORM **********#
				#**********************************#
				
				// Schritt 1 FORM: Prüfen, ob Formular abgeschickt wurde
				if( isset($_POST['testForm']) ) {
if(DEBUG)		echo "<p class='debug'>🧻 <b>Line " . __LINE__ . "</b>: Formular 'Test' wurde abgeschickt. <i>(" . basename(__FILE__) . ")</i></p>\n";										

					// Schritt 2 FORM: Daten auslesen, entschärfen und per DEBUG ausgeben
if(DEBUG)		echo "<p class='debug'>📑 <b>Line " . __LINE__ . "</b>: Werte auslesen und entschärfen... <i>(" . basename(__FILE__) . ")</i></p>\n";

					$name 	= sanitizeString($_POST['name']);
					$ort 		= sanitizeString($_POST['ort']);
					$day 		= sanitizeString($_POST['day']);
					$month 	= sanitizeString($_POST['month']);
					$year 	= sanitizeString($_POST['year']);
					$jaNein 	= sanitizeString($_POST['jaNein']);
					$message = sanitizeString($_POST['message']);				
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$name: $name <i>(" . basename(__FILE__) . ")</i></p>\n";
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$ort: $ort <i>(" . basename(__FILE__) . ")</i></p>\n";
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$day: $day <i>(" . basename(__FILE__) . ")</i></p>\n";
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$month: $month <i>(" . basename(__FILE__) . ")</i></p>\n";
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$year: $year <i>(" . basename(__FILE__) . ")</i></p>\n";
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$jaNein: $jaNein <i>(" . basename(__FILE__) . ")</i></p>\n";
if(DEBUG_V)		echo "<p class='debug value'><b>Line " . __LINE__ . "</b>: \$message: $message <i>(" . basename(__FILE__) . ")</i></p>\n";


					// Schritt 3 FORM (optional): Daten validieren/manipulieren
if(DEBUG)		echo "<p class='debug'>📑 <b>Line " . __LINE__ . "</b>: Feldwerte validieren... <i>(" . basename(__FILE__) . ")</i></p>\n";

					$errorName 	= validateInputString($name,20);
					$errorOrt 	= validateInputString($ort,20);
					
					
					#********** FINAL FORM VALIDATION **********#
					if( $errorName OR $errorOrt ) {
						// Fehlerfall
if(DEBUG)			echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: Formular enthält noch Fehler! <i>(" . basename(__FILE__) . ")</i></p>\n";				
						
					} else {
						// Erfolgsfall
if(DEBUG)			echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: Formular ist fehlerfrei. <i>(" . basename(__FILE__) . ")</i></p>\n";				

						// Schritt 4 FORM: Daten weiterverarbeiten
if(DEBUG)			echo "<p class='debug'>📑 <b>Line " . __LINE__ . "</b>: Formulardaten verarbeiten... <i>(" . basename(__FILE__) . ")</i></p>\n";
						
						$success = "<h4>Hallo $name, schön das Du hier bist!</h4>";
						
						// Felder aus Formular wieder leeren:
						$name 	= NULL;
						$ort 		= NULL;
						$day 		= NULL;
						$month 	= NULL;
						$year 	= NULL;
						$jaNein 	= NULL;
						$message = NULL;
						
					} // FINAL FORM VALIDATION END
					 
				} // PROCESS FORM END
				

#*************************************************************************************#
?>

	<!doctype html>

	<html>

		<head>
			<meta charset="utf-8">
			<title>Formularverarbeitung </title>
			<link rel="stylesheet" href="../css/main.css">
			<link rel="stylesheet" href="../css/debug.css">
			<style>				
				input, textarea, select, label { margin: 10px; padding: 3px; width: 300px; border-radius: 5px; }
				label { font-size: 1.3em; }
				select { width: 235px; }
				select#day { width: 70px; }
				select#month { width: 115px; }
				select#year { width: 80px; }
				input[type="radio"], input[type="checkbox"] { width: 10px; margin: 10px 6px; }
				input[type="submit"] { width: 310px }
				textarea { float: left; font-size: 1.1em; }				
			</style>
		</head>
		
		<body>
			<h1>Formularverarbeitung </h1>
			
			<h2><?php echo $success ?></h2>
			
			<br>
			<hr>
			<br>
			
			<?php if( !$success ): ?>
			<form action="" method="POST">
				<input type="hidden" name="testForm">
				
				<input type="text" name="name" value="<?php echo $name ?>" placeholder="Name"><span class="marker">*</span>
				<br>
					<br>
					<input type="text" name="ort" value="<?php echo $ort ?>" placeholder="Ort"><span class="marker">*</span>
				<br>
				<span class="error"><?php echo $errorOrt ?></span>
				<br>
				<br>
				<select id="day" name="day">
					<?php for( $i=1; $i<=31; $i++ ): ?>
						<?php $i = sprintf("%02d", $i) ?>
						<option value='<?= $i ?>' <?php if($i == $day) echo 'selected' ?>><?= $i ?></option>
					<?php endfor ?>
				</select>
				<select id="month" name="month">
					<?php foreach( $monthsArray AS $key=>$value ): ?>
						<option value='<?= $key ?>' <?php if($i == $key) echo 'selected' ?>><?= $key ?></option>
					<?php endforeach ?>
				</select>
				<select id="year" name="year">
					<?php for( $i=date('Y'); $i>=1901; $i-- ): ?>
						<option value='<?= $i ?>' <?php if($i == $year) echo 'selected' ?>><?= $i ?></option>
					<?php endfor ?>
				</select>
				
				<br>
				
				<label>Ja/Nein:</label>
				<input type="radio" name="jaNein" value="ja" 	<?php if( $jaNein == 'ja' OR $jaNein == NULL ) echo 'checked' ?>>ja
				<input type="radio" name="jaNein" value="nein" 	<?php if( $jaNein == 'nein' ) echo 'checked' ?>>nein
				
				<br>
				
				<textarea name="message" placeholder="Ihre Nachricht an uns..."><?php echo $message ?></textarea>
				<div class="clearer"></div>
				<br>
				
				<input type="submit" value="Absenden">
			</form>
			<?php endif ?>

		</body>

	</html>