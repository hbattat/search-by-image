<?php
$url = $_REQUEST['url'];

if(empty($_REQUEST['raw'])){
	$raw = false;
}
else{
	$raw = true;
}
echo fetch_google($url, $raw);

function fetch_google($u, $raw, $terms="sample search",$numpages=1,$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0')
{

        $ch = curl_init();
        $url = 'http://www.google.com/imghp?hl=en&tab=wi';
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_REFERER, 'http://www.google.com/');
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT,120);
        curl_setopt ($ch,CURLOPT_TIMEOUT,120);
        curl_setopt ($ch,CURLOPT_MAXREDIRS,10);
        curl_setopt ($ch,CURLOPT_COOKIEFILE,"cookie.txt");
        curl_setopt ($ch,CURLOPT_COOKIEJAR,"cookie.txt");
        curl_exec($ch);

    $searched="";
    for($i=0;$i<=$numpages;$i++)
    {
        $ch = curl_init();
        $url="http://www.google.com/searchbyimage?hl=en&image_url=".urlencode($u);
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_REFERER, 'http://www.google.com/imghp?hl=en&tab=wi');
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT,120);
        curl_setopt ($ch,CURLOPT_TIMEOUT,120);
        curl_setopt ($ch,CURLOPT_MAXREDIRS,10);
        curl_setopt ($ch,CURLOPT_COOKIEFILE,"cookie.txt");
        curl_setopt ($ch,CURLOPT_COOKIEJAR,"cookie.txt");
        $searched=$searched.curl_exec ($ch);
        curl_close ($ch);
    }
    if($raw){
			return $searched;
		}
		else{
    		$matches = array();
    		preg_match('/Best guess for this image:[^<]+<a[^>]+>([^<]+)/', $searched, $matches);
    		return (count($matches) > 1 ? $matches[1] : false);
		}
}
?>
