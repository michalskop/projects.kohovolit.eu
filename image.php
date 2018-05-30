<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <style>
    body {
<?php
$get = json_decode(base64_decode($_GET['p']));

echo 'background-image: url("images/' . $get->code . '.jpg");'

 ?>
 }
 .name {
     font-size: 3.8em;
         font-weight: bold;
         background-color: RGBA(255, 127, 0, 0.85)
 }
    </style>
  </head>
  <body>
      <div style="height:9em;">

      </div>
      <h1 class="name p-4 text-center">
          <?php echo $get->name; ?>
      </h1>


  </body>
</html>
