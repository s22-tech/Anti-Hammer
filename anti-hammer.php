<?php

$prefs_return = include_once('ah_prefs.php');
if ($prefs_return === 'skip') return;

$anti_hammer['referer'] = $_SERVER['HTTP_REFERER'] ?? '';

/*
	Anti-Hammer Pro
	...
	Protect your valuable server resources for genuine clients.
*/

$anti_hammer['types'] = 'php,html';
$anti_hammer['gen_types'] = 'jpg,jpeg,png,gif';
$anti_hammer['skip'] = 'build-to-order, build_to_order, /admin, /order, /ajax/, /search, push_jobs, errors/, /shop/';
$anti_hammer['skip_post'] = 'customer_details, firstname, lastname, address1, city, email, zone_code, postcode, country_code, shipping_address, payment, shipping, password, create_account, save_custom[...]';

/*
	RSS feeds are a good example of a file to skip ...
*/

date_default_timezone_set('America/New_York');
$anti_hammer['strict'] = 'no';
$current_time = date('H:i', time());
$start_time = '22:00';
$stop_time = '03:00';
$current_time = DateTime::createFromFormat('H:i', $current_time);
$start_time = DateTime::createFromFormat('H:i', $start_time);
$stop_time = DateTime::createFromFormat('H:i', $stop_time);

if ($stop_time < $start_time && $current_time > $start_time) {
    $stop_time = $stop_time->modify('+1 day');
}

if ($stop_time < $start_time) {
	if ($current_time > $start_time || $current_time < $stop_time) {
	   $anti_hammer['strict'] = 'yes';
	}
} else {
	if ($current_time > $start_time && $current_time < $stop_time) {
	   $anti_hammer['strict'] = 'yes';
	}
}

$anti_hammer['hammer_time'] = 75;
if ($anti_hammer['strict'] === 'yes') {
	$anti_hammer['hammer_time'] = 500;
}

$anti_hammer['trigger_levels'] = '3,10,20,30';
if ($anti_hammer['strict'] === 'yes') {
	$anti_hammer['trigger_levels'] = '4,8,11,13';
}

$anti_hammer['waiting_times'] = '3,5,10,20';
if ($anti_hammer['strict'] === 'yes') {
	$anti_hammer['waiting_times'] = '5,10,20,30';
}

$anti_hammer['rolling_trigger'] = false;
$anti_hammer['cut_off'] = '10';
$anti_hammer['ban_time'] = '12';

$anti_hammer['cut_off_msg'] = '<h1>Bye Now!</h1><br><br>Sorry... but you have been banned from this site for the next '.$anti_hammer['ban_time'].' hours.';

$anti_hammer['seo_indexes'] = true;

if (isset($ah_vendor)) {
    $anti_hammer['log'] = $anti_hammer['base_path'].'/logs/'. $ah_vendor.'/anti-hammer.log';
}
else {
	$anti_hammer['log'] = $_SERVER['DOCUMENT_ROOT'].'/logs/.ht_hammers';
}

$anti_hammer['kill_msg'] = '<h2>Hey! Slow down there, buckaroo!</h2>';

$anti_hammer['page_title'] = 'Please slow down.';

// $anti_hammer['webmaster'] = 'the webmaster';

$anti_hammer['admin_agent_string'] = 'is_store_online';

$anti_hammer['error_mail']   = '';

$anti_hammer['client_data'] = 'user_agent,accepts,language,encoding,charset,remote_ip';

$anti_hammer['lookup_failures'] = true;

$anti_hammer['allow_bots'] = true;  /* true | false | 75 | 100 */

$anti_hammer['gc_limit'] = 10000;
$anti_hammer['gc_age'] = 24;
$anti_hammer['use_php_sessions'] = false;

$anti_hammer['validate_referers'] = true;

$anti_hammer['white_list'] = 'white-list.txt';
$anti_hammer['black_list'] = 'black-list.txt';
$anti_hammer['gray_list']  = 'gray-list.txt';

$anti_hammer['banned_referers_list'] = $anti_hammer['base_path'].'/data/banned_referers.txt';

$anti_hammer['domains_only'] = false;
$anti_hammer['record_scheme'] = false;

$anti_hammer['bad_referer_msg'] = '<h1>Bad referring page!</h1>
<h2>It looks like you were referred to us from a known bad site.</h2>
<h3>If you believe this is an error, please call ' .$anti_hammer['phone_number']. ' so we can correct it for you.<br><br>We apologize for the inconvenience,<br>'. $anti_hammer['webmaster'].'</h3><h4>R[...]';

