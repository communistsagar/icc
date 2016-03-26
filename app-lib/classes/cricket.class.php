<?php
/**
* To grab the contents from 
*/
class Miraz_Cricket
{

	
	/**
	* Function to fetch the list of recent+live matches
	* @return array
	*/
	public function get_macthes(){
		$req=$this->get_contents('http://www.espncricinfo.com/netstorage/summary.json');
		if(!$req)
			return false; // return false if the response is null
		$data=json_decode($this->simplize($req));
		$recentMatches=array(); // to assign the recent matches
		// Loop through the array and assign matches to their array 
		foreach ($data as $key => $match) {
			// Make Sure we skip domestic matches
			if($match->type == 'init'){
				$recentMatches[]=$match;
		}
	}

		return $recentMatches;
	}

	/**
	* Function to get a match details
	* @param integer $id should be valid match id
	* @return array
	*/
	public function match_details($id){
		$req=$this->get_contents('http://www.espncricinfo.com/ci/engine/match/'.$id.'.json?xhr=1');
		return json_decode($req);

	}

	/**
	* Function to fetch latest cricket news
	* @param integer $limit should be the items number to return from RSS feed
	* @return array
	*/
	public function get_news($limit='8'){
		global $feed;
		$rssContents=$this->get_contents('http://www.espncricinfo.com/rss/content/story/feeds/0.xml');
		if(!$rssContents)
			return false;
		$feed->strip_htmltags(array('img','embed','strong','a','html','onclick',));
        $feed->set_raw_data($rssContents);
        $feed->init();
        $feed->handle_content_type();
        $feedItems=array();
        $i=0;
        foreach ($feed->get_items() as $item) {
        	if($i == $limit)
        		break;
        	$feedItems[]=$item;
        	$i++;
        }
        return $feedItems;
	}

	/**
	* Function to scrap data from remote URL
	* @param string $url should be a valid url
	* @return string
	*/
	public function get_contents($url){
		/* First Try with cURL */
		if(function_exists('curl_init')){
			$ch=curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_REFERER, 'http://www.espncricinfo.com/');
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_ENCODING, '');
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'].rand(100,999999));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: en-US,en;q=0.5','Accept: application/json, text/javascript, */*; q=0.01','X-Requested-With: XMLHttpRequest','X-Forwarded-For: '.$this->realIP())); 
			$content=curl_exec($ch); 
		}
		/* If cURL is not available then fallback to fopen */
		elseif(ini_get('allow_url_fopen')){
			$content=file_get_contents($url);
		}
		else{
			$content=false;
		}
		return $content;
	}

	/**
	* Function to retrieve client's accurate IP(almost)
	* @return float
	*/
	public static function realIp(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $realIP=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $realIP=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $realIP=$_SERVER['REMOTE_ADDR'];
    }
    return $realIP;
    }

    /**
    * Function to sort the matches
    * Thanks to Sohel bro for this useful function :)
    * @author Sohel Rana <me.sohelrana@gmail.com> 
    * @link https://github.com/sohelrana820/php-live-cricket/blob/master/public/index.php
    * @param string $json should be valid json data from cricinfo
    * @return string
    */
    public function simplize($json){
    	$resp=json_decode($json);
        $modules = $resp->modules->aus;
        $allMatches = (array) $resp->matches;
        $matches = array();
        foreach($modules as $module){
        if($module->category == 'intl'){
        $matches = array_merge($matches, $this->getWork($module->matches, $allMatches, 'init'));
          }
         if($module->category == 'dom'){
         if($module->title == 'Domestic'){
         foreach($module->submenu as $domestic){
         $matches = array_merge($matches,  $this->getWork($domestic->matches, $allMatches, 'dom', $domestic->title));
          }
          }
          elseif($module->title == 'Others'){
          $matches = array_merge($matches,  $this->getWork($module->matches, $allMatches, 'other'));
           }
          }
        }
        return json_encode($matches);
    }

    /**
    * Function for getting the data well structured
    * Thanks to Sohel bro for this useful function :)
    * @author Sohel Rana <me.sohelrana@gmail.com> 
    * @link https://github.com/sohelrana820/php-live-cricket/blob/master/public/index.php
    */
    public function getWork($moduleMatches, $allMatches, $type, $title = null){
    $matches = array();
    foreach($moduleMatches as $matchID){
        foreach($allMatches as $key => $value)
        {
            if($matchID == $key){
                $matchDetails = (array) $value;
                $url = explode('/match/', $matchDetails['url']);
                $urlID = (int) str_replace('.html', '', $url[1]);
                $matchDetails['id'] = (int) $matchID;
                $matchDetails['urlID'] = $urlID;
                $matchDetails['type'] = $type;
                $matchDetails['title'] = $title;
                $matchDetails['url'] = preg_replace('|/engine/match/(.*?).html|is', '', $matchDetails['url']);
                $matches[] = $matchDetails;
            }
        }
    }
    return $matches;
}

/* End of Class */
}
