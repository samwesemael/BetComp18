<?php
include 'server.php';
require('simple_html_dom.php');

//https://gist.github.com/anchetaWern/6150297

$html = file_get_contents('https://en.wikipedia.org/wiki/2018_FIFA_World_Cup_statistics'); //get the html returned from the following url

$wiki_doc = new DOMDocument();

libxml_use_internal_errors(TRUE); //disable libxml errors

if(!empty($html)){ //if any html is actually returned
	
	$wiki_doc->loadHTML($html);
	libxml_clear_errors(); //remove errors for yucky html
	
	$wiki_xpath = new DOMXPath($wiki_doc);
	
		// TOPSCHUTTER

		$numbergoals = $wiki_xpath->query('//dt');
		$topscorers = $wiki_xpath->query('//ul');
		$rows = 5;											//  Hoeveel verschillende aantal goals zijn er gescoord
		$starttopscorers = 5;								// Eerste lijntjes zijn de TOC
	
		for($i=0;$i<$rows;$i++){
				$aantalgoals = $numbergoals[$i]->nodeValue[0];
				//echo $aantalgoals . "<br/>";
				
				$topscorer = ($topscorers[$i+$starttopscorers])->nodeValue;
			    $topscorer = trim($topscorer);
			    $topschutters = explode(" ", $topscorer);	
				$tot = count($topschutters);
						
				for($j=0;$j<$tot;$j+=2){
					$top = $topschutters[$j] . " " . $topschutters[$j+1];
					$top= trim($top);

 					//echo $top . "<br/>";
					//$sqltopscorer = "UPDATE bc18_playerswiki SET goals = $aantalgoals WHERE player_name = '$top'";
					$sqltopscorer = "INSERT INTO bc18_players (player_name, goals) VALUES ('$top', $aantalgoals) ON DUPLICATE KEY UPDATE goals = $aantalgoals";
					print_r($sqltopscorer . "<br/>");
					mysqli_query($db, $sqltopscorer);					
				}
								
		}	
		
}

		// DISCIPLINE
		
		$htmlContent = file_get_contents("https://en.wikipedia.org/wiki/2018_FIFA_World_Cup_disciplinary_record");
		
		$DOM = new DOMDocument();
		$DOM->loadHTML($htmlContent);
	
		$tr = $DOM->getElementsByTagName('tr');		
		
		$start = 26;
		$i =0;
		
		foreach($tr as $titel){
			$i++;
			$x = false;
			$he = trim($titel->nodeValue);
			//$he = explode("", $he);
			
			if($i > $start && $i<$start + 32){
				echo $he . "<br/>";
				
				
				
			}
		}
			
			
			
    
	
	?>
	
	
<html>
<div>
	<form action="adminpage.php">
		<input type="submit" class="btn bg-grey waves-effect" value="to adminpage" />
	</form>
	<form action="klassement.php">
		<input type="submit" class="btn bg-grey waves-effect" value="to klassement" />
	</form>
	<form action="index.php">
		<input type="submit" class="btn bg-grey waves-effect" value="to homepage"  />
	</form>
</div>

</html>
	 
	 