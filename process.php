<?php
$protocol = $_POST['protocol'];
$config = $_POST['config'];

// Validate the protocol
if ($protocol !== 'vmess' && $protocol !== 'vless') {
  die('Invalid protocol');
}

if ($protocol === 'vmess') {
$decodedConfig = base64_decode(substr($config, 8));

// Validate and decode the configuration
$decodedConfig = json_decode($decodedConfig, true);
if ($decodedConfig === null) {
  die('Invalid configuration');
}

// List of new IPs
$newips = "185.59.218.154 91.199.81.105 172.83.76.9 45.94.169.161 203.28.9.95 108.165.216.109 170.114.46.215 195.137.167.218 185.201.139.20 170.114.46.239";

// Explode the list of new IPs into an array
$newips_array = explode(' ', $newips);

// Determine the link prefix based on the protocol
$link_prefix = ($protocol === 'vmess') ? 'vmess://' : 'vless://';

// Process and display the configurations for each new IP
foreach ($newips_array as $new_ip) {
  // Create new configuration
  $new_config = $decodedConfig;
  $new_config['add'] = $new_ip;

  // Encode the new configuration
  $encoded_new_config = base64_encode(json_encode($new_config));

  // Display the new configuration for the current IP
  echo "IP: $new_ip<br>";
  echo "Port: " . $new_config['port'] . "<br>";
  echo "UUID: " . $new_config['id'] . "<br>";
  echo "New Config: " . $encoded_new_config . "<br><br>";
}

// Display the textarea containing all the new configuration links
echo "<textarea rows='5' cols='50'>";
foreach ($newips_array as $new_ip) {
  // Create new configuration
  $new_config = $decodedConfig;
  $new_config['add'] = $new_ip;

  // Encode the new configuration
  $encoded_new_config = base64_encode(json_encode($new_config));

  // Generate the link for the current IP
  $link = $link_prefix . base64_encode(json_encode($new_config));
  echo "$link\n";
}
echo "</textarea>";
}
elseif ($protocol === 'vless') {
	

//$config = 'vless://b93bce5f-ecc5-456d-e169-ee1f867f3dc7@htamiz5.radarmarkazi.site:80?path=%2F&security=none&encryption=none&host=president.ir.cbi.ir.put.ac.ir.ponisha.ir.edbi.ir.iau.ir.bpi.ir.esam.ir.imidro.gov.ir.rubika.ir.bpi.ir.iran.gov.ir.leader.ir.bki.ir.imidro.gov.ir.iiees.ac.ir.mfa.gov.ir.karafarinbank.ir.bank-maskan.ir.mobinnet.ir.nobat.ir.snapp.ir.khokarbikgermez.cfd&type=ws#%F0%9F%87%AB%F0%9F%87%AE+Finland+NTGreen+%F0%9F%94%A5';
$new_ips = "185.59.218.154 91.199.81.105 172.83.76.9 45.94.169.161 203.28.9.95 108.165.216.109 170.114.46.215 195.137.167.218 185.201.139.20 170.114.46.239";

// Split the new IPs into an array
$new_ips_array = explode(" ", $new_ips);

// Find the position of the "@" symbol
$at_symbol_pos = strpos($config, '@');

// Extract the part after "@" symbol
$config_after_at = substr($config, $at_symbol_pos + 1);

// Find the position of ":" symbol
$colon_pos = strpos($config_after_at, ':');

// Extract the part before ":" symbol
$config_before_colon = substr($config_after_at, 0, $colon_pos);

$new_config = '';
foreach ($new_ips_array as $new_ip) {
    // Replace the IP address
    $new_config .= str_replace($config_before_colon, $new_ip, $config) . PHP_EOL;
}

echo '<textarea rows="10" cols="50">';
echo $new_config;
echo '</textarea>';	
	
	
}	
?>
