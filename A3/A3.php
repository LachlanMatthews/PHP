<html>
	<head>
		<title>Assignment 3</title>
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
		
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songName']))
			{
				echo "<p>Invalid song name. English letters/numbers only</p>";
			}
			else
			{
				$sName = $_POST['songName'];
			}
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songArtist']))
			{
				echo "<p>Invalid song artist. English letters/numbers only</p>";
			}
			else
			{
				$sArtist = $_POST['songArtist'];
			}
			if (!preg_match ("/^[a-zA-Z\s]+$/",$_POST['songGenre']))
			{
				echo "<p>Invalid song genre. English letters/numbers only</p>";
			}
			else
			{
				$sGenre = $_POST['songGenre'];
			}
			if ($_POST['songYear'] > 2020)
			{
				echo "<p>Invalid song year</p>";
			}
			else
			{
				$sYear = $_POST['songYear'];
			}
		}
		createForm();
		
		function createForm()
		{
			global $sName;
			global $sArtist;
			global $sGenre;
			global $sYear;
		?>
			<form name = "form" action = "A3.php" method = "POST">
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
				</p>
			</form>
		<?php
		}
	?>
	</body>
</html>