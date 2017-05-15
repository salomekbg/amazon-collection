<?php

require_once 'api_key.php';

//get keywords from form
$keywords = $_POST['data'];

//return json from this php script
header("content-type:application/json");

//connect to MySQL database
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$hostname = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbName = substr($url["path"], 1);

$dbConnected = new mysqli($hostname, $username, $password, $dbName);

//connect to Amazon and get data
  // Your AWS Access Key ID, as taken from the AWS Your Account page
  $aws_access_key_id = $access_key;

  // Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
  $aws_secret_key = $secret_key;

  // The region you are interested in
  $endpoint = "webservices.amazon.com";

  $uri = "/onca/xml";

  $params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemLookup",
    "AWSAccessKeyId" => $aws_access_key_id,
    "AssociateTag" => "q0d9b-20",
    "ItemId" => $keywords,
    "IdType" => "ASIN",
    "ResponseGroup" => "ItemAttributes"
  );

  // Set current timestamp if not set
  if (!isset($params["Timestamp"])) {
    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
  }

  // Sort the parameters by key
  ksort($params);

  $pairs = array();

  foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
  }

  // Generate the canonical query
  $canonical_query_string = join("&", $pairs);

  // Generate the string to be signed
  $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

  // Generate the signature required by the Product Advertising API
  $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

  // Generate the signed URL
  $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

//gets the data from a URL
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

//sets website data to variable
$response = get_data($request_url);

//parse xml response from site
$xml = simplexml_load_string($response) or die("Error: Cannot create object");

//convert xml to json and then to an array
$json = json_encode($xml);
$array = json_decode($json,TRUE);

//drill down through array to get the item
  $asin = $array["Items"]["Item"]["ASIN"];
  $title = $array["Items"]["Item"]["ItemAttributes"]["Title"];
  if (array_key_exists("MPN", $array["Items"]["Item"]["ItemAttributes"])) {
    $mpn = $array["Items"]["Item"]["ItemAttributes"]["MPN"];
  } else {
    $mpn = "No MPN found!";
  }
  if (array_key_exists("ListPrice", $array["Items"]["Item"]["ItemAttributes"])) {
    $price = $array["Items"]["Item"]["ItemAttributes"]["ListPrice"]["FormattedPrice"];
  } else {
    $price = "No Price found, try checking Amazon directly.";
  }

//convert to json
$arr = array('ASIN' => $asin, 'Title' => $title, 'MPN' => $mpn, 'Price' => $price);
echo (json_encode($arr));

?>