$anti_hammer['die_insert']= $_SERVER['DOCUMENT_ROOT'].'/ads/bad-ju-ju.htm';

$anti_hammer['title'] = 'Bad Referring Page';

$anti_hammer['chop'] = '?page=all';

$anti_hammer['black_log'] = 'ah-black-list.log';
$anti_hammer['gray_log']  = 'ah-gray-list.log';
$anti_hammer['ghost_log'] = 'ah-ghost-list.log';
$anti_hammer['bad_url']   = 'bad_url.log';
define( 'DEFLECTOR_MAP', $anti_hammer['base_path'].'/data/deflector_maps/temp_ip.map' );

$anti_hammer['interrogate_referers'] = true;
$anti_hammer['link_check_accuracy'] = 1;
$anti_hammer['time_out'] = 10;
$anti_hammer['max_referer_get'] = 1024*1024;
$anti_hammer['banned_urls_list'] = 'banned_urls.txt';

$anti_hammer['bad_url_message'] = "a-h: The requested URL is banned (see /a-h/banned_urls.txt). \n\nWe apologize for the inconvenience. \n\nIf you continue to have this problem, please call us at ".$anti_hammer['phone_number'].".";

$anti_hammer['banned_agents_list'] = $anti_hammer['base_path'].'/data/banned_agents.txt';

$anti_hammer['allow_empty_ua'] = true;
$anti_hammer['empty_ua_message'] = 'Please configure your web client to send a valid User Agent string.';

$anti_hammer['bad_ip_message'] = <<<"MSG"
	<span style="text-align:center;">
	<p>&nbsp;</p>
	<h1>Error</h1>
	<p>You are either located in a country outside our selling area, <br>
	&mdash; or &mdash; <br>your IP address has been banned. <font color='red'><pre>(code AH -- banned_ips.txt -- {$anti_hammer['remote_ip']} -- {$anti_hammer['ban_file']})</pre></font></p>
	<p>If you feel this is in error, please call <b>{$anti_hammer['phone_number']}</b> and give us the code above in red.</p>
	<p>We sincerely apologize for the inconvenience.</p>
	<h3>{$anti_hammer['webmaster']}</h3>
	</span>
MSG;

$anti_hammer['id_prefix'] = 'HammerID_';
$anti_hammer['lists_folder']      = 'lists';
$anti_hammer['sessions_folder']   = 'sessions';
$anti_hammer['exemptions_folder'] = 'exemptions';

$anti_hammer['data_path'] = str_replace("\\", '/', dirname(__FILE__));

// SEO indexes
if ($anti_hammer['seo_indexes']) {
	if (substr($_SERVER['REQUEST_URI'], -9) == 'index.php' and empty($_POST)) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].str_replace('index.php', '', $_SERVER['REQUEST_URI']));
		die;
	}
}

// Setup Lists
$anti_hammer['lists_folder'] = $anti_hammer['data_path'].'/'.$anti_hammer['lists_folder'].'/';

$anti_hammer['white_list']           = $anti_hammer['lists_folder'].$anti_hammer['white_list'];
$anti_hammer['black_list']           = $anti_hammer['lists_folder'].$anti_hammer['black_list'];
$anti_hammer['gray_list']            = $anti_hammer['lists_folder'].$anti_hammer['gray_list'];
$anti_hammer['banned_referers_list'] = $anti_hammer['base_path'].'/data/'.$anti_hammer['banned_referers_list'];
$anti_hammer['black_log']            = $anti_hammer['lists_folder'].$anti_hammer['black_log'];
$anti_hammer['gray_log']             = $anti_hammer['lists_folder'].$anti_hammer['gray_log'];
$anti_hammer['ghost_log']            = $anti_hammer['lists_folder'].$anti_hammer['ghost_log'];

if (isset($anti_hammer['banned_urls_list'])) { $anti_hammer['banned_urls_list'] = $anti_hammer['lists_folder'].$anti_hammer['banned_urls_list']; }
if (substr($anti_hammer['black_log'], 0, 1) != '/') {
	$anti_hammer['black_log'] = $anti_hammer['lists_folder'].$anti_hammer['black_log'];
}
if (substr($anti_hammer['gray_log'], 0, 1) != '/') {
	$anti_hammer['gray_log'] = $anti_hammer['lists_folder'].$anti_hammer['gray_log'];
}
if (substr($anti_hammer['bad_url'], 0, 1) != '/') {
	$anti_hammer['bad_url'] = $anti_hammer['lists_folder'].$anti_hammer['bad_url'];
}

