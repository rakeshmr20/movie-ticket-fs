<?php
include_once 'utils/fileHandler.php';
$movieFH = new FileProcess('database/movies.txt');
$userId = 'none';
if (isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
}
?>
<div class="container">
	<div class="page-title">
		<h2>Showing Movies</h2>
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
			          $allMovies = $movieFH->getAllData();
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

					                        <p><b>IMDB: </b>".$movie[6]."</p>

					                        <p class='profession'><b>Genre: </b>".$movie[2]."</p>

					                        <p class='profession'><b>Director: </b> " .$movie[3]."</p>
					                        <p class='profession'><b>Price: </b> " .$movie[7]." Rs/Seat only.</p>

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
					                      <div style='margin-top: 4vw;' class='buy_ticket'>
					                        <a href='?page=book&movieId=".$movie[0]."&userId=".$userId."' class='btn btn-primary btn-xs btn-block'>Click to book ticket</a>
					                      </div>
					                    </div>
					                  </div> <!-- end card -->
					                </div> <!-- end card-container -->
					              </div>
					            </div>";
			          } ?>
			    </div>
	        </div>
	      </div>
	    </div>
	</div>
</div>
