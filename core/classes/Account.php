<?php

class Account {
    private $errors = array();
    private $passed = false;
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function register_user($username, $fullName, $email, $password) {
        $encryptedPassword = $this->hash_password($password);
        $ip = $this->getIP();
        $os = $this->getOS();
        $browser = $this->getBrowser();

        $stmt = $this->pdo->prepare("
            INSERT INTO users (username, fullName, email, password, pri_ip, pri_os, pri_browser) 
            VALUES (:username, :fullName, :email, :password, :ip, :os, :browser)
        ");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":fullName", $fullName, PDO::PARAM_STR); // Fixed variable name
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $encryptedPassword, PDO::PARAM_STR);
        $stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
        $stmt->bindParam(":os", $os, PDO::PARAM_STR);
        $stmt->bindParam(":browser", $browser, PDO::PARAM_STR);

        $stmt->execute();

        return $this->pdo->lastInsertId(); // Fixed method name
    }
    public function login_user($email_username, $password) {
       if(!empty($email_username) && !empty($password)) {
        $stmt=$this->pdo->prepare(("SELECT * FROM users WHERE email = :username OR username = :username"));
        $stmt->bindParam(":username", $email_username, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_OBJ);
        if($stmt -> rowCount() !=0){
            if(password_verify($password,$row->password)){
                if (empty($this->errors)) {
                    $this->passed = true;
                    return $row->user_id;

                }
            }else{
                $this->addError("USername and password incorrect");
                return false;
            }
        }else{
            $this->addError("USername and password incorrect");
            return false;

        }
       }
       
        
    }

    public function hash_password($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown OS Platform";
        $os_array = array(
            '#windows nt 10#i' => 'Windows 10',
            '#windows nt 6.3#i' => 'Windows 8.1',
            '#windows nt 6.2#i' => 'Windows 8',
            '#windows nt 6.1#i' => 'Windows 7',
            '#windows nt 6.0#i' => 'Windows Vista',
            '#windows nt 5.1#i' => 'Windows XP',
            '#windows nt 5.0#i' => 'Windows 2000',
            '#mac os x 10.9#i' => 'OSX Mavericks',
            '#mac os x 10.8#i' => 'OSX Mountain Lion',
            '#mac os x 10.7#i' => 'OSX Lion',
            '#mac os x 10.6#i' => 'OSX Snow Leopard',
            '#mac os x 10.5#i' => 'OSX Leopard',
            '#mac os x 10.4#i' => 'OSX Tiger',
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }
        return $os_platform;
    }

    public function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Unknown Browser";
        $browser_array = array(
            '#msie#i' => 'Internet Explorer',
            '#firefox#i' => 'Firefox',
            '#safari#i' => 'Safari',
            '#chrome#i' => 'Chrome',
            '#edge#i' => 'Edge',
            '#opera#i' => 'Opera',
            '#netscape#i' => 'Netscape',
            '#maxthon#i' => 'Maxthon',
            '#konqueror#i' => 'Konqueror',
            '#mobile#i' => 'Handheld Browser',
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }
        return $browser;
    }

    public function getIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_add = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_add = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_add = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_add;
    }

    public function check($source, $items = array()) {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = escape($source[$item]);
                $item = escape($item);

                if (!empty($value)) {
                    switch ($rule) {
                        case "max":
                            if (strlen(trim($value)) > $rule_value) {
                                $this->addError("{$item} must be maximum of {$rule_value} characters");
                            }
                            break;

                        case "unique":
                            if ($this->userExists($item, $value)) {
                                $this->addError("{$item} already exists");
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }
    }

    private function userExists($item, $value) {
        $allowedColumns = ['username', 'email']; // Whitelisted columns
        if (!in_array($item, $allowedColumns)) {
            throw new Exception("Invalid column name.");
        }
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE $item = :value");
        $stmt->bindParam(":value", $value, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function addError($error) {
        $this->errors[] = $error;
    }

    public function errors() {
        return $this->errors;
    }

    public function passed() {
        return $this->passed;
    }
}