$anti_hammer['user_agent']	= $_SERVER['HTTP_USER_AGENT'] ?? '';
$anti_hammer['accepts']		= $_SERVER['HTTP_ACCEPT'] ?? '';
$anti_hammer['language']	= $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
$anti_hammer['encoding']	= $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '';
$anti_hammer['charset']		= $_SERVER['HTTP_ACCEPT_CHARSET'] ?? 'utf8';
$anti_hammer['remote_ip']	= $_SERVER['REMOTE_ADDR'] ?? '';
$anti_hammer['request']		= $_SERVER['REQUEST_URI'] ?? '';
$anti_hammer['host']		= $_SERVER['HTTP_HOST'] ?? '';
$anti_hammer['uri']			= 'http://'.$anti_hammer['host'].$anti_hammer['request'];

$gentime = explode(' ', microtime());
$anti_hammer['now_time'] = $gentime[1].substr($gentime[0], 6, -2);
settype($anti_hammer['now_time'], 'double');
$anti_hammer['final_time'] = 0;

function get_rhost() {
	global $anti_hammer;
	$anti_hammer['remote_host'] = '';
	if ($anti_hammer['lookup_failures']) {
		$anti_hammer['remote_host'] = gethostbyaddr($anti_hammer['remote_ip']).' ';
	}
}

function write_hammer_data() {
	global $anti_hammer, $fake_sess_file;
	if ($anti_hammer['use_php_sessions']) {
		$_SESSION['anti_hammer']['last_request'] = $anti_hammer['session']['last_request'];
		$_SESSION['anti_hammer']['hammer']       = $anti_hammer['session']['hammer'];
		$_SESSION['anti_hammer']['cut_off']      = $anti_hammer['session']['cut_off'];
	}
	else {
		write_fake_session($fake_sess_file, $anti_hammer['session']);
	}
}

function add_log_data($file, $data, $wipe=false) {
	if (!file_exists($file)) $fp = fopen($file, 'wb');
	if (!file_exists($file)) {
		$GLOBALS['errors']['add_log_data'] = "Couldn't create $file";
		return $GLOBALS['errors']['add_log_data'];
	}
	if (strlen($data) < 4) {
		$GLOBALS['errors']['add_log_data'] = "String '$data' too short! (need 4 or more characters)";
		return $GLOBALS['errors']['add_log_data'];
	}
	$flag = 'ab';
	if ($wipe) { $flag = 'wb'; }
	if (is_writable($file)) {
		$fp = fopen($file, $flag);
		$lock = flock($fp, LOCK_EX);
		if ($lock) {
			fwrite($fp, $data);
			flock ($fp, LOCK_UN);
		} else {
			$GLOBALS['errors']['add_log_data'] = "Couldn't lock $file";
			return $GLOBALS['errors']['add_log_data'];
		}
		fclose($fp);
	} else {
		$GLOBALS['errors']['add_log_data'] = "Can't write to $file";
		return $GLOBALS['errors']['add_log_data'];
	}
}

function read_fake_session($no_cookie_file) {
	if (file_exists($no_cookie_file)) {
		$file_handle = fopen($no_cookie_file, 'rb');
		if ($file_handle) {
			$lock = flock($file_handle, LOCK_EX);
			if ($lock) {
				$file_contents = @fread($file_handle, filesize($no_cookie_file));
				flock ($file_handle, LOCK_UN);
			}
		}
		fclose($file_handle);
	} else { return false; }
	$file_contents = unserialize($file_contents);
	if (is_array($file_contents)) {
		return $file_contents;
	}
}

function write_fake_session($no_cookie_file, $array) {
	$data = serialize($array);
	if (empty($data)) return;
	$fp = @fopen($no_cookie_file, 'wb');
	if ($fp) {
		$lock = flock($fp, LOCK_EX);
		if ($lock) {
			fwrite($fp, $data);
			flock ($fp, LOCK_UN);
		}
		fclose($fp);
		clearstatcache();
		return (1);
	}
}

function collect_garbage($count_file, $limit, $prefix='HammerID_', $gc_age=12) {
	if ($limit === 0) return;
	if (ah_increment_hit_counter($count_file) >= $limit) {
		$file_list = array();
		if ($the_dir = @opendir(dirname($count_file))) {
			while (false != ($file = readdir($the_dir))) {
				if ((ord($file) != 46) and strpos($file, $prefix) === 0) {
					$file_path = dirname($count_file).'/'.$file;
					if (file_exists($file_path)) {
						if (filemtime($file_path)  < (time() - $gc_age*60*60)) {
							@unlink($file_path);
						}
					}
				}
			}
		}
		ah_increment_hit_counter($count_file, 0, 1);  // Reset the counter.
	}
}

