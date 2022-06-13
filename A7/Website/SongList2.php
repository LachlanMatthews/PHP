<html>
	<head>
		<title>Song List</title>
		<style>
			body
			{
				background-image: url("background.jpg");
				font-family: verdana;
			}
			.scrollList
			{
				height:900px;
				width:600px;
				padding: 5px;
				overflow:scroll;
				margin: 0px auto 0px auto;
			}
			::-webkit-scrollbar
			{
				width: 10px;
				height: 10px;
			}
			::-webkit-scrollbar-track
			{
				border: 1px solid black;
				border-radius: 15px;
			}
			::-webkit-scrollbar-thumb
			{
				background: black;  
				border-radius: 10px;
			}
			td
			{
				width:640;
				vertical-align: text-top;
			}
			form, input[type="button"]
			{
				text-align: center;
				
			}
			input[type="text"]
			{
				border-style: solid;
				border-color: black;
				background:transparent;
			}
			.select
			{
				border-style: solid;
				border-color: black;
				background:transparent;
			}
		</style>
		<script>
			function showCreate()
			{
				document.getElementById("create").style.display = "block";
				document.getElementById("update").style.display = "none";
				document.getElementById("delete").style.display = "none";
			}
			function showUpdate()
			{
				document.getElementById("create").style.display = "none";
				document.getElementById("update").style.display = "block";
				document.getElementById("delete").style.display = "none";
			}
			function showDelete()
			{
				document.getElementById("create").style.display = "none";
				document.getElementById("update").style.display = "none";
				document.getElementById("delete").style.display = "block";
			}
		</script>
	</head>
	<body>
		<?php
			include "db.php";
			
			class Song
			{
				public $title;
				public $artist;
				public $genre;
				public $year;
				function __construct($t, $a, $g, $y)
				{
					$this->title = $t;
					$this->artist = $a;
					$this->genre = $g;
					$this->year = $y;
				}
			}
			
			class CountObj
			{
				public $detail;
				public $count;
				function __construct($d, $c)
				{
					$this->detail = $d;
					$this->count = $c;
				}
			}
			
			global $artistFilter;
			global $genreFilter;
			global $decadeFilter;
			
			global $csTitle;
			global $csArtist;
			global $csGenre;
			global $csYear;
			
			global $usTitle1;
			global $usArtist1;
			global $usGenre1;
			global $usYear1;
			global $usTitle2;
			global $usArtist2;
			global $usGenre2;
			global $usYear2;
			
			global $dsTitle;
			global $dsArtist;
			global $dsGenre;
			global $dsYear;
			
			$count = 0;
			$filteredCount = 0;
			$artistCounts = [];
			$genreCounts = [];
			$yearCounts = [];
			$date = date('d M Y, h:i:s A');
			
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
				if (!empty($_GET['decadeFilter']))
				{
					$decadeFilter = $_GET['decadeFilter'];
				}
				
				if (!empty($_GET['csTitle']))
				{
					$csTitle = $_GET['csTitle'];
				}
				if (!empty($_GET['csArtist']))
				{
					$csArtist = $_GET['csArtist'];
				}
				if (!empty($_GET['csGenre']))
				{
					$csGenre = $_GET['csGenre'];
				}
				if (!empty($_GET['csYear']))
				{
					$csYear = $_GET['csYear'];
				}
				
				if (!empty($_GET['usTitle1']))
				{
					$usTitle1 = $_GET['usTitle1'];
				}
				if (!empty($_GET['usArtist1']))
				{
					$usArtist1 = $_GET['usArtist1'];
				}
				if (!empty($_GET['usGenre1']))
				{
					$usGenre1 = $_GET['usGenre1'];
				}
				if (!empty($_GET['usYear1']))
				{
					$usYear1 = $_GET['usYear1'];
				}
				if (!empty($_GET['usTitle2']))
				{
					$usTitle2 = $_GET['usTitle2'];
				}
				if (!empty($_GET['usArtist2']))
				{
					$usArtist2 = $_GET['usArtist2'];
				}
				if (!empty($_GET['usGenre2']))
				{
					$usGenre2 = $_GET['usGenre2'];
				}
				if (!empty($_GET['usYear2']))
				{
					$usYear2 = $_GET['usYear2'];
				}
				
				if (!empty($_GET['dsTitle']))
				{
					$dsTitle = $_GET['dsTitle'];
				}
				if (!empty($_GET['dsArtist']))
				{
					$dsArtist = $_GET['dsArtist'];
				}
				if (!empty($_GET['dsGenre']))
				{
					$dsGenre = $_GET['dsGenre'];
				}
				if (!empty($_GET['dsYear']))
				{
					$dsYear = $_GET['dsYear'];
				}
			}
			
			if ($csTitle != "" && $csArtist != "" && $csGenre != "" && $csYear != "")
			{
				$result = mysqli_query($connection, "SELECT Title FROM songs WHERE Title = '".$csTitle."'");
				$row = mysqli_fetch_row($result);
				if ($row[0] != $csTitle)
				{
					$query = "INSERT INTO songs VALUES ('".$csTitle."', '".$csArtist."', '".$csGenre."', '".$csYear."')";
					mysqli_query($connection, $query);
					mysqli_query($connection, 'INSERT INTO logs VALUES ("C", "'.$query.'", "'.$date.'")');
				}
			}
			
			if ($usTitle1 == "" && $usTitle2 == "")
			{
				if ($usArtist1 == "" && $usArtist2 == "")
				{
					if ($usGenre1 == "" && $usGenre2 == "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							#Nothing typed into update boxes by user
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Year = '".$usYear2."' WHERE Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
					if ($usGenre1 != "" && $usGenre2 != "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Genre = '".$usGenre2."' WHERE Genre = '".$usGenre1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Genre = '".$usGenre2."', Year = '".$usYear2."' WHERE Genre = '".$usGenre1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
				}
				if ($usArtist1 != "" && $usArtist2 != "")
				{
					if ($usGenre1 == "" && $usGenre2 == "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Artist = '".$usArtist2."' WHERE Artist = '".$usArtist1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Artist = '".$usArtist2."', Year = '".$usYear2."' WHERE Artist = '".$usArtist1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
					if ($usGenre1 != "" && $usGenre2 != "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Artist = '".$usArtist2."', Genre = '".$usGenre2."' WHERE Artist = '".$usArtist1."' AND Genre = '".$usGenre1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Artist = '".$usArtist2."', Genre = '".$usGenre2."', Year = '".$usYear2."' WHERE Artist = '".$usArtist1."' AND Genre = '".$usGenre1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
				}
			}
			if ($usTitle1 != "" && $usTitle2 != "")
			{
				if ($usArtist1 == "" && $usArtist2 == "")
				{
					if ($usGenre1 == "" && $usGenre2 == "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."' WHERE Title = '".$usTitle1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Year = '".$usYear2."' WHERE Title = '".$usTitle1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
					if ($usGenre1 != "" && $usGenre2 != "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Genre = '".$usGenre2."' WHERE Title = '".$usTitle1."' AND Genre = '".$usGenre1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Genre = '".$usGenre2."', Year = '".$usYear2."' WHERE Title = '".$usTitle1."' AND Genre = '".$usGenre1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
				}
				if ($usArtist1 != "" && $usArtist2 != "")
				{
					if ($usGenre1 == "" && $usGenre2 == "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Artist = '".$usArtist2."' WHERE Title = '".$usTitle1."' AND Artist = '".$usArtist1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Artist = '".$usArtist2."', Year = '".$usYear2."' WHERE Title = '".$usTitle1."' AND Artist = '".$usArtist1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
					if ($usGenre1 != "" && $usGenre2 != "")
					{
						if ($usYear1 == "" && $usYear2 == "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Artist = '".$usArtist2."', Genre = '".$usGenre2."' WHERE Title = '".$usTitle1."' AND Artist = '".$usArtist1."' AND Genre = '".$usGenre1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
						if ($usYear1 != "" && $usYear2 != "")
						{
							$query = "UPDATE songs SET Title = '".$usTitle2."', Artist = '".$usArtist2."', Genre = '".$usGenre2."', Year = '".$usYear2."' WHERE Title = '".$usTitle1."' AND Artist = '".$usArtist1."' AND Genre = '".$usGenre1."' AND Year = '".$usYear1."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("U", "'.$query.'", "'.$date.'")');
						}
					}
				}
			}
			
			
			if ($dsTitle == "" && $dsTitle == "")
			{
				if ($dsArtist == "" && $dsArtist == "")
				{
					if ($dsGenre == "" && $dsGenre == "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							#Nothing typed into update boxes by user
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
					if ($dsGenre != "" && $dsGenre != "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Genre = '".$dsGenre."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Genre = '".$dsGenre."' AND Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
				}
				if ($dsArtist != "" && $dsArtist != "")
				{
					if ($dsGenre == "" && $dsGenre == "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Artist = '".$dsArtist."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Artist = '".$dsArtist."' AND Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
					if ($dsGenre != "" && $dsGenre != "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Artist = '".$dsArtist."' AND Genre = '".$dsGenre."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Artist = '".$dsArtist."' AND Genre = '".$dsGenre."' AND Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
				}
			}
			if ($dsTitle != "" && $dsTitle != "")
			{
				if ($dsArtist == "" && $dsArtist == "")
				{
					if ($dsGenre == "" && $dsGenre == "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
					if ($dsGenre != "" && $dsGenre != "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Genre = '".$dsGenre."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Genre = '".$dsGenre."' AND Year = '".$usYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
				}
				if ($dsArtist != "" && $dsArtist != "")
				{
					if ($dsGenre == "" && $dsGenre == "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Artist = '".$dsArtist."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Artist = '".$dsArtist."' AND Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
					if ($dsGenre != "" && $dsGenre != "")
					{
						if ($dsYear == "" && $dsYear == "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Artist = '".$dsArtist."' AND Genre = '".$dsGenre."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
						if ($dsYear != "" && $dsYear != "")
						{
							$query = "DELETE FROM songs WHERE Title = '".$dsTitle."' AND Artist = '".$dsArtist."' AND Genre = '".$dsGenre."' AND Year = '".$dsYear."'";
							mysqli_query($connection, $query);
							mysqli_query($connection, 'INSERT INTO logs VALUES ("D", "'.$query.'", "'.$date.'")');
						}
					}
				}
			}

		?>
		<table>
			<tr>
				<td>
					<form name = "filter" id = "filter" action = "SongList2.php" method = "GET">
						<h3>Artist filter</h3>
							<input type = "text" name = "artistFilter" id = "artistFilter" value = "<?php echo $artistFilter;?>" style="width: 500px;">
						<h3>Genre filter</h3>
							<input type = "text" name = "genreFilter" id = "genreFilter" value = "<?php echo $genreFilter;?>" style="width: 500px;">
						<h3>Year filter</h3>
							<select name = "decadeFilter" class = "select" id = "decadeFilter" style="width: 500px;">
								<option value = "">All years</option>
								<option value = "1960">1960-1969</option>
								<option value = "1970">1970-1979</option>
								<option value = "1980">1980-1989</option>
								<option value = "1990">1990-1999</option>
								<option value = "2000">2000-2009</option>
								<option value = "2010">2010-2019</option>
								<option value = "2020">2020-2029</option>
							</select>
						<p align = "center">
							<input type = "submit"> 
						</p>			
					</form>
					<br><br>
					<div style = "text-align: center;">
						<input type = "button" value = "Create Song" onClick = "showCreate()">
						<input type = "button" value = "Update Song" onClick = "showUpdate()">
						<input type = "button" value = "Delete Song" onClick = "showDelete()">
					</div>
					
					<form name = "create" id = "create" action = "SongList2.php" method = "GET">
						<h3>Song Name</h3>
							<input type = "text" name = "csTitle" id = "cstitle" value = "<?php echo $csTitle;?>" style="width: 500px;">
						<h3>Song Artist</h3>
							<input type = "text" name = "csArtist" id = "csArtist" value = "<?php echo $csArtist;?>" style="width: 500px;">
						<h3>Song Genre</h3>
							<input type = "text" name = "csGenre" id = "csGenre" value = "<?php echo $csGenre;?>" style="width: 500px;">
						<h3>Song Year</h3>
							<input type = "text" name = "csYear" id = "csYear" value = "<?php echo $csYear;?>" style="width: 500px;">
						<p align = "center">
							<input type = "submit" value = "Create"> 
						</p>			
					</form>
					
					<form name = "update" id = "update" action = "SongList2.php" method = "GET" style="display: none;">
						<h3>Song Name</h3>
							<input type = "text" name = "usTitle1" id = "usTitle1" value = "<?php echo $usTitle1;?>" style="width: 200px;">
							-->
							<input type = "text" name = "usTitle2" id = "usTitle2" value = "<?php echo $usTitle2;?>" style="width: 200px;">
						<h3>Song Artist</h3>
							<input type = "text" name = "usArtist1" id = "usArtist1" value = "<?php echo $usArtist1;?>" style="width: 200px;">
							-->
							<input type = "text" name = "usArtist2" id = "usArtist2" value = "<?php echo $usArtist2;?>" style="width: 200px;">
						<h3>Song Genre</h3>
							<input type = "text" name = "usGenre1" id = "usGenre1" value = "<?php echo $usGenre1;?>" style="width: 200px;">
							-->
							<input type = "text" name = "usGenre2" id = "usGenre2" value = "<?php echo $usGenre2;?>" style="width: 200px;">
						<h3>Song Year</h3>
							<input type = "text" name = "usYear1" id = "usYear1" value = "<?php echo $usYear1;?>" style="width: 200px;">
							-->
							<input type = "text" name = "usYear2" id = "usYear2" value = "<?php echo $usYear2;?>" style="width: 200px;">
						<p align = "center">
							<input type = "submit" value = "Update"> 
						</p>			
					</form>
					
					<form name = "delete" id = "delete" action = "SongList2.php" method = "GET" style="display: none;">
						<h3>Song Name</h3>
							<input type = "text" name = "dsTitle" id = "dsTitle" value = "" style="width: 500px;">
						<h3>Song Artist</h3>
							<input type = "text" name = "dsArtist" id = "dsArtist" value = "" style="width: 500px;">
						<h3>Song Genre</h3>
							<input type = "text" name = "dsGenre" id = "dsGenre" value = "" style="width: 500px;">
						<h3>Song Year</h3>
							<input type = "text" name = "dsYear" id = "dsYear" value = "" style="width: 500px;">
						<p align = "center">
							<input type = "submit" value = "Delete"> 
						</p>			
					</form>
					<br><br>
					<div class = "scrollList" style = "height:190px;">
						<?php
							$c = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM logs"));
							$q = mysqli_query($connection, "SELECT * FROM logs");
							for ($i = 0; $i < $c; $i++)
							{
								$r = mysqli_fetch_array($q);
								echo $r['Date'];
								?> <br> <?php
								echo " - ".$r['Action'];
								?> <br> <br> <?php
							}
						?>
					</div>
				</td>
				<td>
					<h3 align = "center">Song List</h3>
					<div class = "scrollList">
						<?php
							$year1 = 0000;
							$year2 = 9999;
							if ($decadeFilter != "")
							{
								if ($decadeFilter == "1960")
								{
									$year1 = 1960;
									$year2 = 1969;
								}
								if ($decadeFilter == "1970")
								{
									$year1 = 1970;
									$year2 = 1979;
								}
								if ($decadeFilter == "1980")
								{
									$year1 = 1980;
									$year2 = 1989;
								}
								if ($decadeFilter == "1990")
								{
									$year1 = 1990;
									$year2 = 1999;
								}
								if ($decadeFilter == "2000")
								{
									$year1 = 2000;
									$year2 = 2009;
								}
								if ($decadeFilter == "2010")
								{
									$year1 = 2010;
									$year2 = 2019;
								}
								if ($decadeFilter == "2020")
								{
									$year1 = 2020;
									$year2 = 2029;
								}
							}
							$query2 = "";
							$count = mysqli_num_rows(mysqli_query($connection, "SELECT title, artist, genre, year FROM songs"));
							if ($artistFilter == "")
							{
								if ($genreFilter == "")
								{
									if ($decadeFilter == "")
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs");
									}
									else # $decadeFilter != ""
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE year >= '".$year1."' AND year <= '".$year2."'");
									}
								}
								else # $genreFilter != ""
								{
									if ($decadeFilter == "")
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE genre = '".$genreFilter."'");
									}
									else # $decadeFilter != ""
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE genre = '".$genreFilter."' AND year >= '".$year1."' AND year <= '".$year2."'");
									}
								}
							}
							else # $artistFilter != ""
							{
								if ($genreFilter == "")
								{
									if ($decadeFilter == "")
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE artist = '".$artistFilter."'");
									}
									else # $decadeFilter != ""
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE artist = '".$artistFilter."' AND year >= '".$year1."' AND year <= '".$year2."'");
									}
								}
								else # $genreFilter != ""
								{
									if ($decadeFilter == "")
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE artist = '".$artistFilter."' AND genre = '".$genreFilter."'");
									}
									else # $decadeFilter != ""
									{
										$query2 = mysqli_query($connection, "SELECT title, artist, genre, year FROM songs WHERE artist = '".$artistFilter."' AND genre = '".$genreFilter."' AND year >= '".$year1."' AND year <= '".$year2."'");
									}
								}
							}
							
							$songs = [];	
							for ($i = 0; $i < $count; $i++)
							{
								$row = mysqli_fetch_array($query2);
								echo mysqli_error($connection);
								if ($row["title"] == "")
								{
									break;
								}
								$filteredCount++;
								$sObj = new Song($row["title"], $row["artist"], $row["genre"], $row["year"]);
								array_push($songs, $sObj);
								$i++;
								echo "Song ".$i.":";
								?> <br> <?php
								echo " - ".$sObj->title;
								?> <br> <?php
								echo " - ".$sObj->artist;
								?> <br> <?php
								echo " - ".$sObj->genre;
								?> <br> <?php
								echo " - ".$sObj->year;
								?> <br> <br> <?php
								$i--;
								
								$artistCheck = false;
								$genreCheck = false;
								$yearCheck = false;
								
								for ($x = 0; $x < count($artistCounts); $x++)
								{
									if ($artistCounts[$x]->detail == $sObj->artist)
									{
										$artistCheck = true;
										$artistCounts[$x]->count++;
									}
								}
								for ($x = 0; $x < count($genreCounts); $x++)
								{
									if ($genreCounts[$x]->detail == $sObj->genre)
									{
										$genreCheck = true;
										$genreCounts[$x]->count++;
									}
								}
								for ($x = 0; $x < count($yearCounts); $x++)
								{
									if ($yearCounts[$x]->detail == $sObj->year)
									{
										$yearCheck = true;
										$yearCounts[$x]->count++;
									}
								}
								
								if (!$artistCheck)
								{
									$cObj = new CountObj($sObj->artist, 1);
									array_push($artistCounts, $cObj);
								}
								if (!$genreCheck)
								{
									$cObj = new CountObj($sObj->genre, 1);
									array_push($genreCounts, $cObj);
								}
								if (!$yearCheck)
								{
									$cObj = new CountObj($sObj->year, 1);
									array_push($yearCounts, $cObj);
								}
							}
						?>
					</div>
				</td>
				<td>
					<?php
						function customSort($x, $y)
						{
							if ($x->count == $y->count)
							{
								return 0;
							}
							if ($x->count > $y->count)
							{
								return -1;
							}
							if ($x->count < $y->count)
							{
								return 1;
							}
						}
					?>
					<h3 align = "center">Filters and their Counts</h3>
					<div class = "scrollList" style = "height:200px;">
						<?php
							usort($artistCounts, "customSort");
							foreach ($artistCounts as $x)
							{
								echo $x->detail." count: ".$x->count."<br>";
							}
						?>
					</div> <br>
					<div class = "scrollList" style = "height:200px;">
						<?php
							usort($genreCounts, "customSort");
							foreach ($genreCounts as $x)
							{
								echo $x->detail." count: ".$x->count."<br>";
							}
						?>
					</div> <br>	
					<div class = "scrollList" style = "height:200px;">
						<?php
							usort($yearCounts, "customSort");
							foreach ($yearCounts as $x)
							{
								echo $x->detail." count: ".$x->count."<br>";
							}
						?>
					</div>
					<?php
						echo "<br>Count of all songs: ".$filteredCount;
					?>
				</td>
			</tr>
		</table>
	</body>
</html>