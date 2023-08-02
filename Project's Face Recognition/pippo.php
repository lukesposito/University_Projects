<?php 
$myverfile = fopen("./user.txt", "r") or die("Unable to open file!");
$verificate = file_get_contents("./user.txt");
$arr1 = str_split($verificate);
fclose($myverfile);
if($arr1[0] == "1"){
    #unlink("./user.txt");
    $resCode = 3;
    header("Location: Admin.php?resCode=".$resCode);	
}else if($arr1[0] >= "2" && $arr1[0] <= "9"){
    #unlink("./user.txt");
    $resCode = 3;
    header("Location: Utente.php?resCode=".$resCode);	
}else{
    #unlink("./user.txt");
    $resCode = 3;
    header("Location: Index.php?resCode=".$resCode);	
}
?>
