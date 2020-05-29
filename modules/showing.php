<?php
include_once 'utils/fileHandler.php';
$fileHandler = new FileProcess('database/movies.txt');
?>
<div class="container">
	<div class="page-title">
		<h2>Showing Movies</h2>
	</div>
	<div class="row">
		<?php
			// Display all showing movies
			
			$allMoviesData = $fileHandler->readFile();
			if ($allMoviesData) {
				echo($allMoviesData);
			} else {
				echo "No Data<br>";
			}
			
		?>
	</div>
</div>