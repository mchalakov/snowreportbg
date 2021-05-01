<?php

$opts = array('http'=>array('header'=>"User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53\r\n"));
$context = stream_context_create($opts);

$name = $_GET['id'];
$cache = $_GET['cache'];
if ($name == 'bansko1'){$nameurl = 'https://www.banskoski.com/ext/webcams/livecam-5.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'bansko2'){$nameurl = 'https://www.banskoski.com/ext/webcams/livecam-6.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'bansko3'){$nameurl = 'https://www.banskoski.com/ext/webcams/livecam-1.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'bansko4'){$nameurl = 'https://www.banskoski.com/ext/webcams/livecam-3.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'bansko5'){$nameurl = 'https://www.banskoski.com/ext/webcams/livecam-4.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'bansko6'){$nameurl = 'https://www.banskoski.com/ext/webcams/livecam-2.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';} 

if ($name == 'vitosha1'){$nameurl = 'https://www.pss-bg.bg/cameras/vitosha/livecam-1.jpg';$time = '300';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'vitosha2'){$nameurl = 'https://www.pss-bg.bg/cameras/vitosha/livecam-2.jpg';$time = '300';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'vitosha3'){$nameurl = 'https://vod.witmind.com/moten/get_poster_image.php?id=1';$time = '100';$nameheader = 'Content-Type: image/jpg';} 


if ($name == 'borovets0'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=41';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets1'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=171';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets2'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=161';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets3'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=51';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets4'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=21';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets5'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=61';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets6'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=11';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets7'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=81';$time = '100';$nameheader = 'Content-Type: image/jpg';}  
if ($name == 'borovets8'){$nameurl = 'http://media.borovets-bg.com/cams/channel?channel=71';$time = '100';$nameheader = 'Content-Type: image/jpg';} 
if ($name == 'borovets9'){$nameurl = 'http://weather-webcam.eu/cams/musala-nova-shot.php';$time = '100';$nameheader = 'Content-Type: image/jpg';} 
if ($name == 'borovets10'){$nameurl = 'https://meter.ac/gs/nodes/N153/snap.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';} 
if ($name == 'borovets11'){$nameurl = 'https://meter.ac/gs/nodes/N155/snap.jpg';$time = '100';$nameheader = 'Content-Type: image/jpg';} 

if ($name == 'pam1'){$nameurl = 'https://pamporovo.me/media/webcams/camera1.png';$time = '100';$nameheader = 'Content-Type: image/png';}
if ($name == 'pam2'){$nameurl = 'https://pamporovo.me/media/webcams/camera2.png';$time = '100';$nameheader = 'Content-Type: image/png';}
if ($name == 'pam3'){$nameurl = 'https://pamporovo.me/media/webcams/camera3.png';$time = '100';$nameheader = 'Content-Type: image/png';}
if ($name == 'pam4'){$nameurl = 'https://pamporovo.me/media/webcams/camera4.png';$time = '100';$nameheader = 'Content-Type: image/png';}
if ($name == 'pam5'){$nameurl = 'https://pamporovo.me/media/webcams/camera5.png';$time = '100';$nameheader = 'Content-Type: image/png';}
if ($name == 'pam6'){$nameurl = 'https://pamporovo.me/media/webcams/camera6.png';$time = '100';$nameheader = 'Content-Type: image/png';}
if ($name == 'pam7'){$nameurl = 'https://pamporovo.me/media/webcams/camera8.png';$time = '100';$nameheader = 'Content-Type: image/png';}


if ($name == 'kop1'){$nameurl = 'http://212.91.164.28:8080/cam_1.jpg';$time = '600';$nameheader = 'Content-Type: image/jpg';}
if ($name == 'kop2'){$nameurl = 'http://212.91.164.28:8080/cam_2.jpg';$time = '600';$nameheader = 'Content-Type: image/jpg';}
if ($name == 'kop3'){$nameurl = 'http://212.91.164.28:8080/cam_3.jpg';$time = '600';$nameheader = 'Content-Type: image/jpg';}
if ($name == 'kop4'){$nameurl = 'http://212.91.164.28:8080/cam_4.jpg';$time = '600';$nameheader = 'Content-Type: image/jpg';}


if ($name == 'lakes1'){$nameurl = 'https://kartata.com/cams/rilski/2orig.jpg';$time = '600';$nameheader = 'Content-Type: image/jpg';}
if ($name == 'lakes2'){$nameurl = 'https://kartata.com/cams/rilski/1orig.jpg';$time = '600';$nameheader = 'Content-Type: image/jpg';}


if ($name == 'semkovo1'){$nameurl = 'https://www.stringmeteo.com/stations/semkovo/webcamimage.jpg';$time = '3600';$nameheader = 'Content-Type: image/jpg';}


header($nameheader);

  if ($cache == '1'){
    define('time_to_cache', $time);
    $local = 'cam/' . $name . '.jpg';
    if (@filemtime($local) + time_to_cache < time()) {
      copy ($nameurl, $local);
    }
    readfile($local);
    exit;
  }

  if ($cache == '0'){
    echo file_get_contents($nameurl, false, $context);

    exit;
  }

  if ($cache == null){
    echo file_get_contents($nameurl, false, $context);

    exit;
  }
?>	