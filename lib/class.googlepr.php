<?php

/**********************************************************************
GooglePR -- Calculates the Google PageRank of a specified URL
Authors : Emre Odabas (emre [at] golge [dot] net)
Version : 2.0

Description
What is Google PageRank?

PageRank is a family of algorithms for assigning numerical weightings
to hyperlinked documents (or web pages) indexed by a search engine.
Its properties are much discussed by search engine optimization (SEO)
experts. The PageRank system is used by the popular search engine
Google to help determine a page's relevance or importance.

As Google puts it:

> PageRank relies on the uniquely democratic nature of the web by
> using its vast link structure as an indicator of an individual
> page's value. Google interprets a link from page A to page B as
> a vote, by page A, for page B. But Google looks at more than the
> sheer volume of votes, or links a page receives; it also analyzes
> the page that casts the vote. Votes cast by pages that are
> themselves "important" weigh more heavily and help to make other
> pages "important."

For more info:
http://www.google.com/corporate/tech.html
http://en.wikipedia.org/wiki/PageRank
http://www.google.com/webmasters/4.html

This class will calculate and return the Google PageRank of the
specified input URL as integer. Class was build based on Raistlin
Majere's google_pagerank function

Change Log:

  2008-01-24  * Hash calculation functions updated because of
                miscalculation based on php versions. 
                (algorithm updated based on a anonymous source
                code which supposed to be found at
                http://pagerank.gamesaga.net but not exists 
                any more.)
  2005-12-07  * Small bug removed (dies when caching disabled)
  2005-11-24  * Added user-agent support
              * Class selects random google hostnames in
                order to prevent abuse. (You may define extra
                google hostnames)
              * Class now first tries cURL, fsockopen() and
                file_get_contents() to connect google servers.
              * Added caching option to class. Results now can be
                cached to flat files in order to prevent abuse and
                increase performance.
              * Cache files are stored in seperate directories for
                performance issues.

  2005-11-04  * Initial version released


Ex:
$gpr = new GooglePR();
//$gpr->debug=true; //Uncomment this line to debug query process
echo $gpr->GetPR("http://www.progen.com.tr");

//Uncomment following line to view debug results
//echo "<pre>";print_r($gpr->debugResult);echo "</pre>";

**********************************************************************/
Class GooglePR {

	//Public vars
	/*
	var $googleDomains = Array(
		"toolbarqueries.google.com",
		"www.google.com",
		"toolbarqueries.google.com.tr",
		"www.google.com.tr",
		"toolbarqueries.google.de",
		"www.google.de", 
		"64.233.187.99", 
		"72.14.207.99");
	*/
	var $googleDomains = Array("toolbarqueries.google.com");
	
	var $debugResult = Array();
	var $userAgent = "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.2.1) Gecko/20021204";
	var $cacheDir = "/tmp";
	var $maxCacheAge = 86400; // = 24h (yes, in seconds)
	var $useCache = false;
	var $debug = false;

	//Private vars
	var $PageRank = -1;
	var $cacheExpired = false;


	function GetPR($url,$forceNoCache = false) {
		$total_exec_start = $this->microtimeFloat();
		$result=array("",-1);

		if (($url.""!="")&&($url.""!="http://")) {

			$this->debugRes("url", $url);

			$this->cacheDir .= (substr($this->cacheDir,-1) != "/")? "/":"";

			// check for protocol
			$url_ = ((substr(strtolower($url),0,7)!="http://")? "http://".$url:$url);
			$host = $this->googleDomains[mt_rand(0,count($this->googleDomains)-1)];
			$target = "/search";
			$querystring = sprintf("client=navclient-auto&ch=%s&features=Rank&q=%s",
				$this->CheckHash($this->HashURL($url_)),urlencode("info:".$url_));
			$contents="";

			$this->debugRes("host", $host);
			$this->debugRes("query_string", $querystring);
			$this->debugRes("user_agent", $this->userAgent);

			$query_exec_start = $this->microtimeFloat();

			if ($forceNoCache == true) {
				$this->debugRes("force_no_cache", "true");
			} elseif ($contents = $this->readCacheResult($url)) {
				$this->debugRes("read_from_cache", "true");
			} else {
				$this->cacheExpired = true;
			}


			// let's get ranking
			if (strlen(trim($contents)) == 0)
			if (@function_exists("curl_init")) {

				// allways use curl if available for performance issues
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://".$host.$target."?".$querystring);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
				curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
				if (!($contents = trim(@curl_exec($ch)))) {
					$this->debugRes("error","curl_exec failed");
				}
				curl_close ($ch);
				$this->debugRes("method", "curl");

			} else {
				$this->debugRes("error","curl not installed, trying to use fsockopen");
				// use fsockopen as secondary method, to submit user agent
				if ($socket  = @fsockopen($host, "80", $errno, $errstr, 30)) {

					$request  = "GET $target?$querystring HTTP/1.0\r\n";
					$request .= "Host: $host\r\n";
					$request .= "User-Agent: ".$this->userAgent."\r\n";
					$request .= "Accept-Language: en-us, en;q=0.50\r\n";
					$request .= "Accept-Charset: ISO-8859-1, utf-8;q=0.66, *;q=0.66\r\n";
					$request .= "Accept: text/xml,application/xml,application/xhtml+xml,";
					$request .= "text/html;q=0.9,text/plain;q=0.8,video/x-mng,image/png,";
					$request .= "image/jpeg,image/gif;q=0.2,text/css,*/*;q=0.1\r\n";
					$request .= "Connection: close\r\n";
					$request .= "Cache-Control: max-age=0\r\n\r\n";

					stream_set_timeout ( $socket,10);
					fwrite( $socket, $request );
					$ret = '';
					while (!feof($socket)) {
						$ret .= fread($socket,4096);
					}
					fclose($socket);
					$contents = trim(substr($ret,strpos($ret,"\r\n\r\n") + 4));
					$this->debugRes("method", "fsockopen");
				} else {
					$this->debugRes("error","fsockopen failed, trying file_get_contents");
					// this way could cause problems because the Browser Useragent is not set...
					if ($contents = trim(@file_get_contents("http://".$host.$target."?".$querystring))) {
						$this->debugRes("method", "file_get_contents");
					} else {
						$this->debugRes("error","file_get_contents failed");
					}
				}

			}

			if ($this->cacheExpired == true)
			$this->updateCacheResult($url,$contents);

			$this->debugRes("query_exec_time",$this->microtimeFloat() - $query_exec_start);

			$result[0]=$contents;
			// Rank_1:1:0 = 0
			// Rank_1:1:5 = 5
			// Rank_1:1:9 = 9
			// Rank_1:2:10 = 10 etc
			$p=explode(":",$contents);
			if (isset($p[2])) $result[1]=$p[2];
		}

		if($result[1] == -1) $result[1] = 0;
		$this->PageRank =(int)$result[1];
		$this->debugRes("total_exec_time", $this->microtimeFloat() - $total_exec_start);
		$this->debugRes("result", $result);
		return $this->PageRank;

	}


	function debugRes($what,$sowhat) {
		if($this->debug == true) {
			$debugbt = debug_backtrace();
			$what = trim($what);
			$sowhat = trim($sowhat) . " (Line : ".$debugbt[0]["line"].")";
			if ($what == "error") {
				$this->debugResult[$what][] = $sowhat;
			} else {
				$this->debugResult[$what] = $sowhat;
			}
		}
	}

	function microtimeFloat() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}


	function readCacheResult($url) {
		if ($this->useCache != true) {
			return false;
		}

		if (!is_dir($this->cacheDir)) {
			$this->debugRes("error","please create {$this->cacheDir}");
			return false;
		}

		$urlp = parse_url($url);
		$host_ = explode(".",$urlp["host"]);
		$path_ = (strlen($urlp["query"])>0)? urlencode($urlp["path"].$urlp["query"]):"default";

		$cache_file = $this->cacheDir;

		for ($i = count($host_)-1;$i>=0;$i--) {
			$cache_file .= $host_[$i]."/";
		}

		$cache_file .= $path_;
		$this->debugRes("cache_file", $cache_file);
		if (file_exists($cache_file)) {
			$mtime = filemtime($cache_file);
			if (time() - $mtime > $this->maxCacheAge) {
				$this->debugRes("cache", "expired");
				$this->cacheExpired = true;
				return false;
			} else {
				$this->cacheExpired = false;
				$this->debugRes("cache_age", time() - $mtime);
				return file_get_contents($cache_file);
			}
		}
		$this->debugRes("error","cache file not exists (reading)");
		return false;
	}

	function updateCacheResult($url,$content) {
		if ($this->useCache != true) {
			return false;
		}

		if (!is_dir($this->cacheDir)) {
			$this->debugRes("error","please create {$this->cacheDir}");
			return false;
		}

		$urlp = parse_url($url);
		$host_ = explode(".",$urlp["host"]);
		$path_ = (strlen($urlp["query"])>0)? urlencode($urlp["path"].$urlp["query"]):"default";

		$cache_file = $this->cacheDir;
		for ($i = count($host_)-1;$i>=0;$i--) {
			$cache_file .= $host_[$i]."/";
		}

		$cache_file .= $path_;

		if (!file_exists($cache_file)) {
			$this->debugRes("error","cache file not exists (writing)");
			$cache_file_tmp = substr($cache_file,strlen($this->cacheDir));
			$cache_file_tmp = explode("/",$cache_file_tmp);
			$cache_dir_ = $this->cacheDir;
			for ($i = 0;$i<count($cache_file_tmp)-1;$i++) {
				$cache_dir_ .= $cache_file_tmp[$i]."/";
				if (!file_exists($cache_dir_)) {
					if (!@mkdir($cache_dir_,0777)) {
						$this->debugRes("error","unable to create cache dir: $cache_dir_");
						//break;
					}
				}
			}
			if (!@touch($cache_file)) $this->debugRes("error","unable to create cache file");
			if (!@chmod($cache_file,0777)) $this->debugRes("error","unable to chmod cache file");
		}

		if (is_writable($cache_file)) {
			if (!$handle = fopen($cache_file, 'w')) {
				$this->debugRes("error", "unable to open $cache_file");
				return false;
			}
			if (fwrite($handle, $content) === FALSE) {
				$this->debugRes("error", "unable to write to $cache_file");
				return false;
			}
			fclose($handle);
			$this->debugRes("cached", date("Y-m-d H:i:s"));
			return true;
		}
		$this->debugRes("error", "$cache_file is not writable");
		return false;

	}

	//convert a string to a 32-bit integer
	function StrToNum($Str, $Check, $Magic) {
		$Int32Unit = 4294967296;  // 2^32
		$length = strlen($Str);
		for ($i = 0; $i < $length; $i++) {
			$Check *= $Magic; 	
			//If the float is beyond the boundaries of integer (usually +/- 2.15e+9 = 2^31), 
			//  the result of converting to integer is undefined
			//  refer to http://www.php.net/manual/en/language.types.integer.php
			if ($Check >= $Int32Unit) {
				$Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
				//if the check less than -2^31
				$Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
			}
			$Check += ord($Str{$i}); 
		}
		return $Check;
	}

	//genearate a hash for a url
	function HashURL($String) {
		$Check1 = $this->StrToNum($String, 0x1505, 0x21);
		$Check2 = $this->StrToNum($String, 0, 0x1003F);
		$Check1 >>= 2; 	
		$Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
		$Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
		$Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);	
		
		$T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
		$T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );
		
		return ($T1 | $T2);
	}
	
	//genearate a checksum for the hash string
	function CheckHash($Hashnum) {
		$CheckByte = 0;
		$Flag = 0;
		$HashStr = sprintf('%u', $Hashnum) ;
		$length = strlen($HashStr);
		
		for ($i = $length - 1;  $i >= 0;  $i --) {
			$Re = $HashStr{$i};
			if (1 === ($Flag % 2)) {			  
				$Re += $Re;	 
				$Re = (int)($Re / 10) + ($Re % 10);
			}
			$CheckByte += $Re;
			$Flag ++;	
		}
	
		$CheckByte %= 10;
		if (0 !== $CheckByte) {
			$CheckByte = 10 - $CheckByte;
			if (1 === ($Flag % 2) ) {
				if (1 === ($CheckByte % 2)) {
					$CheckByte += 9;
				}
				$CheckByte >>= 1;
			}
		}
		return '7'.$CheckByte.$HashStr;
	}
}

?>
