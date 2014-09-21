<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="authors" content="Hendro Wicaksono">
    <title>Perpustakaan Kemdikbud - Kcounter 02</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <h1>Kcounter 02</h1>



<?php
if ( (isset($_POST['jenis'])) AND (isset($_POST['barcode'])) ) {

  if (isset($_POST['jenis'])) {
    $request['jenis'] = $_POST['jenis'];
  }

  if (isset($_POST['barcode'])) {
    $request['barcode'] = trim ($_POST['barcode']);
  }

  #if (isset($_POST['institution'])) {
  #  $request['institution'] = trim ($_POST['institution']);
  #}

  #$data = array("name" => "Hagrid", "age" => "36");                                                                    
  $data_string = json_encode($request);                                                                                   
 
  $ch = curl_init('http://localhost/api-pkemdikbud/kcounter02');                                                                      
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
  );                                                                                                                   

  $result = curl_exec($ch);
  $result = json_decode($result);
  #var_dump($result);
?>

        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Warning!</strong> <?php echo $result->message; ?>
        </div>

<?php
}

?>

        <form role="form" method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
          <div class="form-group">
            <label for="jenis">Jenis</label>
            <select class="form-control" id='jenis' name='jenis'>
              <option>Buku</option>
              <option>Audio Visual</option>
            </select>
          </div>

          <div class="form-group">
            <label for="id_number">Barcode</label>
            <input type="text" class="form-control" id="barcode" name='barcode' placeholder="Enter Barcode" autofocus required>
          </div>
          <!--<div class="form-group">
            <label for="institution">Institution</label>
            <input type="text" class="form-control" id="institution" name='institution' placeholder="Institution">
          </div>-->
          <button type="submit" class="btn btn-default">Submit</button>
        </form>

      </div>
  <div class="col-md-4"></div>
</div>
<hr />
<?php 
#echo json_encode($request);
?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>