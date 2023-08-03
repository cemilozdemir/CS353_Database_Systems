<html>
<head>
  <style>
    /* Add a black line to split the page vertically */
	.split {
  	 height: 100%;
  	 width: 50%;
  	 position: fixed;
 	 z-index: 1;
 	 top: 0;
 	 overflow-x: hidden;
	 padding-top: 20px;
	}

	/* Style the left half of the page */
	.left {
     left: 0;
  	 background-color: #fff;
  	 border-right: 1px solid black;  /* Add a border to the right side of the left half */
	}

	/* Style the right half of the page */
	.right {
  	 right: 0;
  	 background-color: #fff;
  	 border-left: 1px solid black;  /* Add a border to the left side of the right half */
	}
  	.user-info p {
  	 font-size: 18px;
  	 font-weight: bold;
  	 color: #333;
  	 border: 1px solid #ccc;
  	 border-radius: 4px;
  	 padding: 5px;
	}
	
    .text-table td {
  	 border: 1px solid #ddd;
  	 text-align: center;
  	 padding: 10px 20px;  /* Add 10 pixels of padding to the top and bottom, and 20 pixels to the left and right */
	}
   
  </style>
</head>
<body>
  <div class="split left">
  	<img src="path/to/image.jpg" alt="Profile picture" style="border-radius: 50%;">
  <div style="position: absolute; right: 0;">
    <?php
      // Connect to the database and retrieve the user name
      $user_name = "John Doe";  // Replace this with the actual user name
      // Output the user name
      echo "<p>$user_name</p>";
    ?>
  	</div>
	</div>

  </div>
  <div class="split right">
  <table>
    <tr>
      <td>
        <?php
          // Connect to the database and retrieve the first text
          $text1 = "Text 1";  // Replace this with the actual text

          // Output the first text
          echo $text1;
        ?>
      </td>
      <td>
        <?php
          // Connect to the database and retrieve the second text
          $text2 = "Text 2";  // Replace this with the actual text

          // Output the second text
          echo $text2;
        ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php
          // Connect to the database and retrieve the third text
          $text3 = "Text 3";  // Replace this with the actual text

          // Output the third text
          echo $text3;
        ?>
      </td>
      <td>
        <?php
          // Connect to the database and retrieve the fourth text
          $text4 = "Text 4";  // Replace this with the actual text

          // Output the fourth text
          echo $text4;
        ?>
      </td>
    </tr>
  </table>
</div>

</body>
</html>
