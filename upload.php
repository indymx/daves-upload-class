<?php
require 'upload_class.php';
$upload = new upload_class();
?>
<html>
<head>
    <title>Upload Class</title>
    <style>
    #form-holder { width:500px; margin:auto;}
    </style>
</head>
<body>
<?php
if(isset($_POST)){
    $dir = __DIR__ .'/images';
    $upload->set_dir($dir);
    $upload->set_max(200000000);
    $upload->process_file($_FILES['file']);
}
?>
<div id="form-holder">
    <form action="" method="post" enctype="multipart/form-data">
    <p>Select a file:<br /><input type="file" name="file" id="file" class="" /></p>
    <div style="text-align:center;"><input type="submit" name="upload" value="Upload"/></div>
    </form>
</div>
</body>
</html>
