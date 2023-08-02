<!DOCTYPE html>
<html>
<head>
    <title>Pagina Login</title>
</head>
<body>
<!-- <input type="file" name="myfl" id="myfl" /> -->

<script>
    $(function () {
        $.get('/Input.txt', function (data) {
        words = data.split(' ');
        if(words[0] == "Pippo"){
            window.location.assign("Admin.php")
        }else{
            window.location.assign("Utente.php")
        }
        });
    });
	// document.getElementById('myfl').onchange = function(){
    // var myfl = this.files[0];
    // var reader = new FileReader();
    // reader.onload = function(progressEvent){
    //     console.log(this.result);
    // };
    // reader.readAsText(myfl);
    // };
</script>


</body>
</html>