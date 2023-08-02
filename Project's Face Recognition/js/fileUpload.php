

 <?php
 $dir = "./Face_recog/random_photos/";
 $filename = $dir.basename($_FILES['Upload']['name']);

 echo "<br><br>";

 if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
  echo "<p>The HTML5 and php file upload was a success! -->".$_FILES['Upload']['name']; 
} else { 
  echo "The php and HTML5 file upload failed.".$_FILES['Upload']['name']; 
}

echo "<p>Information about file from $_FILE array</p>";
echo "File Name: ".$_FILES['Upload']['name']."<br>";
echo "File Type: ".$_FILES['Upload']['type']."<br>";
echo "File Size: ".$_FILES['Upload']['size']."kB<br>";

$output = shell_exec('python3 face_recognition-ex1.py');

echo $output;
?>




