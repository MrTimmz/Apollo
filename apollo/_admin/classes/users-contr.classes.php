<?php

class newUserContr extends Users {

    private $fname;
    private $mname;
    private $lname;
    private $mail;
    private $pass;
    private $passrepeat;

    public function __construct($fname, $mname, $lname, $mail, $pass = null, $passrepeat = null) {
        $this->fname = $fname;
        $this->mname = $mname;
        $this->lname = $lname;
        $this->mail = $mail;
        $this->pass = $pass; // Password is optional for updates
        $this->passrepeat = $passrepeat; // Capture password repeat for validation (if provided)
    }

    public function addnewUser() {
        // Validate input for adding a new user
        if (!$this->validateUserInput(false)) { // false indicates this is not an update
            return false; // Validation failed
        }

        // Check if the user already exists
        if ($this->userExists($this->mail)) {
            return false; // User already exists
        }

        // Register the new user
        return $this->registerUser($this->fname, $this->mname, $this->lname, $this->mail, $this->pass);
    }

    public function updateUsers($user_id) {
        // Validate input for updating a user
        if (!$this->validateUserInput(true)) { // true indicates this is an update
            return false; // Validation failed
        }

        // Update the user
        // Pass null for password if no update is required
        return $this->updateUser($user_id, $this->fname, $this->mname, $this->lname, $this->mail, $this->pass);
    }

    private function validateUserInput($isUpdate = false) {
        // Check if the email format is valid
        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Validate password only if provided (for updates) or required (for new users)
        if (!$isUpdate || ($this->pass !== null && $this->passrepeat !== null)) {
            // Check password length
            if (strlen($this->pass) < 8) {
                return false;
            }

            // Check if passwords match
            if ($this->passrepeat !== null && $this->pass !== $this->passrepeat) {
                return false;
            }
        }

        return true; // All validations passed
    }
}
