<?php
/**
 * Lasso Leader License Generator
 * Run this script locally to generate license keys
 */

class Lasso_License_Generator {
    
    private $master_secret = 'YOUR_MASTER_SECRET_KEY_HERE'; // Change this!
    
    public function generate_master_license($domain, $expiry_days = 365) {
        $license_data = array(
            'domain' => $domain,
            'issued' => time(),
            'expires' => time() + ($expiry_days * 24 * 60 * 60),
            'type' => 'master',
            'version' => '5.0.0',
            'features' => array(
                'gravity_forms' => true,
                'contact_form_7' => true,
                'api_integration' => true,
                'unlimited_projects' => true
            )
        );
        
        $license_string = base64_encode(json_encode($license_data));
        $signature = hash_hmac('sha256', $license_string, $this->master_secret);
        
        return $license_string . '.' . $signature;
    }
    
    public function create_license_file($license_key, $client_info = array()) {
        $license_hash = hash('sha256', $license_key);
        
        $license_record = array(
            'hash' => $license_hash,
            'created' => date('Y-m-d H:i:s'),
            'client' => $client_info,
            'status' => 'active'
        );
        
        return json_encode($license_record, JSON_PRETTY_PRINT);
    }
}

// Example usage - run this locally
$generator = new Lasso_License_Generator();

// Generate licenses for your domains
$clients = array(
    'localhost' => 'Development Environment',
    'your-domain.com' => 'Jackson Murphy Main Site',
    'client1.com' => 'Client Name 1',
    'staging.yoursite.com' => 'Staging Environment'
);

echo "=== LASSO LEADER LICENSE GENERATOR ===\n\n";

foreach ($clients as $domain => $client_name) {
    echo "Generating license for: {$client_name} ({$domain})\n";
    
    $license_key = $generator->generate_master_license($domain, 365);
    
    $client_info = array(
        'name' => $client_name,
        'domain' => $domain,
        'generated_by' => 'Jackson Murphy',
        'generated_date' => date('Y-m-d H:i:s')
    );
    
    $license_file_content = $generator->create_license_file($license_key, $client_info);
    $license_hash = hash('sha256', $license_key);
    
    echo "License Key: {$license_key}\n";
    echo "License File: {$license_hash}.json\n";
    echo "File Content:\n{$license_file_content}\n";
    echo str_repeat('-', 80) . "\n\n";
}

echo "Next Steps:\n";
echo "1. Save each license key securely\n";
echo "2. Create license files in GitHub repository\n";
echo "3. Provide license keys to respective clients\n";
?>
