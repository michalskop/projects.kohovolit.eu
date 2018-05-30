<!doctype html>
<html lang="cs">
  <head>
    <title>Projekty KohoVolit.eu</title>
    <link rel="icon" href="https://volebnikalkulacka.azureedge.net/cs/prezidentske-volby-2018/statics/favicon.ico" type="image/x-icon" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


    <style>
    body {

     }
     .name {
         font-size: 3.8em;
             font-weight: bold;
             background-color: RGBA(255, 127, 0, 0.85)
     }
     .card {
         width: 320px;
     }
    </style>

    <script>
          $(function() {
              $('#target').click(function(){
                  $('#jumbotron').hide(400);
                  $('#registered').show(400);
                  $.ajax({
                      url: 'emails.php',
                    //   url: 'http://localhost/michal/project/volebnikalkulacka.cz/www/prezidentske-volby-2018/match/emails.php',
                      type: 'get',
                      data: {
                          vkid: '<?php if (isset($_GET['vkid'])) {echo $_GET['vkid'];} ?>',
                          calc: 'projects',
                          campaign: 'projects_jumbotron',
                          value: $('#registration-email').val(),
                          type: 'email',
                          attributes: JSON.stringify({
                              regpo: $('#registration-postcode').val(),
                              regre: $('#registration-remind').is(":checked"),
                              regmo: $('#registration-more').is(":checked")
                          })
                      }
                  });

              });
              $('#registered').click(function() {
                  $('#registered').hide(400);
                  $('#jumbotron').show(400);
              });

          })
    </script>


  </head>
  <body>

      <h1 class="name p-4 text-center">
          Projekty KohoVolit.eu
      </h1>


<!-- jumbotron -->
<div id="registered" style="display:none;">
    <button type="button" class="btn btn-secondary btn-block registration-submit" id="registration-submit">Zaregistrováno</button>
</div>
<div class="jumbotron" id="jumbotron">
    <h3>Registrace</h3>
    <p class="lead">
        "Zaregistrujte mě na <strong>Volební kalkulačce</strong> a dalších projektech KohoVolit.eu.<span class="visible-xs"> Dejte mi vědět o aktualitách.</span>"
                                            <ul class="hidden-xs">
                                                <li>Vždy se dozvím o novém projektu včas.
                                                <li>Registrace je <strong>zdarma</strong>.
                                                <li>Pokračujte v boji za ochranu osobních údajů, moje údaje nikomu nedejte.
                                            </ul>
    </p>
    <div class="row">

    <div class="form-group col-md-6">
         <label for=s"registration-email">Emailová adresa: <span class="text-warning">*</span></label>
         <input type="email" class="form-control" id="registration-email" name="regem" placeholder="jmeno@example.com">
    </div>

         <div class="form-group col-md-6">
             <label for="exampleInputEmail1">PSČ</label>
             <input type="number" class="form-control" id="registration-postcode" name="regpo" placeholder="33199">
         </div>
        </div>
         <div class="checkbox">
             <label>
                 <input type="checkbox" checked="checked" id="registration-remind" name="regre"> Chci před volbami připomínat svoji shodu s kandidáty
             </label>
         </div>
         <div class="checkbox">
             <label>
                 <input type="checkbox" checked="checked" id="registration-more" name="regmo"> Zajímám se o politiku hodně a chci dostávat info o analýzách autorů Volební kalkulačky
             </label>
         </div>
         <div class="row">
             <div class="col-md-3">

             </div>
             <div class="col-md-6" id="target">
                 <button type="button" class="btn btn-success btn-block registration-submit">Registrovat se</button>
             </div>
         </div>

</div>
<!-- /jumbotron -->


<div class="d-flex flex-row flex-wrap justify-content-center">
<?php
    $projects = json_decode(file_get_contents("projects.json"));
    foreach ($projects as $project) {
        $iframe = file_get_contents("widgets/" . $project->code . ".html");
        $image = "headers/270x95/" . $project->code . ".jpg";
        $link = "https://www.darujme.cz/projekt/" . $project->darujme;
?>
    <div class="card m-4">
        <img class="card-img-top" src="<?php echo $image; ?>" />
        <div class="card-body">
            <?php echo $iframe ?>
            <a href="<?php echo $link; ?>">Více informací o projektu ...</a>
        </div>
    </div>
<?php

    }
?>
</div>
<?php
    file_get_contents('https://projects.kohovolit.eu/log.php?' . $_SERVER['REQUEST_URI']);
?>
<iframe src="https://volebnikalkulacka.cz/session/" width="0" height="0" frameborder="0"></iframe>
  </body>
</html>
