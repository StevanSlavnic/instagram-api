<?php
if (!empty($_GET['location'])){
    $maps_url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);

    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];

    $instagram_url = 'https://api.instagram.com/v1/media/search?lat=' . $lat . '&lng=' . $lng . '&access_token=176016472.1677ed0.5439ae6121c14c0387284fa37fc65f0a';
    $instagram_json = file_get_contents($instagram_url);
    $instagram_array = json_decode($instagram_json, true);

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Page Description">
        <meta name="author" content="steva">
        <title>Page Title</title>

        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1>Geogram</h1>
        <form action="" class="form-inline" role="form">
        	<div class="form-group">
        		<label class="sr-only" for="">Enter location</label>
                <input type="text" name="location">
        	</div>
        	<button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        if (!empty ($instagram_array)){
            foreach($instagram_array['data'] as $image) {
                echo '<div class="col-xs-6"><img src="'.$image['images']['thumbnail']['url'].'" alt="" /></div>';
                echo '<span></span>';
            }

        }
        ?>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>