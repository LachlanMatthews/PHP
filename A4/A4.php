<html>
	<head>
		<title>Assignment 4</title>
		<style>
			body
			{
				background-image: url("background.jpg");
				font-family: verdana;
			}
			.link
			{
				width: 200px;
				height: 20px;
				margin: 0px auto 0px auto;
				text-align: center;
			}
			div
			{
				width: 400px;
				height: 20px;
				margin: 0px auto 0px auto;
				text-align: left;
			}
		</style>
	</head>
	<body>
		<a align = "center" href="Admin.php"><div class = link>Admin Mode</div></a>
		<a align = "center" href="Form.php"><div class = link>Add New Song</div></a>
		<?php
			global $sName;
			global $sArtist;
			global $sGenre;
			global $sYear;
			$file = fopen("data.txt", "a");
			if (!empty($_POST['songName']))
			{
				$sName = $_POST['songName'];
				fwrite($file, $sName.":");
			}
			if (!empty($_POST['songArtist']))
			{
				$sArtist = $_POST['songArtist'];
				fwrite($file, $sArtist.":");
			}
			if (!empty($_POST['songGenre']))
			{
				$sGenre = $_POST['songGenre'];
				fwrite($file, $sGenre.":");
			}
			if (!empty($_POST['songYear']))
			{
				$sYear = $_POST['songYear'];
				fwrite($file, $sYear.":");
			}
			fclose($file);
			$file = fopen("data.txt", "r");
			while (($line = fread($file, filesize("data.txt"))) != null)
			{
				$data = explode(":", $line);
				?>
					<div>
						<?php
							$count = 0;
							for ($num = 0; $num < count($data); $num++)
							{
								if ($num % 4 == 0 && (count($data) - 1 != $num))
								{
									$count++;
									?> <br> <?php
									echo "Song ".$count;
									?> <br> <?php
								}
								echo " - ".$data[$num];
								?> <br> <?php
							}
						?>
					</div>
				<?php
			}
			fclose($file);
		?>
	</body>
</html>