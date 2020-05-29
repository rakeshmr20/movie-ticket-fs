<?php
// Developed by Rakesh M R
include 'utils/fileHandler.php';

$movieFH = new FileProcess('database/movies.txt');
$upcomingFH = new FileProcess('database/upcoming.txt');
$AdmUsr = new UserManagement();
print_r($_SESSION);
if ($_SESSION['userStatus']==='200') {
	echo "<script>window.location.href='?page=userHome';</script>";
    exit;
}
else if ($_SESSION['userStatus']!='100') {
	echo "<script>window.location.href='?page=home';</script>";
    exit;
}


?>
<script type="text/javascript">
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            var activeTab = $(e.target).text(); // Get the name of active tab
            var previousTab = $(e.relatedTarget).text(); // Get the name of previous tab
            // $(".active-tab span").html(activeTab);
            // $(".previous-tab span").html(previousTab);
        });
    });
</script>
<div class="container">
  <h2>Admin Panel: <?php echo($_SESSION['userName']); ?></h2>
  	<label id="errorMessage" class="errorMessage">
  		<?php 
		    if(isset($_SESSION['errMsg'])){ echo($_SESSION['errMsg']); 
		    unset($_SESSION['errMsg']);} 
		?>
	</label>
  <ul id="myTab" class="nav nav-tabs">
        <li class="nav-item">
            <a href="#home" class="nav-link active" data-toggle="tab">Home</a>
        </li>
        <li class="nav-item">
            <a href="#addMovie" class="nav-link" data-toggle="tab">Add Movies</a>
        </li>
        <li class="nav-item">
            <a href="#addUpcoming" class="nav-link" data-toggle="tab">Add Upcoming Movies</a>
        </li>
        <li class="nav-item">
            <a href="#addTheatre" class="nav-link" data-toggle="tab">Add Theatres</a>
        </li>
        <li class="nav-item">
            <a href="#addTimings" class="nav-link" data-toggle="tab">Add Show Timings</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="home">
            <h4 class="mt-2"></h4>
            <div class="row module">
            	<div class="col-md-8">
            		<h4>Movies Showing</h4>
            		<?php
            			$allMovies = $movieFH->getAllData();
            			// print_r($allMovies);
            			if ($allMovies) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Movie Name</th><th>Genre</th><th>Director</th><th>Description</th><th>IMDB</th><th>Price</th></tr></thead><tbody>';
            				foreach ($allMovies as $skey => $singleMovie) {
            					$td = '<td>'.++$skey.'</td>';
            					for ($i=0; $i < count($singleMovie); $i++) { 
            						if ($i == 0 || $i == 5) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$singleMovie[$i].'</td>';
            						}
            					}
            					$tr = $tr.'<tr>'.$td.'</tr>';
            				}
            				echo $tr.'</tbody></table>';
            			} else {
            				echo '<label class="successMessage">No Movie Data Found..!</label>';
            			}
            		?>
            	</div>
            	<div class="col-md-1"></div>
            	<div class="col-md-3">
            		<h4>User Count</h4>
            		<?php
            			$adminCount = $AdmUsr->getUserCount('100');
            			$userCount = $AdmUsr->getUserCount('200');
            			echo '<h5>Number of Admins: '.$adminCount.'</h5>';
            			echo '<h5>Number of Users: '.$userCount.'</h5>';
            		?>
            	</div>
            </div>
            <div class="row module">
            	<div class="col-md-6">
            		<h4>Tickets Booked</h4>
            	</div>
            	<div class="col-md-1"></div>
            	<div class="col-md-5">
            		<h4>Theatres List with Available Seats</h4>
            		<?php
	            		$aMovie = $movieFH->getSingleData('5ed15ba9c934a');
	            		print_r($aMovie);
            		?>
            	</div>
            </div>
            <div class="row module">
            	<div class="col-md-8">
            		<h4>Upcoming Movies List</h4>
            		<?php
            			$allUpMovies = $upcomingFH->getAllData();
            			// print_r($allMovies);
            			if ($allMovies) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Movie Name</th><th>Genre</th><th>Director</th><th>Description</th></tr></thead><tbody>';
            				foreach ($allUpMovies as $skey => $singleUpMovie) {
            					$td = '<td>'.++$skey.'</td>';
            					for ($i=0; $i < count($singleUpMovie); $i++) { 
            						if ($i == 0 || $i == 5) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$singleUpMovie[$i].'</td>';
            						}
            					}
            					$tr = $tr.'<tr>'.$td.'</tr>';
            				}
            				echo $tr.'</tbody></table>';
            			} else {
            				echo '<label class="successMessage">No Movie Data Found..!</label>';
            			}
            		?>
            	</div>
            	<div class="col-md-1"></div>
            	<div class="col-md-3">
            		<h4>Total Upcoming Movies</h4>
            		<p><?php echo(count($allUpMovies)); ?></p>
            	</div>
            </div>
        </div>
        <div class="tab-pane fade" id="addMovie">
            <div class="container module">
			  <form action="adminProcess.php" name="addMovie-form" method="post" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Add a Movie</h2>
			    <input type="hidden" name="form-type" value="addMovie">
			    <div class="input-container">
			      <label>Movie Name: </label>
			      <input class="input-field" type="text" placeholder="Movie Name" name="mname" required autofocus>
			    </div>
			    <div class="input-container">
			      <label>Genre: </label>
			      	<select class="MovieGenre" name="Genre">
						<option value="Action">Action</option>
						<option value="Adventure">Adventure</option>
						<option value="Comedy">Comedy</option>
						<option value="Crime">Crime</option>
						<option value="Drama">Drama</option>
					</select>
			    </div>
			    <div class="input-container">
			      <label>Director: </label>
			      <input class="input-field" type="text" placeholder="Director Name" name="dname" required>
			    </div>
			    <div class="input-container">
			      <label>IMDB: </label>
			      <input name="imdb" placeholder="IMDB Rating" type="text" min="1" max="10" tabindex="1" required>
			    </div>
			    <div class="input-container">
			      <label>Price: </label>
			      <input name="price" placeholder="Price" type="text" required>
			    </div>
			    <div class="input-container">
			      <label>Description: </label>
			      <textarea name="description" placeholder="Description" type="textArea" tabindex="1" required></textarea>
			    </div>
			    <div class="input-container">
			      <label>Image: </label>
			      <input style="padding: 10px;" type="file" name="image" required>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Movie" name="addMovie">
			    </div>
			  </form>
			</div>
        </div>
        <div class="tab-pane fade" id="addUpcoming">
            <div class="container module">
			  <form action="adminProcess.php" name="addUpcoming-form" method="post" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Add Upcoming Movie</h2>
			    <input type="hidden" name="form-type" value="addUpcoming">
			    <div class="input-container">
			      <label>Movie Name: </label>
			      <input class="input-field" type="text" placeholder="Movie Name" name="umname" required autofocus>
			    </div>
			    <div class="input-container">
			      <label>Genre: </label>
			      	<select class="MovieGenre" name="uGenre">
						<option value="Action">Action</option>
						<option value="Adventure">Adventure</option>
						<option value="Comedy">Comedy</option>
						<option value="Crime">Crime</option>
						<option value="Drama">Drama</option>
					</select>
			    </div>
			    <div class="input-container">
			      <label>Director: </label>
			      <input class="input-field" type="text" placeholder="Director Name" name="udname" required>
			    </div>
			    <div class="input-container">
			      <label>Description: </label>
			      <textarea name="udescription" placeholder="Description" type="textArea" required></textarea>
			    </div>
			    <div class="input-container">
			      <label>Image: </label>
			      <input style="padding: 10px;" type="file" name="uimage" required>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Upcoming Movie" name="addUpcoming">
			    </div>
			  </form>
			</div>
        </div>
        <div class="tab-pane fade" id="addTheatre">
            <div class="container module">
			  <form action="adminProcess.php" name="addUpcoming-form" method="post" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Add Theatres</h2>
			    <input type="hidden" name="form-type" value="addTheatre">
			    <div class="input-container">
			      <label>Theatre Name: </label>
			      <input class="input-field" type="text" placeholder="Theatre Name" name="tname" required autofocus>
			    </div>
			    <div class="input-container">
			      <label>Seats: </label>
			      <input style="padding: 10px;" type="number" name="seats" required>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Theatre" name="addTheatre">
			    </div>
			  </form>
			</div>
        </div>
        <div class="tab-pane fade" id="addTimings">
            <div class="container module">
			  <form action="adminProcess.php" name="addUpcoming-form" method="post" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Add Show Timings</h2>
			    <input type="hidden" name="form-type" value="addTimings">
			    <div class="input-container">
			      <label>Show Time: </label>
			      <input class="input-field" type="text" placeholder="showtime" name="tname" required autofocus>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Show Timing" name="addTimings">
			    </div>
			  </form>
			</div>
        </div>
    </div>
    <hr>
    <p class="text-danger module">* Only admin is privileged to add any content.</p>
    <!--<p class="active-tab"><strong>Active Tab</strong>: <span></span></p>
    <p class="previous-tab"><strong>Previous Tab</strong>: <span></span></p>-->
</div>