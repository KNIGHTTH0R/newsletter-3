<?php

namespace Pineapple\Model;

class Validate
{
  
    private string $email;
    private bool $terms_accepted;
    public string $error = "";
    private array $excluded_domains = ["Colombia" => "co", "Xeland" => "xe"];
    private string $excluded_country;

    public function __construct($data)
    {
        $this->email = $data['email'];

        if (isset($data['terms'])) {
            $this->terms_accepted = true;       // True if checkbox is selected
        } else {
            $this->terms_accepted = false;
        }
    }

    private function checkExcludedDomains($excluded_domains, $email)
    {
        $email_to_array = explode(".", $this->email);       // Split email address by dot
        $email_extention = $email_to_array[count($email_to_array)-1];       // Last element of array
        foreach ($excluded_domains as $country=>$extention) {
            if ($extention == $email_extention) {
                $this->excluded_country = $country;     // Take it out to class for print
                return false;       // Method ends with FALSE if email extention is on the list
            }
        }
        return true;        // Method passes if email extention is not on the list of excluded countries
    }

    public function validateForm()
    {
        
        $db = new Database();

        if (trim($this->email, " ") == "") {
            $this->error = "Email address is required";     // Email field empty
            return false;
        } elseif ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
            $this->error = "Please provide a valid e-mail address";     // Email format not valid
            return false;
        } elseif ( !$this->terms_accepted ) {
            $this->error = "You must accept the terms and conditions";      // Terms not accepted
            return false;
        } elseif ( !$this->checkExcludedDomains($this->excluded_domains, $this->email) ) {
            $this->error = "We are not accepting subscriptions from " . $this->excluded_country .  " emails.";      // Excluded country
            return false;
        } elseif ($db->find($this->email)) {
            $this->error = "This email address is already used";
            return false;
        } else {
            return true;        // Validation OK
        }
    }

}