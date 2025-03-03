<?php
session_start();
class RolesContr extends Roles
{
    private $title;
    private $role_id;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function addnewRole()
    {
        try {
            $this->validateInput();
            if ($this->isRoleExists()) {
                $_SESSION['error_message'] = "Role title already exists!";
                $_SESSION['submited_value'] = $this->title;
                header("location: ../roles.php");
                exit();
            }
            $this->setRole($this->title);
            $_SESSION['success_message'] = "New role has been added successfully!";
            header("Location: ../index.php");
            exit();
            $this->updateRole($this->title, $this->role_id);
            $_SESSION['success_message'] = "New role has been added successfully!";
            header("Location: ../index.php");
            exit();
        } catch (Exception $e) {
            $errorMessage = "";
            switch ($e->getMessage()) {
                case "emptyinput":
                    $errorMessage = "Role title cannot be empty.";
                    break;
                case "invalidtitle":
                    $errorMessage = "Role title can only contain alphabets and spaces.";
                    break;
                case "roletitletaken":
                    $errorMessage = "Role title already exists.";
                    break;
            }
            $_SESSION['error_message'] = $errorMessage;
            $_SESSION['submited_value'] = $this->title;
            header("Location: ../roles.php");
            exit();
        }
    }



    private function validateInput()
    {
        if (empty($this->title)) {
            throw new Exception("emptyinput");
        }
        if (!ctype_alpha(str_replace(' ', '', $this->title))) {
            throw new Exception("invalidtitle");
        }
    }

    private function isRoleExists()
    {
        $result = $this->getRoleByTitle($this->title);
        return $result ? true : false;
    }
}
