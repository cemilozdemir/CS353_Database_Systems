<html>
<head>
  <title>Main Page</title>
  <style>
    /* Add some style to the navigation bar */
     .navbar {
  		display: flex;
  		align-items: center;
  		justify-content: center; /* center horizontally */
  		font-size: 18px;
  		color: black;
    }

    .navbar a {
  		display: flex;
  		align-items: center;
  		color: black;
  		text-decoration: none;
  		padding: 10px 20px;
        position: relative;
    }

    .navbar a:hover {
      padding: 0 20px;
    }
    /* Add a solid line under the text */
	.navbar a::before {
  		content: "";
  		position: absolute;
 	    bottom: 0;
		left: 0;
	    right: 0;
  		height: 2px;
  		background-color: blue;
  		transform: scaleX(0); /* initially hide the line */
  		transition: transform 250ms ease-in-out; /* add a transition effect */
	}

	/* Show the line when the cursor is hovering over the element */
	.navbar a:hover::before {
 		 transform: scaleX(1); /* show the line */
	}

    /* Add some style to the search field */
    .search-form {
  		display: flex;
  		align-items: center;
  		justify-content: center;
        margin-top: 20px; /* add a top margin to the search field */
  		margin-bottom: 20px;
    }

    .search-form input[type=text] {
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 5px 0 0 5px;
    }

    .search-form input[type=submit] {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      background-color: #0066ff;
      color: white;
      border-radius: 0 5px 5px 0;
    }

    .search-form input[type=submit]:hover {
      background-color: #003399;
    }
    .card-container {
 	  display: flex; /* display the cards as a flexbox */
  	  overflow-x: auto; /* add horizontal scrollbars */
      padding: 20px 0; /* add padding to the top and bottom of the container */
	}

	.card {
      width: 600px; /* set the width of the cards */
  	  height: 200px; /* set the height of the cards */
  	  background-color: #eee; /* set the background color to gray */
  	  border: 1px solid #ddd;
      padding: 30px 30px;
  	  margin: 0 20px; /* add some space between the cards */
	}	
    
    .card-text {
  	  text-align: center;
  	  font-size: 18px;
	}
    .card-container-title {
  	  font-style: italic; /* make the font italic */
	}
    
    .profile-photo-container {
 	  position: absolute; /* position the container absolutely */
  	  top: 20px; /* add a 20-pixel padding from the top of the screen */
  	  right: 20px; /* add a 20-pixel padding from the right of the screen */
	}

	.profile-photo {
  	  border-radius: 50%; /* round the corners of the photo */
  	  width: 80px; /* set the width of the photo */
  	  height: 80px; /* set the height of the photo */
	}
    
  </style>
</head>
<body>
  <!-- Navigation bar -->
  <div class="navbar">
    <a href="#">HomePage</a>
    <a href="#">Books</a>
    <a href="#">Forum</a>
    <a href="#">Reviews</a>
    <a href="#">Profile</a>
    <a href="#">Logout</a>
  </div>

  <!-- Search field -->
  <form class="search-form" action="#">
    <input type="text" placeholder="Search...">
    <input type="submit" value="Search">
  </form>
  <!-- Card container -->
  <h3 class="card-container-title">Classics</h3>
  <div class="card-container">
  <!-- Card 1 -->
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  

  <!-- Card 2 -->
  <div class="card">
 	<div class="card-text">Card</div>
  </div>

  <!-- Card 3 -->
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  
  <div class="card">
 	<div class="card-text">Card</div>
  </div>

  <!-- Add more cards here -->
  </div>
  
  <!-- Card container -->
  <h3 class="card-container-title">Popular</h3>
  <div class="card-container">
  <!-- Card 1 -->
  <div class="card">
 	<div class="card-text">Card</div>
  </div>

  <!-- Card 2 -->
  <div class="card">
 	<div class="card-text">Card</div>
  </div>

  <!-- Card 3 -->
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  
  <div class="card">
 	<div class="card-text">Card</div>
  </div>
  
  <div class="card">
 	<div class="card-text">Card</div>
  </div>

  <!-- Add more cards here -->
  </div>
  
  <div class="profile-photo-container">
  	<img src="/Users/appsamurai/Downloads/DSC08591.jpg" class="profile-photo" alt="Profile Photo">
  </div>
  
</body>
</html>
