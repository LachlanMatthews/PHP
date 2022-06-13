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
		$formFail = $songFail = $artistFail = $genreFail = $yearFail = false;
		
		$file = fopen("data.txt", "a");
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songName']))
			{
				echo "<p>Invalid song name. English letters/numbers only</p>";
				$songFail = true;
				$formFail = true;
			}
			else
			{
				$sName = $_POST['songName'];
				fwrite($file, $sName.":");
			}
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songArtist']))
			{
				echo "<p>Invalid song artist. English letters/numbers only</p>";
				$artistFail = true;
				$formFail = true;
			}
			else
			{
				$sArtist = $_POST['songArtist'];
				fwrite($file, $sArtist.":");
			}
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songGenre']))
			{
				echo "<p>Invalid song genre. English letters/numbers only</p>";
				$genreFail = true;
				$formFail = true;
			}
			else
			{
				$sGenre = $_POST['songGenre'];
				fwrite($file, $sGenre.":");
			}
			if ($_POST['songYear'] > 2020 || $_POST['songYear'] == "")
			{
				echo "<p>Invalid song year</p>";
				$yearFail = true;
				$formFail = true;
			}
			else
			{
				$sYear = $_POST['songYear'];
				fwrite($file, $sYear.":");
			}
			
			$file2 = fopen("adminData.txt", "r+");
			$line = fread($file2, filesize("adminData.txt"));
			$data = explode(":", $line);
			
			$num = (int) $data[0];
			$num++;
			$data[0] = (string) $num;
			if (!$formFail)
			{
				$num = (int) $data[1];
				$num++;
				$data[1] = (string) $num;
			}
			else
			{
				$num = (int) $data[2];
				$num++;
				$data[2] = (string) $num;
			}
			if (!$songFail)
			{
				
				$num = (int) $data[3];
				$num++;
				$data[3] = (string) $num;
			}
			else
			{
				$num = (int) $data[4];
				$num++;
				$data[4] = (string) $num;
			}
			if (!$artistFail)
			{
				
				$num = (int) $data[5];
				$num++;
				$data[5] = (string) $num;
			}
			else
			{
				$num = (int) $data[6];
				$num++;
				$data[6] = (string) $num;
			}
			if (!$genreFail)
			{
				
				$num = (int) $data[7];
				$num++;
				$data[7] = (string) $num;
			}
			else
			{
				$num = (int) $data[8];
				$num++;
				$data[8] = (string) $num;
			}
			if (!$songFail)
			{
				
				$num = (int) $data[9];
				$num++;
				$data[9] = (string) $num;
			}
			else
			{
				$num = (int) $data[10];
				$num++;
				$data[10] = (string) $num;
			}
			fclose($file2);
			$file2 = fopen("adminData.txt", "w");
			for ($num = 0; $num < 11; $num++)
			{
				fwrite($file2, $data[$num].":");
			}
			fclose($file2);
		}
		fclose($file);
		
		createForm();
		
		function createForm()
		{
			global $sName;
			global $sArtist;
			global $sGenre;
			global $sYear;
		?>
			
			
		<?php
		}
	?>
	</body>
</html>