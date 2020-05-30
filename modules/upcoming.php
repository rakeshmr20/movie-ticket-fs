<?php
include_once 'utils/fileHandler.php';
$upcomingFH = new FileProcess('database/upcoming.txt');
?>
<div class="container">
	<div class="page-title">
		<h2>Upcoming Movies</h2>
	</div>
	<div class="row">
		<label>Bla Bla ... Bla Bla</label>
	</div>
	<div class="panel with-nav-tabs panel-success">
	    <div class="panel-body module">
	      <div class="tab-content">
	        <div class="tab-pane active" id="nowshowing">
	        	<div class="row">
					<?php 
				        $count=0;
				        $allMovies = $upcomingFH->getAllData();
				        foreach ($allMovies as $key => $movie) {
			          		echo " 
					            <div class='col-md-3 col-sm-12'>
					              <div class='card-container'>
					                <div class='card'>
					                  <div class='front'>
					                    <div class='cover'>
					                      <img alt='Movie Poster' src='upload/".$movie[5]."'/> 
					                    </div>
					                    <div class='content'>
					                      <div class='main'>
					                        <h3 class='name'>".$movie[1]."</h3>
					                        <p class='profession'><b>Genre: </b>".$movie[2]."</p>
					                        <p class='profession'><b>Director: </b> " .$movie[3]."</p>
					                      </div>
					                    </div>
					                  </div>
					                  <!-- end front panel -->
					                  <div class='back'>
					                    <div class='content'>
					                      <div class='main'>
					                        <h4 class='text-center'>".$movie[1]."</h4>
					                        <p class='text-center'>".$movie[4]." </p>
					                      </div>
					                    </div>
					                  </div> <!-- end card -->
					                </div> <!-- end card-container -->
					              </div>
					            </div>";
			          	}
			        ?>
			    </div>
	        </div>
	      </div>
	    </div>
	</div>
</div>