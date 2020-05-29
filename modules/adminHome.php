<?php
// Developed by Rakesh M R


print_r($_SESSION);

if (isset($_POST['addMovie'])) {
	echo "ADD MOVIE";
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
            	<div class="col-md-6">
            		<h4>Movies Showing</h4>
            	</div>
            	<div class="col-md-6">
            		<h4>Theatres List with Available Seats</h4>
            	</div>
            </div>
            <div class="row module">
            	<div class="col-md-6">
            		<h4>Tickets Booked</h4>
            	</div>
            	<div class="col-md-6">
            		<h4>User Count</h4>
            	</div>
            </div>
        </div>
        <div class="tab-pane fade" id="addMovie">
            <div class="container module">
			  <form action="" name="addMovie-form" method="post" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Add a Movie</h2>
			    <input type="hidden" name="form-type" value="registration">
			    <label id="errorMessage" class="errorMessage"><?php 
			      if(isset($_SESSION['errMsg'])){ echo($_SESSION['errMsg']); 
			      unset($_SESSION['errMsg']);} ?>
			    </label>
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
			      <input style="padding: 10px;" type="file" name="image" required autofocus>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Movie" name="addMovie">
			    </div>
			  </form>
			</div>
        </div>
        <div class="tab-pane fade" id="addUpcoming">
            <div class="container module">
			  <form action="" name="addUpcoming-form" method="post" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Add Upcoming Movie</h2>
			    <input type="hidden" name="form-type" value="registration">
			    <label id="errorMessage" class="errorMessage"><?php 
			      if(isset($_SESSION['errMsg'])){ echo($_SESSION['errMsg']); 
			      unset($_SESSION['errMsg']);} ?>
			    </label>
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
			      <label>Description: </label>
			      <textarea name="description" placeholder="Description" type="textArea" required></textarea>
			    </div>
			    <div class="input-container">
			      <label>Image: </label>
			      <input style="padding: 10px;" type="file" name="image" required autofocus>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" onclick="return validform()" value="Add Upcoming Movie" name="addUpcoming">
			    </div>
			  </form>
			</div>
        </div>
        <div class="tab-pane fade" id="addTheatre">
            <h4 class="mt-2">Messages tab content</h4>
            <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
        </div>
        <div class="tab-pane fade" id="addTimings">
            <h4 class="mt-2">Messages tab content</h4>
            <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
        </div>
    </div>
    <hr>
    <p class="text-danger module">Only admin is privileged to add any content.</p>
    <!--<p class="active-tab"><strong>Active Tab</strong>: <span></span></p>
    <p class="previous-tab"><strong>Previous Tab</strong>: <span></span></p>-->
</div>