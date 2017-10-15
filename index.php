<?php 
date_default_timezone_set('UTC'); 
$endpoint = "https://api.europapark.de/api-5.5/waitingtimes";
$secret = "ZhQCqoZp";
$time = date("YmdH", time());
$token = strtoupper(implode(unpack("H*", hash_hmac("sha256", $time, $secret, true))));
$waitingTimes = json_decode(file_get_contents($endpoint . "?token=" . $token), true);

for($i = 0; $i < count($waitingTimes); $i++) {
  switch($waitingTimes[$i]["code"]) {
    case 853:
      $waitingTimes[$i]['name'] = 'Wodan';
    break;
    case 850:
      $waitingTimes[$i]['name'] = 'blue fire';
    break;
    case 250:
      $waitingTimes[$i]['name'] = 'Silver Star';
    break;
    case 200:
      $waitingTimes[$i]['name'] = 'Eurosat';
    break;
    case 500:
      $waitingTimes[$i]['name'] = 'Euro-Mir';
    break;
    case 701:
      $waitingTimes[$i]['name'] = 'Alpenexpress "Enzian"';
    break;
    case 351:
      $waitingTimes[$i]['name'] = 'Matterhorn Blitz';
    break;
    case 403:
      $waitingTimes[$i]['name'] = 'Pegasus';
    break;
    case 700:
      $waitingTimes[$i]['name'] = 'Tiroler Wildwasserbahn';
    break;
    case 800:
      $waitingTimes[$i]['name'] = 'Atlantica Supersplash';
    break;
    case 400:
      $waitingTimes[$i]['name'] = 'Wasserachterbahn Poseidon';
    break;
    case 650:
      $waitingTimes[$i]['name'] = 'Fjord Rafting';
    break;
    case 350:
      $waitingTimes[$i]['name'] = 'Schweizer Bobbahn';
    break;
    case 851:
      $waitingTimes[$i]['name'] = 'Whale Adventures - Splash Tour';
    break;
    case 404:
      $waitingTimes[$i]['name'] = 'Abenteuer Atlantis';
    break;
    case 100:
      $waitingTimes[$i]['name'] = 'Geisterschloss';
    break;
    case 550:
      $waitingTimes[$i]['name'] = 'Piraten in Batavia';
    break;
    case 201:
      $waitingTimes[$i]['name'] = 'Universum der Energie';
    break;
    case 157:
      $waitingTimes[$i]['name'] = 'Ba-a-a Express';
    break;
    case 159:
      $waitingTimes[$i]['name'] = 'Dancing Dingie';
    break;
    case 600:
      $waitingTimes[$i]['name'] = 'Dschungel-Floßfahrt';
    break;
    case 753:
      $waitingTimes[$i]['name'] = 'Kolumbusjolle';
    break;
    case 155:
      $waitingTimes[$i]['name'] = 'Old Mac Donald\'s Traktorfun';
    break;
    case 901:
      $waitingTimes[$i]['name'] = 'Poppy Tower';
    break;
    case 651:
      $waitingTimes[$i]['name'] = 'Vindjammer';
    break;
    case 702:
      $waitingTimes[$i]['name'] = 'Wiener Wellenflieger';
    break;
    case 9:
      $waitingTimes[$i]['name'] = 'Voletarium';
    break;
    case 900:
    $waitingTimes[$i]['name'] = 'Arthur - Im Königreich der Minimoys';
    break;
    case 202:
    $waitingTimes[$i]['name'] = 'Euro-Tower';
    break;
    case 495:
    $waitingTimes[$i]['name'] = 'Arena of Football';
    break;
    case 102:
    $waitingTimes[$i]['name'] = 'Volo da Vinci';
    break;
  }
} 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>EP</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
   	body {
      	background-color: #112942;
    }
    .row {
     	margin-top: 50px;
     }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Europa-Park WaitingTimes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Current
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
		<div class="row">
			<div class="col" style="padding-top: 25px;"><table id="fahrTable" style="color: #fff;" class="table">
	          <thead>
	            <tr>
	              <td>Nr.</td>
	              <td>Status</td>
	              <td>Name</td>
	              <td>Waiting Time</td>
	            </tr>
	          </thead>
			<?php        
		    for($i = 0; $i < count($waitingTimes); $i++) {
		      $badgeString = "success";

		      if($waitingTimes[$i]['time'] > 5) {
		        $badgeString = "warning";
		      } 

		      if($waitingTimes[$i]['time'] >= 20) {
		        $badgeString = "danger";
		      }

		      if($waitingTimes[$i]['status'] != 0) {
		        $badgeString = "default";
		      }

		      echo '
		      <tr>
		        <td>' . $i . '</td>
		        <td><span class="badge badge-' . ($waitingTimes[$i]['status']==0?"success":"danger") . '"> </span></td>
		        <td>' . $waitingTimes[$i]['name'] . '</td>
		        <td>
		        <span class="badge badge-' . $badgeString . '">' . ($waitingTimes[$i]['status']==0?($waitingTimes[$i]['time'] . " minutes"):"-") . '</span>
		        </td>
		      </tr>';
		    }
		    ?>
        </table>
       </div>
       </div>
      </div>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
