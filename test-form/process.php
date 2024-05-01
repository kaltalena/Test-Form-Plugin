<?php

$path = preg_replece('/wp-content.*$/', '', __DIR__);

require_once($path."wp-load.php");

//Function for creating Hubspot contact
//Include HubSpot SDK
require_once(plugin_dir_path(__FILE__) . 'hubspot-php/vendor/autoload.php');

use SevenShores\Hubspot\Factory;
    
function create_hubspot_contact($email, $first_name, $last_name) {

    // Initialize HubSpot API client with your API key
    $hubspot = Factory::create('YOUR_HUBSPOT_API_KEY');
    
        // Create contact data array
        $contactData = [
            'properties' => [
                ['property' => 'email', 'value' => $email],
                ['property' => 'firstname', 'value' => $first_name],
                ['property' => 'lastname', 'value' => $last_name]
            ]
        ];
    
        // Create contact in HubSpot
        $response = $hubspot->contacts()->createOrUpdateByEmail($email, $contactData);
    
        // Check if contact was created successfully
        if ($response->getStatusCode() === 200) {
            // Contact created successfully
            return true;
        } else {
            // Contact creation failed
            return false;
        }
    }



if(isset($_POST['form_submit'])){

    // Get the data from the fields
    $firstname = sanitize_text_field($_POST('first_name'));
    $lastname = sanitize_text_field($_POST('last_name'));
    $subject = sanitize_text_field($_POST('subject'));
    $message = sanitize_text_field($_POST('message'));
    $email = sanitize_email($_POST('email'));

    // Check if the email format is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL )){
        echo 'The format of email address is invalid';
    }


    // Check if email was sent successfully and log a message
    $email_sent = wp_mail($email, $subject, $message);
    if ($email_sent){
        $log_message = 'Email sent successfully to: ' . $email;
        error_log($log_message);
    }
    else{
        $log_message = 'Failed to send email to: ' . $email;
        error_log($log_message);
    }


    create_hubspot_contact($email, $first_name, $last_name);
    
}



?>