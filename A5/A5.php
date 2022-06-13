<html>
	<head>
		<title>Assignment 5</title>
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
				margin: 0px auto 0px auto;
				text-align: left;
			}
			input[type="text"]
			{
				border-style: solid;
				border-color: white;
				background:transparent;
			}
		</style>
	</head>
	<body>
		<?php
			global $artistFilter;
			global $genreFilter;
			global $yearFilter;
			if ($_SERVER["REQUEST_METHOD"] == "GET")
			{
				
				if (!empty($_GET['artistFilter']))
				{
					$artistFilter = $_GET['artistFilter'];
				}
				if (!empty($_GET['genreFilter']))
				{
					$genreFilter = $_GET['genreFilter'];
				}
				if (!empty($_GET['yearFilter']))
				{
					$yearFilter = $_GET['yearFilter'];
				}
			}
			if ($yearFilter == "all")
			{
				$year1 = 0;
				$year2 = 9999;
			}
			if ($yearFilter == "first")
			{
				$year1 = 0;
				$year2 = 1999;
				echo "Selected songs made before 2000";
			}
			if ($yearFilter == "second")
			{
				$year1 = 2000;
				$year2 = 2010;
				echo "Selected songs made between 2000 and 2010";
			}
			if ($yearFilter == "third")
			{
				$year1 = 2011;
				$year2 = 2020;
				echo "Selected songs made before 2011 and 2020";
			}
		?>
		<form name = "form" action = "A5.php" method = "GET">
			<p align = "center">
			Artist filter: <input type = "text" name = "artistFilter" value = "<?php echo $artistFilter;?>">
			</p>
			<p align = "center">
				Genre filter: <input type = "text" name = "genreFilter" value = "<?php echo $genreFilter;?>">
			</p>
			<p align = "center">
				Year filter: <select name = "yearFilter">
					<option value = "all"></option>
					<option value = "first">0-1999</option>
					<option value = "second">2000-2010</option>
					<option value = "third">2011-2020</option>
				</option>
			</p>
			<p align = "center">
				<input type = "submit"> 
			</p>			
		</form>
		
		<?php
			$file = fopen("data.txt", "r");
			$count = 0;
			while (($line = fread($file, filesize("data.txt"))) != null)
			{
				$data = explode(":", $line);
				for($num = 0; $num < count($data) - 2; $num += 4)
				{
					//Associative array stores all song data behiind 1 numerical key. Exploded into an array by splitting with delimiter ':'
					$songs[strval($count)] = $data[$num + 0].":".$data[$num + 1].":".$data[$num + 2].":".$data[$num + 3].":";
					for ($num2 = 0; $num2 < count($songs); $num2++)
					{
						$song = explode(":", $songs[strval($count)]);
						if ($artistFilter == $song[1] || $artistFilter == "")
						{
							if ($genreFilter == $song[2] || $genreFilter == "")
							{
								$year1 = $year2 = 0;
								if ($yearFilter == "all")
								{
									$year1 = 0;
									$year2 = 9999;
								}
								if ($yearFilter == "first")
								{
									$year1 = 0;
									$year2 = 1999;
								}
								if ($yearFilter == "second")
								{
									$year1 = 2000;
									$year2 = 2010;
								}
								if ($yearFilter == "third")
								{
									$year1 = 2011;
									$year2 = 2020;
								}
								
								if (($song[3] >= $year1 && $song[3] <= $year2) || $yearFilter == "")
								{
									?>
										<div>
											<?php
												echo "Song:";
												?> <br> <?php
												echo " - ".$song[0];
												?> <br> <?php
												echo " - ".$song[1];
												?> <br> <?php
												echo " - ".$song[2];
												?> <br> <?php
												echo " - ".$song[3];
												?> <br> <?php
											?>
										</div>
									<?php
								}
							}
						}
					}
					
				}$count++;
			}
			fclose($file);
		?>
	</body>
</html>