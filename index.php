<!DOCTYPE html>
<html>
	<head>
		<title>Freedit | Home</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<header>
			<form>
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

				echo "<hr />";

				$id = $_GET["id"];

				if (is_null($id)) {
					echo '<p>Welcome to Freedit! For some help, go <a href="?id=1">here</a>.</p><br /><br /><br />';
					echo 'Great posts: ';
					echo '<a href="?id=9">9</a>, ';
					echo '<a href="?id=19">19</a>.';
					echo "<hr />";
				} else {
				
					if (!ctype_digit($id)) {
						echo "<p>IDs can only be integers.</p>";
						echo "<hr />";
					} else {

						mysql_connect("localhost", "username", "password") or die(mysql_error());
						mysql_select_db("freedit");

						$query = mysql_query("SELECT * FROM files");

						$found = false;
						while ($row = mysql_fetch_assoc(($query)))
						{
							$data1 = $row["id"];
							$data2 = $row["text"];

							if ($id == $data1)
							{
								$found = true;
								echo "<p>$data2</p>";
								echo "<hr />";
							}
						}

						if (!$found) {
							echo "<p>File with the ID $id not found.</p>";
							echo "<hr />";
						}

						mysql_close();
					}
				}

			?>
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
