<nav class="navbar navbar-expand-sm navbar-dark sticky-top"> <!-- justify-content-center -->
  <a class="navbar-brand" href="index.php">Book Your Ticket</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?page=home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=upcoming">UpComing Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=about">About</a>
      </li>
      <li>&nbsp;</li>
      <li>&nbsp;</li>
    </ul>
    	<?php
    		if (isset($_SESSION['userId'])) {
          if ($_SESSION['userStatus']==100) {
            echo '<button class="btn btn-success" onclick="window.location.href=\'?page=adminHome\'">'.$_SESSION['userName'].' Home</button>';
          } else {
            echo '<button class="btn btn-success" onclick="window.location.href=\'?page=userHome\'">'.$_SESSION['userName'].' Home</button>';
          }
    		} else {
    			echo '<button class="btn btn-success" onclick="window.location.href=\'?page=login\'">Login</button>';
    		}
    		if (isset($_SESSION['userId'])) { 
		    	echo '<button class="btn btn-danger" onclick="window.location.href=\'?page=logout\'">Logout</button>'; 
		    } 
    	?>
  </div>
</nav>