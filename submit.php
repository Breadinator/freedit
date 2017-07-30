<!DOCTYPE html>
<html>
	<head>
		<title>Freedit | Submit</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<header>
			<form action="index.php" method="GET">
				<table align="center">
					<tr>
						<td><input name="id" type="text"></td>
						<td><input value="Go!" type="submit"></td>
					</tr>
				</table>
			</form>
		</header>

		<div id="main">

			<?php

				$text = $_POST["text"];

				if (!is_null($text)) {

					$text = stripcslashes($text);
					//$text = mysql_real_escape_string($text);
					
					$conn = mysql_connect("localhost", "username", "password") or die(mysql_error());

					if (!$conn) {
						echo "<p>Text not uploaded(connection failed).</p>";
					}

					mysql_select_db("freedit");

					$sql = 'INSERT INTO files (text) VALUES ("' . $text . '")';

					if (!$text == "") {
						$retval = mysql_query($sql, $conn);

						if ($retval) {
							$query = mysql_query("SELECT * FROM files");
							while ($row = mysql_fetch_assoc(($query)))
							{
								$data1 = $row["id"];
								$data2 = $row["text"];

								$id = null;
								if ($text == $data2) {
									$id = $data1;
								}
						}
							echo '<p>Text uploaded to ID <a href="index.php?id=' . $id . '">' . $id . '</a>!</p>';
						} else {
							echo "<p>Text not uploaded(couldn't insert text into database).</p>";
						}
					} else {
						echo "<p>Cannot upload an empty message!</p>";
					}

					mysql_close($conn);

				} 

			?>

			<hr />
				<form align="center" method="POST">
					<table align="center">
						<tr><td><textarea name="text" cols="48" rows="24"></textarea></td></tr>
						<tr><td><input type="submit" value="Submit" align="center"></td></tr>
					</table>	
				</form>
			<hr />
		</div>

		<footer>
			<table align="center">
				<tr>
					<td><a href="index.php">Home</a></td>
					<td><a href="submit.php">Submit</a></td>
					<td><a href="mailto:br3adina7or@gmail.com">Contact</a></td>
				</tr>
			</table>
		</footer>
	</body>
</html>