function ah_increment_hit_counter($count_file, $report_only=false, $reset=false) {
	$count = false;
	if (!file_exists($count_file) or $reset) {
		$file_pointer = fopen($count_file, 'wb');
		fwrite ($file_pointer, '0');
		fclose ($file_pointer);
	}
	if (file_exists($count_file)) {
		$count = trim(file_get_contents($count_file));
		if ($report_only) { return $count; }
		if (!$count) { $count = 0; }
		$count++;
		if (is_writable($count_file)) {
			$file_pointer = fopen($count_file, 'wb+');
			$lock = flock($file_pointer, LOCK_EX);
				if ($lock) {
					fwrite($file_pointer, $count);
					flock ($file_pointer, LOCK_UN);
				}
				fclose($file_pointer);
				clearstatcache();
		}
	}
	return $count;
}

function ah_int2eng($number) {
	$output = '';
	if ($number < 1) $number = 1;
	$GLOBALS['anti_hammer']['final_time'] = $number;
	$units = array(' ', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ');
	$teens = array('ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen ');
	$tenners = array('', '', 'twenty ', 'thirty ', 'fourty ', 'fifty ', 'sixty ', 'seventy ', 'eighty ', 'ninety ');
	$lint = strlen($number);
	if ($lint > 2) $bigger = true;
	for ($x = $lint ; $x >= 1 ; $x--) {
		$last = substr($output, -5, 4);
		$digit = substr($number, 0, 1);
		$number = substr($number, 1);
		if ($x % 3 == 2) {
			if ($digit == 1) {
				$digit = substr($number, 0, 1);
				$number = substr($number, 1);
				$x--;
				if ($last == 'sand') { $output .= 'and '; }
				$output .= $teens[$digit];
			} else {
				if (($last == 'sand') ) { $output .= 'and '; }
				$output .= $tenners[$digit];
			}
		} else {
			if (($x % 3 != 1) and ($digit > 0) and (!empty($output))) { $output .= ', '; }
			$output .= $units[$digit];
		}
		if ((strlen($number) % 3) == 0) {
			$bignum = ah_bignumbers(strlen($number) / 3);
			if (($last == 'dred') and ($bignum != 'thousand')) { $output .= 'and ';}
			$output .= $bignum;
		}
		if ((strlen($number) % 3) == 2 and $digit > 0) {
			$output .= 'hundred and ';
		}
	}
	$output = str_replace('  ', ' ', $output);
	$output = str_replace('red and thou', 'red thou', $output);
	$output = str_replace('red and mill', 'red mill', $output);
	$output = str_replace('lion thousand', 'lion ', $output);
	if (substr($output, -5) == ' and ') { $output = substr($output, 0, -5).' '; }
	return $output;
}

function ah_bignumbers($test) {
	switch ($test) {
		case 0:
		$test = '';
		break;
		case 1:
		$test = 'thousand';
		break;
		case 2:
		$test = 'million';
		break;
		case 3:
		$test = 'trillion';
		break;
	}
	return $test;
}

function read_bots_ini($data_file) {
	$ini_array = array();
	if ( is_readable($data_file) ) {
		$file = file( $data_file );
		foreach ($file as $conf) {
			if ( (substr(trim($conf), 0, 1) != '#')
				and (substr(trim($conf), 0, 1) != ';')
				and (substr_count($conf, '=') >= 1) ) {
				$eq = strpos($conf, '=');
				$ini_array[trim(substr($conf, 0, $eq))] = trim(substr($conf, $eq + 1));
			}
		}
		unset($file);
		return $ini_array;
	}
	else {
		$GLOBALS['errors']['read_bots_ini'] = "ini file: $data_file does not exist.";
		return false;
	}
}

function validate_referer() {
	global $anti_hammer;
	if ($anti_hammer['referer'] == '') return true;
	if (!$anti_hammer['domains_only'] and strlen($anti_hammer['referer']) < 11) return true;
	if ($anti_hammer['domains_only'] and strlen($anti_hammer['referer']) < 4) return true;
	$this_url_array = parse_url($anti_hammer['referer']);
	$url_scheme = $this_url_array['scheme'] ?? '';
	$url_host   = $this_url_array['host'] ?? '';
	$url_path   = $this_url_array['path'] ?? '';
	if (!isset($url_host)) {
		$this_url_array = parse_url( 'https://'.$url_path );
	}
	if (($url_host ?? '') == $anti_hammer['host']) { return true; }
	$black_is_go  = false;
	$gray_is_go   = false;
	$white_is_go  = false;
	$banned_is_go = false;
	if (isset($anti_hammer['black_list']) and !file_exists($anti_hammer['black_list']) and $anti_hammer['interrogate_referers']) {
		add_log_data($anti_hammer['black_list'], '');
	}
	if (isset($anti_hammer['gray_list']) and !file_exists($anti_hammer['gray_list']) and $anti_hammer['interrogate_referers']) {
		add_log_data($anti_hammer['gray_list'], '');
	}
	if (isset($anti_hammer['gray_list']) and file_exists($anti_hammer['gray_list'])) { $gray_is_go = true; }
	if (isset($anti_hammer['black_list']) and file_exists($anti_hammer['black_list'])) { $black_is_go = true; }
	if (isset($anti_hammer['white_list']) and !file_exists($anti_hammer['white_list']) and $anti_hammer['interrogate_referers']) {
		add_log_data($anti_hammer['white_list'], '');
	}
	if (isset($anti_hammer['white_list']) and file_exists($anti_hammer['white_list'])) { $white_is_go = true; }
	if (isset($anti_hammer['banned_referers_list']) and file_exists($anti_hammer['banned_referers_list'])) { $banned_is_go = true; }
	$test_referer = $anti_hammer['referer'];
	if ($anti_hammer['domains_only']) { $test_referer = $url_host; }
	if ($black_is_go and !$white_is_go) {
		if (is_listed($anti_hammer['black_list'], $test_referer, $anti_hammer['domains_only'])) { return false; }
		if ($banned_is_go) { if (is_listed($anti_hammer['banned_referers_list'], $test_referer, $anti_hammer['domains_only'])) { return false; } }
	}
	if ($white_is_go) {
		if (is_listed($anti_hammer['white_list'], $test_referer, $anti_hammer['domains_only'])) { return true; }
		if ($black_is_go) { if (is_listed($anti_hammer['black_list'], $test_referer, $anti_hammer['domains_only'])) { return false; } }
		if ($banned_is_go) { if (is_listed($anti_hammer['banned_referers_list'], $test_referer, $anti_hammer['domains_only'])) { return false; } }
	}
	if ($anti_hammer['interrogate_referers']) {
		$list_pre = '';
		$list_add = @$url_path;
		if ($anti_hammer['time_out'] < 1 or $anti_hammer['time_out'] > 120) { $anti_hammer['time_out'] = 10; }
		ini_set('default_socket_timeout', $anti_hammer['time_out']);
		if ($anti_hammer['max_referer_get'] < 32) { $anti_hammer['max_referer_get'] = 32; }
		$ref_contents = @file_get_contents($anti_hammer['referer'], FALSE, NULL, 32, $anti_hammer['max_referer_get']);
		if ($anti_hammer['domains_only']) {
			$list_pre = '';
			$list_add = '';
		}
		else {
			if ($anti_hammer['record_scheme']) {
				if (isset($url_scheme)) {
					$list_pre = $url_scheme.'://';
				}
				else {
					$list_pre = 'https://';
				}
			}
		}
		if (link_in_page($ref_contents, $anti_hammer['uri'], $anti_hammer['link_check_accuracy'])) {
			if ($white_is_go) {
				add_log_data( $anti_hammer['white_list'], $list_pre.$url_host.$list_add."\n" );
			}
			return true;
		}
		else {
			if ($gray_is_go) {
				add_log_data($anti_hammer['gray_list'], $list_pre.$url_host.$list_add."\n");
			}
			if ($anti_hammer['gray_log']) {
					add_log_data($anti_hammer['gray_log'], create_log_data(true, true));
			}
			return false;
		}
	}
}

function link_in_page($page_string, $link_test, $accuracy=1) {
	switch ($accuracy) {
		case 2:
			$page_links = explode( 'href', $page_string);
			$plc = count($page_links);
			for ($i=1; $i < $plc; $i++) {
				if (strpos(substr($page_links[$i], 1, stripos($page_links[$i], '>') - 1), $link_test)
					or strpos(substr($page_links[$i], 1, stripos($page_links[$i], '>') - 1), urlencode($link_test))) { return true; }
			}
			break;
		case 3:
			preg_match_all("/a[\s]+[^>]*?href[\s]?=[\s\"\']+(.*?)[\"\']+.*?>([^<]+|.*?)?<\/a>/", $page_string, $matches);
			$matches = $matches[1];
			foreach ($matches as $var) {
				if ($var == $link_test or $var == urlencode($link_test)) { return true; }
			}
			break;
		default:
			if (stripos($page_string, $link_test) or stripos($page_string, urlencode($link_test))) { return true; }
	}
	return false;
}

function ah_validate_url() {
	global $anti_hammer;
	if (file_exists($anti_hammer['banned_urls_list'])) {
		if (is_listed($anti_hammer['banned_urls_list'], urldecode($anti_hammer['request']))) {
				$msg = '';
				if (isset($anti_hammer['bad_url_message'])) {
					$msg = $anti_hammer['bad_url_message'];
				}
				add_log_data($anti_hammer['bad_url'], create_log_data(true, false));
				$anti_hammer['session']['hammer'] += 111;
				send_501_kill($msg);
		}
	}
}

function validate_agent() {
	global $anti_hammer;
	if (file_exists($anti_hammer['banned_agents_list'])) {
		if (is_listed_regex($anti_hammer['banned_agents_list'], $anti_hammer['user_agent'])) {
			$msg = "<h1>Error</h1>
			<strong>a-h : Due to abuse, possibly by a 'Bad User Agent', this request has been denied.  We're sorry.</strong> <br><br>\n\n
			If you believe this is an error, please call us at ".$anti_hammer['phone_number']." and give us the following code:<br><br>\n\n
			<font color='red'>".$anti_hammer['user_agent'].'</font>
			<p>We apologize for the inconvenience.</p><h3>'.$anti_hammer['webmaster'].'</h3>';
			$user_agent = $anti_hammer['user_agent'] ? $anti_hammer['user_agent'] : '>> empty agent';
			send_403_kill( $msg, "### validate_agent(): $user_agent ###" );
		}
	}
}

function validate_ip($ip_array) {
	global $anti_hammer;
	$msg = '';
	if (isset($anti_hammer['bad_ip_message'])) {
		$msg = $anti_hammer['bad_ip_message'];
	}
	if (strpos( $anti_hammer['remote_ip'], ':' ) !== false) return false;
	if (!is_array($ip_array)) return false;
	foreach ($ip_array as $banned_ip) {
		$banned_ip = trim($banned_ip);
		if ($banned_ip[0] === '#' || $banned_ip === '') continue;
		if ( strpos( $banned_ip, '/' ) === false ) {
			if (ip2long($banned_ip) === ip2long($anti_hammer['remote_ip'])) {
				send_403_kill($msg, '*** validate_ip(1) ***');
			}
			if (substr($banned_ip, -1) == '0') {
				$banned_ip .= '/24';
			}
		}
		if ( strpos( $banned_ip, '/' ) !== false ) {
			list($base, $bits) = explode('/', $banned_ip);
			list($a, $b, $c, $d) = explode('.', $base);
			$i    = ($a << 24) + ($b << 16) + ($c << 8) + $d;
			$mask = $bits == 0 ? 0: (~0 << (32 - $bits));
			$low = $i & $mask;
			$high = $i | (~$mask & 0xFFFFFFFF);
			list($a, $b, $c, $d) = explode('.', $anti_hammer['remote_ip']);
			$check = ($a << 24) + ($b << 16) + ($c << 8) + $d;
			if ($check >= $low && $check <= $high) {
				send_403_kill($msg, '*** validate_ip(2) ***');
			}
		}
	}
	return;
}

function ip_in_range($banned_ip) {
	global $anti_hammer;
	$remote_ip = $anti_hammer['remote_ip'];
	$msg = '';
	if (isset($anti_hammer['bad_ip_message'])) { $msg = $anti_hammer['bad_ip_message']; }
	$banned_ip = trim($banned_ip);
	if ( strpos( $banned_ip, '/' ) === false
	  && strpos( $banned_ip, '*' ) === false
	  && strpos( $banned_ip, '-' ) === false ) {
		return ( ip2long($banned_ip) === ip2long($remote_ip) );
	}
	elseif (strpos($banned_ip, '/') !== false) {
		list($banned_ip, $netmask) = explode('/', $banned_ip, 2);
		if (strpos($netmask, '.') !== false) {
			$netmask = str_replace('*', '0', $netmask);
			$netmask_dec = ip2long($netmask);
			return ( (ip2long($remote_ip) & $netmask_dec) === (ip2long($banned_ip) & $netmask_dec) );
		}
		else {
			$x = explode('.', $banned_ip);
			while (count($x) < 4) $x[] = '0';
			list($a, $b, $c, $d) = $x;
			$banned_ip = sprintf("%u.%u.%u.%u", empty($a) ? '0' : $a, empty($b) ? '0' : $b, empty($c) ? '0' : $c, empty($d) ? '0' : $d);
			$banned_ip_dec = ip2long($banned_ip);
			$ip_dec        = ip2long($remote_ip);
			$wildcard_dec = pow(2, (32 - $netmask)) - 1;
			$netmask_dec = ~ $wildcard_dec;
			return ( ($ip_dec & $netmask_dec) === ($banned_ip_dec & $netmask_dec) );
		}
	}
	else {
		if (strpos($banned_ip, '*') !== false) {
			$lower = str_replace('*', '0', $banned_ip);
			$upper = str_replace('*', '255', $banned_ip);
			$banned_ip = "$lower-$upper";
		}
		if (strpos($banned_ip, '-') !== false) {
			list($lower, $upper) = explode('-', $banned_ip, 2);
			$lower_dec = (float)sprintf("%u", ip2long($lower));
			$upper_dec = (float)sprintf("%u", ip2long($upper));
			$ip_dec    = (float)sprintf("%u", ip2long($remote_ip));
			return ( ($ip_dec >= $lower_dec) && ($ip_dec <= $upper_dec) );
		}
		echo "Range argument is not in 1.2.3.4/24 or 1.2.3.4/255.255.255.0 format \n";
		return true;
	}
}

function is_listed($list_array_file, $test_ref, $only_domains=false) {
	$list_array = ah_grab_list_file_into_array($list_array_file);
	if (!is_array($list_array)) { return false; }
	$pos = false;
	foreach ($list_array as $list_ref) {
		if (ah_starts_with($list_ref, '#') ) {
			continue;
		}
		$list_ref = trim($list_ref);
		if ($list_ref) {
			$pos = stripos($test_ref, $list_ref);
			if ($only_domains) {
				if ($pos === 0) {
					return true;
				}
			} else {
				if ($pos !== false) {
					return true;
				}
			}
		}
	}
	return false;
}

function ah_starts_with($haystack, $needle) {
    return $needle === '' || strrpos($haystack, $needle, - strlen($haystack)) !== FALSE;
}

function is_listed_regex($list_array_file, $test_ref) {
	$list_array = ah_grab_list_file_into_array($list_array_file);
	if (!is_array($list_array)) return false;
	foreach ($list_array as $list_ref) {
		if (ah_starts_with($list_ref, '#') ) continue;
		$list_ref = trim($list_ref);
		if ($list_ref) {
			if ( @preg_match("/$list_ref/i", $test_ref) ) {
				return true;
			}
		}
	}
	return false;
}

function ah_grab_list_file_into_array($list_file) {
	if (!file_exists($list_file)) return '';
	return file($list_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

function die_spammer() {
	global $anti_hammer;
	$anti_hammer['uri'] = str_replace($anti_hammer['chop'], '', $anti_hammer['uri']);
	$die_msg = '<!DOCTYPE HTML SYSTEM><html>
<head>
  <meta name="ROBOTS" content="NOINDEX,NOFOLLOW" />
  <title>'.$anti_hammer['title'].'</title>
<style type="text/css" media="screen">
body {
	margin: 3rem 4rem;
	background: #FF9100;
	color: #330000;
	font-family:Tahoma, sans-serif;
}
a:link, a:visited, a:hover, a:active  {
	color: #330000;
	text-decoration: none;
}
a:hover { text-decoration: underline; }
pre { font-size: small; }
</style></head>
<body>
'.$anti_hammer['bad_referer_msg'].'<br>
<pre>Our Referrer Spam Protection system prevented access to: <a href="'.$anti_hammer['uri'].'">'.$anti_hammer['uri'].'</a><br><br>'.$anti_hammer['referer'].'</pre>';
	if (file_exists($anti_hammer['die_insert'])) {
		ob_start();
		include $anti_hammer['die_insert'];
		$die_msg .= ob_get_clean();
	}
	$die_msg .= '</body></html>';
	send_503_kill($die_msg, 1);
}

function create_log_data($log_hammer=true, $ref_first=false) {
	global $anti_hammer;
	$log_data = '';
	$hammers = (isset($anti_hammer['session']['hammer']) ? $anti_hammer['session']['hammer'] : '');
	if ($ref_first) {
		$log_data .= "referer:\t".$anti_hammer['referer']."\n";
	}
	$log_data .= "page:   \t".$anti_hammer['request']."\n";
	if ($log_hammer) {
		$log_data .= "time:   \t".date('Y.m.d h:i:s A')."\t".'ID: '.$anti_hammer['client_id']."\t".'x '.$hammers."\n";
	}
	get_rhost();
	$log_data .=
	"visitor:\t".$anti_hammer['remote_host'].'['.$anti_hammer['remote_ip'].']'."\t".'('.$anti_hammer['user_agent'].')'."\n"
	."accepts:\t".$anti_hammer['accepts']."\n";
	if (!$ref_first) {
		$log_data .= "referer:\t".$anti_hammer['referer']."\n";
	}
	return $log_data."\n";
}

function send_503_kill($msg='', $ra_time=1) {
	global $anti_hammer;
	add_ip_to_deflector_map();
	ah_delete_old_bad_ips();
	header($_SERVER['SERVER_PROTOCOL'].' 503 Service Temporarily Unavailable');
	header('Status: 503 Service Temporarily Unavailable');
	if ($ra_time > 0) header('Retry-After: '.$ra_time);
	header('Connection: Close');
	die($msg);
}

function send_501_kill($msg='') {
	add_ip_to_deflector_map();
	ah_delete_old_bad_ips();
	header($_SERVER['SERVER_PROTOCOL'].' 501 Not Implemented');
	header('Status: 501 Not Implemented');
	header('Content-Type: text/plain');
	header('Connection: Close');
	die($msg);
}

function send_403_kill($msg='', $ban_reason='') {
	add_ip_to_deflector_map();
	ah_delete_old_bad_ips();
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	header('Status: 403 Forbidden');
	header('Content-Type: text/html');
	header('Connection: Close');
	if (!$msg) { $msg = "Due to abuse, possibly by a 'web sucker', <br>\nthis request has been denied.  We're sorry. <br><br>\n\nIf you believe this is an error, please call us at ".$anti_hammer['phone_number']." and give us the following code:<br><br>\n\n<font color='red'>".$anti_hammer['remote_ip']."</font><br>\n<p>We apologize for the inconvenience.</p><h3>".$anti_hammer['webmaster']."</h3>"; }
	die($msg.'<br>'.$ban_reason);
}

function add_ip_to_deflector_map() {
	if ($fp = fopen(DEFLECTOR_MAP, 'a+') ) {
		if (flock($fp, LOCK_EX)) {
			fwrite($fp, $_SERVER['REMOTE_ADDR'] . ' - #ah ' . date('Y-m-d').'T'.date('H:i:s') . PHP_EOL);
			flock($fp, LOCK_UN);
		}
		fclose($fp);
	}
}

function ah_delete_old_bad_ips() {
	$lines = file( DEFLECTOR_MAP );
	$new_lines = '';
	foreach ($lines as $line) {
		if (empty($line)) continue;
		$date_time = '';
		list( $ip, $redirect, $comment, $date_time ) = explode( ' ', trim($line) );
		if ($date_time && strtotime($date_time) < time() - (60 * 60 * 18)) continue;
		$new_lines .= $ip . ' ' . $redirect. ' ' . $comment . ' ' . $date_time . PHP_EOL;
	}
	file_put_contents( DEFLECTOR_MAP, $new_lines );
}

function ah_stop_watch() {
	if (func_num_args() > 0) { $press = func_get_arg(0); }
	else { $press = false; }
	static $start_time;
	$time = array_sum(explode(' ', microtime()));
	if (!empty($press)) {
		$start_time = $time;
		return ($start_time);
	} else {
		return ($time - $start_time);
	}
}

function send_email() {
	global $anti_hammer;
	$subject  = $_SERVER['HTTP_HOST'].' is under attack!';
	$headers['Disposition-Notification-To'] = $anti_hammer['from_email'];
	$headers['From'] = $anti_hammer['from_email'];
	$headers['MIME-Version'] = '1.0';
	$headers['Content-Type'] = 'text/html; charset=ISO-8859-1';
	$message = <<<BODY
	<html><body>
	<h2>{$_SERVER['HTTP_HOST']} is under attack!</h2>
	<p>Anti-Hammer activated this email.  Check the logs to see what's happening.</p>
	<p><a href="http://whatismyipaddress.com/ip/{$anti_hammer['remote_ip']}">{$anti_hammer['remote_ip']}</a></p>
	</body></html>
BODY;
	mail( $anti_hammer['to_email'], $subject, $message, $headers );
}
