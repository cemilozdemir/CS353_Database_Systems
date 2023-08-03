<?php


// Get the file path from the form submission
$filepath = $_POST['filepath'];

// Set HTTP headers for viewing a PDF file
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename='myfile.pdf'");

// Read the PDF file from the server and output it to the browser
readfile($filepath);

?>