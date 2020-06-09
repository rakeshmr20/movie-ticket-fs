<?php
// Developed by Rakesh M R
include 'utils/fileHandler.php';

$movieFH = new FileProcess('database/movies.txt');
$upcomingFH = new FileProcess('database/upcoming.txt');
$theatreFH = new FileProcess('database/theatres.txt');
$timeFH = new FileProcess('database/timings.txt');
$ticketFH = new FileProcess('database/tickets.txt');
$AdmUsr = new UserManagement();
// print_r($_SESSION);
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
<div class="container text-center">
	<div class="module bg-primary text-center">
		<h2>Admin Panel: <?php echo($_SESSION['userName']); ?></h2>
	  	<label id="errorMessage" class="errorMessage">
	  		<?php 
			    if(isset($_SESSION['errMsg'])){ echo($_SESSION['errMsg']); 
			    unset($_SESSION['errMsg']);} 
			?>
		</label>
	</div>
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
            		<h4 class="text-center">Movies Showing</h4>
            		<?php
            			$allMovies = $movieFH->getAllData();
            			// print_r($allMovies);
            			if ($allMovies) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Movie Name</th><th>Genre</th><th>Director</th><th>Description</th><th>IMDB</th><th>Price</th><th>Delete</th></tr></thead><tbody>';
            				foreach ($allMovies as $skey => $singleMovie) {
            					$td = '<td>'.++$skey.'</td>';
            					for ($i=0; $i < count($singleMovie); $i++) { 
            						if ($i == 0 || $i == 5) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$singleMovie[$i].'</td>';
            						}
            					}
                                $td = $td.'<td><form method="post" action="adminProcess.php"><input type="hidden" name="delId" value="'.$singleMovie[0].'"><input type="submit" name="delMovie" value="Remove" class="btn btn-danger"></form></td>';
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
            		<h4 class="text-center">User Count</h4>
            		<?php
            			$adminCount = $AdmUsr->getUserCount('100');
            			$userCount = $AdmUsr->getUserCount('200');
            			echo '<h5>Number of Admins: '.$adminCount.'</h5>';
            			echo '<h5>Number of Users: '.$userCount.'</h5>';
            			echo '<h5>Total Tickets: '.$ticketFH->countTotalTickets().'</h5>';
            		?>
            	</div>
            </div>
            <div class="row module">
                <h4>Tickets -- User</h4>
                <?php
                    // to show tickets for every user
                    $thandler = fopen('database/users.txt', 'a+');
                    $tallUsers = fread($thandler, filesize('database/users.txt'));
                    // print_r($tallUsers);
                    $allUsersArray = explode("|", $tallUsers, -1);
                    $tr = '';
                    $cct = 0;
                    echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>User Name</th><th>Ticket Count</th></tr></thead><tbody>';
                    foreach ($allUsersArray as $key => $value) {
                        $tr = '';
                        $tuserData = explode("~", $value, -1);
                        if ($tuserData[3] !='100') {
                            $tucount = $ticketFH->countUserTickets($tuserData[0]);
                            $td = '<td>'.++$cct.'</td><td>'.$tuserData[1].'</td><td>'.$tucount.'</td>';
                            $tr = $tr.'<tr>'.$td.'</tr>';
                            echo($tr);
                        }
                    }
                    echo '</tbody></table>';
                ?>
            </div>
            <div class="row module">
            	<div class="col-md-6">
            		<h4 class="text-center">Theatres List with Available Seats</h4>
            		<?php
	            		$allTheatres = $theatreFH->getAllData();
            			// print_r($allMovies);
            			if ($allTheatres) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Theatre Name</th><th>Seats</th><th>Delete</th></tr></thead><tbody>';
            				foreach ($allTheatres as $trkey => $singleTheatre) {
            					$td = '<td>'.++$trkey.'</td>';
            					for ($i=0; $i < count($singleTheatre); $i++) { 
            						if ($i == 0) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$singleTheatre[$i].'</td>';
            						}
            					}
                                $td = $td.'<td><form method="post" action="adminProcess.php"><input type="hidden" name="delId" value="'.$singleTheatre[0].'"><input type="submit" name="delTheatre" value="Remove" class="btn btn-danger"></form></td>';
            					$tr = $tr.'<tr>'.$td.'</tr>';
            				}
            				echo $tr.'</tbody></table>';
            			} else {
            				echo '<label class="successMessage">No Theatre Found..!</label>';
            			}
            		?>
            	</div>
            	<div class="col-md-1"></div>
            	<div class="col-md-5">
            		<h4 class="text-center">Show Timings</h4>
            		<?php
			  			$timeData = $timeFH->getAllData();
			  			if ($timeData) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Show Timings</th><th>Delete</th></tr></thead><tbody>';
            				foreach ($timeData as $tkey => $aTime) {
            					$td = '<td>'.++$tkey.'</td>';
            					for ($i=0; $i < count($aTime); $i++) { 
            						if ($i == 0 || $i == 2) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$aTime[$i].'</td>';
            						}
            					}
                                $td = $td.'<td><form method="post" action="adminProcess.php"><input type="hidden" name="delId" value="'.$aTime[0].'"><input type="submit" name="delTime" value="Remove" class="btn btn-danger"></form></td>';
            					$tr = $tr.'<tr>'.$td.'</tr>';
            				}
            				echo $tr.'</tbody></table>';
            			} else {
            				echo '<label class="successMessage">No Show Time Found..!</label>';
            			}
			  		?>
            	</div>
            </div>
            <div class="row module">
            	<div class="col-md-8">
            		<h4 class="text-center">Upcoming Movies List</h4>
            		<?php
            			$allUpMovies = $upcomingFH->getAllData();
            			// print_r($allMovies);
            			if ($allMovies) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Movie Name</th><th>Genre</th><th>Director</th><th>Description</th><th>Delete</th></tr></thead><tbody>';
            				foreach ($allUpMovies as $skey => $singleUpMovie) {
            					$td = '<td>'.++$skey.'</td>';
            					for ($i=0; $i < count($singleUpMovie); $i++) { 
            						if ($i == 0 || $i == 5) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$singleUpMovie[$i].'</td>';
            						}
            					}
                                $td = $td.'<td><form method="post" action="adminProcess.php"><input type="hidden" name="delId" value="'.$singleUpMovie[0].'"><input type="submit" name="delUpcoming" value="Remove" class="btn btn-danger"></form></td>';
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
            		<h4 class="text-center">Total Upcoming Movies</h4>
            		<p><?php echo(count($allUpMovies)); ?></p>
            	</div>
            </div>
        </div>
        <div class="tab-pane fade" id="addMovie">
            <div class="container module">
			  <form action="adminProcess.php" name="addMovie-form" method="post" enctype="multipart/form-data" style="max-width:500px;margin:auto">
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
			      <input name="imdb" placeholder="IMDB Rating" type="text" min="1" max="10" required>
			    </div>
			    <div class="input-container">
			      <label>Price: </label>
			      <input name="price" placeholder="Price" type="text" required>
			    </div>
			    <div class="input-container">
			      <label>Description: </label>
			      <textarea name="description" placeholder="Description" type="textArea" required></textarea>
			    </div>
			    <div class="input-container">
			      <label>Image: </label>
			      <input style="padding: 10px;" type="file" name="imageFile" id="imageFile" required>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Movie" name="addMovie">
			    </div>
			  </form>
			</div>
        </div>
        <div class="tab-pane fade" id="addUpcoming">
            <div class="container module">
			  <form action="adminProcess.php" name="addUpcoming-form" method="post" enctype="multipart/form-data" style="max-width:500px;margin:auto">
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
			      <input style="padding: 10px;" type="file" name="imageFile" id="imageFile" required>
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
			      <label>Seats [1-500] : </label>
			      <input style="padding: 10px;" type="number" min="1" max="500" name="seats" required>
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
			      <input class="input-field" id="time" type="time" name="stime" value="09:00" required>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Show Timing" name="addTimings">
			    </div>
			  </form>
			  <div>
			  		<?php
			  			$timeData = $timeFH->getAllData();
			  			if ($timeData) {
            				$tr = '';
            				echo '<table class="table table-bordered"><thead><tr><th>Sl. No</th><th>Show Timings</th></tr></thead><tbody>';
            				foreach ($timeData as $tkey => $aTime) {
            					$td = '<td>'.++$tkey.'</td>';
            					for ($i=0; $i < count($aTime); $i++) { 
            						if ($i == 0 || $i == 2) {
            							continue;
            						} else {
            							$td = $td.'<td>'.$aTime[$i].'</td>';
            						}
            					}
            					$tr = $tr.'<tr>'.$td.'</tr>';
            				}
            				echo $tr.'</tbody></table>';
            			} else {
            				echo '<label class="successMessage">No Show Time Found..!</label>';
            			}
			  		?>
			  </div>
			</div>
        </div>
    </div>
    <hr>
    <p class="text-danger module">* Only admin is privileged to add any content.</p>
    <!--<p class="active-tab"><strong>Active Tab</strong>: <span></span></p>
    <p class="previous-tab"><strong>Previous Tab</strong>: <span></span></p>-->
</div>