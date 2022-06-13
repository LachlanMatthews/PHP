<html>
	<head>
		<title>Form</title>
		<style>
			body
			{
				background-image: url("background.jpg");
				font-family: verdana;
			}
			div
			{
				width: 70px;
				height: 20px;
				margin: 0px auto 0px auto;
				text-align: center;
				border-style: dotted;
			}
			div:hover
			{
				border-style: solid;
			}
			input[type="text"], input[type="number"]
			{
				border-style: solid;
				border-color: white;
				background:transparent;
			}
		</style>
	</head>
	<body>
	<?php
		$sName = $sArtist = $sGenre = $sYear = "";
		
		$file = fopen("data.txt", "a");
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songName']))
			{
				echo "<p>Invalid song name. English letters/numbers only</p>";
			}
			else
			{
				$sName = $_POST['songName'];
				fwrite($file, $sName.":");
			}
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songArtist']))
			{
				echo "<p>Invalid song artist. English letters/numbers only</p>";
			}
			else
			{
				$sArtist = $_POST['songArtist'];
				fwrite($file, $sArtist.":");
			}
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songGenre']))
			{
				echo "<p>Invalid song genre. English letters/numbers only</p>";
			}
			else
			{
				$sGenre = $_POST['songGenre'];
				fwrite($file, $sGenre.":");
			}
			if ($_POST['songYear'] > 2020 || $_POST['songYear'] == "")
			{
				echo "<p>Invalid song year</p>";
			}
			else
			{
				$sYear = $_POST['songYear'];
				fwrite($file, $sYear.":");
			}
		}
		fclose($file);
		
		createForm();
		
		function createForm()
		{
			global $sName;
			global $sArtist;
			global $sGenre;
			global $sYear;
			$file = fopen("adminData.txt", "r");
			$line = fread($file, filesize("adminData.txt"));
			$formData = explode(":", $line);
		?>
			<form name = "form" action = "Admin.php" method = "POST">
				<h3 align = "center">Song Details</h3>
				<p align = "center">
					Song title: <input type="text" name='songName' value = "<?php echo $sName;?>"/>
				</p>
				<p align = "center">
					Song artist: <input type="text" name="songArtist" value = "<?php echo $sArtist;?>"/>
				</p>
				<p align = "center">
					Song genre: <input type="text" name="songGenre" value = "<?php echo $sGenre;?>"/>
				</p>
				<p align = "center">
					Release year: <input type="number" name = "songYear" value = "<?php echo $sYear;?>"/>
				</p>
				<p align = "center">
					<div onClick="document.forms['form'].reset();">Reset</div>
					</br>
					<div onClick="document.forms['form'].submit();">Submit</div>
					</br>
					<div onClick="location.href = 'A4.php';">Go back</div>
				</p>
			</form>
			<p align = center>
				--- Admin form attempts not counted ---
			</p>
			<p align = center>
				Form attempts: <?php echo $formData[0]; ?>
			</p>
			<p align = center>
				Form correct count: <?php echo $formData[1]; ?>
			</p>
			<p align = center>
				Form fail count: <?php echo $formData[2]; ?>
			</p>
			<p align = center>
				Form song name correct count: <?php echo $formData[3]; ?>
			</p>
			<p align = center>
				Form song name fail count: <?php echo $formData[4]; ?>
			</p>
			<p align = center>
				Form artist name correct count: <?php echo $formData[5]; ?>
			</p>
			<p align = center>
				Form artist name fail count: <?php echo $formData[6]; ?>
			</p>
			<p align = center>
				Form genre correct count: <?php echo $formData[7]; ?>
			</p>
			<p align = center>
				Form genre fail count: <?php echo $formData[8]; ?>
			</p>
			<p align = center>
				Form year correct count: <?php echo $formData[9]; ?>
			</p>
			<p align = center>
				Form year fail count: <?php echo $formData[10]; ?>
			</p>
		<?php
		}
	?>
	</body>
</html>