<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'tool/simple_html_dom.php';
$opts = array(
  'http'=>array(
    'header'=>"User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53\r\n"
  )
);
$context = stream_context_create($opts);
header('Content-type: application/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");

//Date & hour
date_default_timezone_set("Europe/Sofia");
$hour['hour'] = date("H:iA");
$hour['date'] = date("d.m");

//Scrape URLS
$borovets_weather_url = file_get_html('http://www.borovets-bg.com/page/info/pisti-i-liftove/vremeto-uebkameri-lavinna-opasnost', false, $context);
$borovets_lift_url  = file_get_html('http://www.borovets-bg.com/page/info/pisti-i-liftove/lifts', false, $context);
$borovets_slope_url = file_get_html('http://www.borovets-bg.com/page/info/pisti-i-liftove/pisti', false, $context);
/* ---WEATHER--- */
	foreach($borovets_weather_url->find('.weather-forecast') as $weather_row) {
				$counter = 0;
        $borovets_data_weather['station1']['name_bg'] = 'Боровец' ;
        $borovets_data_weather['station1']['name_en'] = 'Borovets' ;
        $borovets_data_weather['station1']['metres'] = '1350';
	
        $borovets_data_weather['station2']['name_bg'] = 'Ситняково' ;
        $borovets_data_weather['station2']['name_en'] = 'Sitnyakovo' ;
        $borovets_data_weather['station2']['metres'] = '1780';	
	
        $borovets_data_weather['station3']['name_bg'] = 'Ястребец' ;
        $borovets_data_weather['station3']['name_en'] = 'Yastrebets' ;
        $borovets_data_weather['station3']['metres'] = '2050';
	
        $borovets_data_weather['station4']['name_bg'] = 'Маркуджик' ;
        $borovets_data_weather['station4']['name_en'] = 'Markudjik' ;
        $borovets_data_weather['station4']['metres'] = '2369';
	
        $borovets_data_weather['station5']['name_bg'] = 'Маркуджик 2' ;
        $borovets_data_weather['station5']['name_en'] = 'Markudjik 2' ;
        $borovets_data_weather['station5']['metres'] = '2486';	
	
    foreach($borovets_weather_url->find('.weather-forecast') as $weather_row){ 
				$counter = $counter + 1;
			
				$temp = $weather_row->find('.value')[0]->plaintext; //temperature
				$borovets_data_weather['station'.$counter.'']['temp'] = trim($temp, ' °C');
			
				$wind = $weather_row->find('.value')[1]->plaintext; //wind
				$borovets_data_weather['station'.$counter.'']['wind'] = trim($wind, ' m/sec');
			
				$snow = $weather_row->find('.value')[3]->plaintext; //snow
				$borovets_data_weather['station'.$counter.'']['snow'] = trim($snow, ' cm.');
			
				$hum = $weather_row->find('.value')[4]->plaintext; //humidity
				$borovets_data_weather['station'.$counter.'']['hum'] = trim($hum, ' %');
    }	

	}

/* ---LIFTS--- */

	//Lifts - open & closed - summary
	$liftsselect = $borovets_lift_url->find('.lifts-list-wrapper', 0)->find('.lifts-list', 0);
	foreach($liftsselect->find('.row') as $li3) {
		$borovets_data_lift1[] = $li3-> find('.lift-condition-icon')[0]->class;
	}
	$counts = array_count_values($borovets_data_lift1);

	if (is_null($counts['lift-condition-icon closed'])) 
		{$status_lift_borovets['status']['closed'] = 0;}
	else 
		{$status_lift_borovets['status']['closed'] = $counts['lift-condition-icon closed'];}

	if (is_null($counts['lift-condition-icon open'])) 
		{$status_lift_borovets['status']['open'] = 0;}
	else 
		{$status_lift_borovets['status']['open'] = $counts['lift-condition-icon open'];}

	$status_lift_borovets['status']['all'] = count($borovets_data_lift1);

	//Lifts - data
	foreach($borovets_lift_url->find('.row') as $lift_row) {
				$counter = 0;
        $borovets_data_lift['lift1']['type'] = 's-6';
        $borovets_data_lift['lift1']['name_bg'] = 'Кабинков лифт'; 
        $borovets_data_lift['lift1']['name_en'] = 'Gondola'; 
      
        $borovets_data_lift['lift2']['type'] = 's-4';
        $borovets_data_lift['lift2']['name_bg'] = 'Ситняково';  
        $borovets_data_lift['lift2']['name_en'] = 'Sitnyakovo ';  
       
        $borovets_data_lift['lift3']['type'] = 's-4';
        $borovets_data_lift['lift3']['name_bg'] = 'Ястребец';  
        $borovets_data_lift['lift3']['name_en'] = 'Yastrebetz';  
        
        $borovets_data_lift['lift4']['type'] = 's-4';
        $borovets_data_lift['lift4']['name_bg'] = 'Маркуджик 2'; 
        $borovets_data_lift['lift4']['name_en'] = 'Markudjik 2';      
        
        $borovets_data_lift['lift5']['type'] = 's-4';
        $borovets_data_lift['lift5']['name_bg'] = 'Мартинови бараки'; 
        $borovets_data_lift['lift5']['name_en'] = 'Martinovi baraki';   
      
        $borovets_data_lift['lift6']['type'] = 's-4';
        $borovets_data_lift['lift6']['name_bg'] = 'Ситняково';  
        $borovets_data_lift['lift6']['name_en'] = 'Sitnyakovo';    
      
        $borovets_data_lift['lift7']['type'] = 's-1';
        $borovets_data_lift['lift7']['name_bg'] = 'Рила'; 
        $borovets_data_lift['lift7']['name_en'] = 'Rila';   
      
        $borovets_data_lift['lift8']['type'] = 's-1';
        $borovets_data_lift['lift8']['name_bg'] = 'Иглика'; 
        $borovets_data_lift['lift8']['name_en'] = 'Iglika';   
      
        $borovets_data_lift['lift9']['type'] = 's-1';
        $borovets_data_lift['lift9']['name_bg'] = 'Ротата'; 
        $borovets_data_lift['lift9']['name_en'] = 'Rotata';  
      
        $borovets_data_lift['lift10']['type'] = 's-1';
        $borovets_data_lift['lift10']['name_bg'] = 'Маркуджик 0'; 
        $borovets_data_lift['lift10']['name_en'] = 'Markudjik 0';  
      
        $borovets_data_lift['lift11']['type'] = 's-1';
        $borovets_data_lift['lift11']['name_bg'] = 'Маркуджик 1'; 
        $borovets_data_lift['lift11']['name_en'] = 'Markudjik 1';  
      
        $borovets_data_lift['lift12']['type'] = 's-1';
        $borovets_data_lift['lift12']['name_bg'] = 'Маркуджик 3';  
        $borovets_data_lift['lift12']['name_en'] = 'Markudjik 3'; 
	
    foreach($borovets_lift_url->find('.row') as $lift_row) { 
				$counter = $counter + 1;
				$lift = $lift_row->find('.lift-condition-icon')[0]->class;  
				$borovets_data_lift['lift'.$counter.'']['status'] = str_replace('lift-condition-icon ', '', $lift);
    }	

	}

/* ---SLOPES--- */

	//Slope - open & closed - summary
	$slopesselect = $borovets_slope_url->find('.tracks-list-wrapper', 0)->find('.tracks-list', 0);
 	foreach($slopesselect->find('.row') as $li) {
	   $borovets_data_slope1[] = $li-> find('.track-condition-icon')[0]->class;
 	}
	$counts = array_count_values($borovets_data_slope1);


	if (is_null($counts['track-condition-icon closed'])) 
		{$status_slope_borovets['status']['closed'] = 0;}
	else 
		{$status_slope_borovets['status']['closed'] = $counts['track-condition-icon closed'];}

	if (is_null($counts['track-condition-icon open'])) 
		{$status_slope_borovets['status']['open'] = 0;}
	else 
		{$status_slope_borovets['status']['open'] = $counts['track-condition-icon open'];}

 	$status_slope_borovets['status']['all'] = count($borovets_data_slope1);

	//Slope - data
	foreach($borovets_slope_url->find('.row') as $lift_row) {
				$counter = 0;
        $borovets_data_slope['slope1']['type'] = 'difficulty green';
        $borovets_data_slope['slope1']['name_bg'] = 'Рила';
        $borovets_data_slope['slope1']['name_en'] = 'Rila';
            
        $borovets_data_slope['slope2']['type'] = 'difficulty blue';
        $borovets_data_slope['slope2']['name_bg'] = 'Иглика';
        $borovets_data_slope['slope2']['name_en'] = 'Iglika';
    
        $borovets_data_slope['slope3']['type'] = 'difficulty green';
        $borovets_data_slope['slope3']['name_bg'] = 'Ротата';
        $borovets_data_slope['slope3']['name_en'] = 'Rotata';
       
        $borovets_data_slope['slope4']['type'] = 'difficulty blue';
        $borovets_data_slope['slope4']['name_bg'] = 'Ситняково 1';
        $borovets_data_slope['slope4']['name_en'] = 'Sitnyakovo 1';
        
        $borovets_data_slope['slope5']['type'] = 'difficulty red';
        $borovets_data_slope['slope5']['name_bg'] = 'Ситняково 2';
        $borovets_data_slope['slope5']['name_en'] = 'Sitnyakovo 2';
    
        $borovets_data_slope['slope6']['type'] = 'difficulty red';
        $borovets_data_slope['slope6']['name_bg'] = 'Ситняково 3';
        $borovets_data_slope['slope6']['name_en'] = 'Sitnyakovo 3';
        
        $borovets_data_slope['slope7']['type'] = 'difficulty green';
        $borovets_data_slope['slope7']['name_bg'] = 'Ситняковски път';
        $borovets_data_slope['slope7']['name_en'] = 'Sitnyakovo ski road';
       
        $borovets_data_slope['slope8']['type'] = 'difficulty black';
        $borovets_data_slope['slope8']['name_bg'] = ' Червено знаме';
        $borovets_data_slope['slope8']['name_en'] = 'Cherveno zname';
    
        $borovets_data_slope['slope9']['type'] = 'difficulty blue';
        $borovets_data_slope['slope9']['name_bg'] = 'Мартинови бараки 1';
        $borovets_data_slope['slope9']['name_en'] = 'Martinovi baraki 1';
       
        $borovets_data_slope['slope10']['type'] = 'difficulty red';
        $borovets_data_slope['slope10']['name_bg'] = 'Мартинови бараки 2';
        $borovets_data_slope['slope10']['name_en'] = 'Martinovi baraki 2';
        
        $borovets_data_slope['slope11']['type'] = 'difficulty red';
        $borovets_data_slope['slope11']['name_bg'] = 'Мартинови бараки 3';
        $borovets_data_slope['slope11']['name_en'] = 'Martinovi baraki 3';
    
        $borovets_data_slope['slope12']['type'] = 'difficulty black';
        $borovets_data_slope['slope12']['name_bg'] = 'Мартинови бараки 4';
        $borovets_data_slope['slope12']['name_en'] = 'Martinovi baraki 4';
        
        $borovets_data_slope['slope13']['type'] = 'difficulty blue';
        $borovets_data_slope['slope13']['name_bg'] = 'Харамия';
        $borovets_data_slope['slope13']['name_en'] = 'Haramia';
        
        $borovets_data_slope['slope14']['type'] = 'difficulty black';
        $borovets_data_slope['slope14']['name_bg'] = 'Фонфон';
        $borovets_data_slope['slope14']['name_en'] = 'Fonfon';
    
        $borovets_data_slope['slope15']['type'] = 'difficulty red';
        $borovets_data_slope['slope15']['name_bg'] = 'Ястребец 1(до междинна)';
        $borovets_data_slope['slope15']['name_en'] = 'Yastrebetz 1(before mid station)';
		
        $borovets_data_slope['slope16']['type'] = 'difficulty red';
        $borovets_data_slope['slope16']['name_bg'] = 'Ястребец 1(след междинна)';
        $borovets_data_slope['slope16']['name_en'] = 'Yastrebetz 1(after mid station)';
       
        $borovets_data_slope['slope17']['type'] = 'difficulty red';
        $borovets_data_slope['slope17']['name_bg'] = 'Попангелов';
        $borovets_data_slope['slope17']['name_en'] = 'Popangelov';
       
        $borovets_data_slope['slope18']['type'] = 'difficulty red';
        $borovets_data_slope['slope18']['name_bg'] = 'Ястребец 3';
        $borovets_data_slope['slope18']['name_en'] = 'Yastrebetz 3';
    
        $borovets_data_slope['slope19']['type'] = 'difficulty green';
        $borovets_data_slope['slope19']['name_bg'] = 'Сухар';
        $borovets_data_slope['slope19']['name_en'] = 'Suhar';
        
        $borovets_data_slope['slope20']['type'] = 'difficulty blue';
        $borovets_data_slope['slope20']['name_bg'] = 'Маркуджик 1';
        $borovets_data_slope['slope20']['name_en'] = 'Markudjik 1';
       
        $borovets_data_slope['slope21']['type'] = 'difficulty black';
        $borovets_data_slope['slope21']['name_bg'] = 'Маркуджик 2A';
        $borovets_data_slope['slope21']['name_en'] = 'Markudjik 2A';

        $borovets_data_slope['slope22']['type'] = 'difficulty red';
        $borovets_data_slope['slope22']['name_bg'] = 'Маркуджик 2Б';
        $borovets_data_slope['slope22']['name_en'] = 'Markudjik 2B';
        
        $borovets_data_slope['slope23']['type'] = 'difficulty red';
        $borovets_data_slope['slope23']['name_bg'] = 'Маркуджик 3';
        $borovets_data_slope['slope23']['name_en'] = 'Markudjik 3';
      
        $borovets_data_slope['slope24']['type'] = 'difficulty green';
        $borovets_data_slope['slope24']['name_bg'] = 'Детски парк Борокидс'; 
        $borovets_data_slope['slope24']['name_en'] = 'Borokids park'; 
        
        $borovets_data_slope['slope25']['type'] = 'difficulty blue';
        $borovets_data_slope['slope25']['name_bg'] = 'Мусаленска пътека'; 
        $borovets_data_slope['slope25']['name_en'] = 'Musala pathway'; 
        
        $borovets_data_slope['slope26']['type'] = 'difficulty green';
        $borovets_data_slope['slope26']['name_bg'] = 'Зона шейни - Червено знаме';
        $borovets_data_slope['slope26']['name_en'] = 'Sledges zone - Cherveno zname';
      
        $borovets_data_slope['slope27']['type'] = 'difficulty green';
        $borovets_data_slope['slope27']['name_bg'] = 'Спортен център Бистрица';
        $borovets_data_slope['slope27']['name_en'] = 'Sport center Bistritsa';
      
        $borovets_data_slope['slope28']['type'] = 'difficulty green';
        $borovets_data_slope['slope28']['name_bg'] = 'Бороспорт плац';
        $borovets_data_slope['slope28']['name_en'] = 'Borosport school area';
	
    foreach($borovets_slope_url->find('.row') as $slope_row) { 
				$counter = $counter + 1;
				$borovets_data_slope['slope'.$counter.'']['numb'] = $slope_row->find('.number')[0]->innertext;
			
				$slope = $slope_row->find('.track-condition-icon')[0]->class;  
				$borovets_data_slope['slope'.$counter.'']['status'] = str_replace('track-condition-icon ', '', $slope);			
			
				$slope = $slope_row->find('.groomed-icon')[0]->class;  
				$borovets_data_slope['slope'.$counter.'']['groom'] = str_replace('groomed-icon ', '', $slope);
    }	

	}
     

 $json[borovets] = [ 'hour' => $hour,'weather' => $borovets_data_weather, 'lifts' => $borovets_data_lift,  'slopes' => $borovets_data_slope,  'slopes_cond' => $status_slope_borovets,  'lifts_cond' => $status_lift_borovets  ];
 $final = json_encode($json);

echo  $final;

?> 