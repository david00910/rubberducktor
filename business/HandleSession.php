<?php
//session_cache_limiter(FALSE);
class HandleSession
{
    public function __construct()
    {
        session_start();
    }
    public function logged_in() {
        return isset($_SESSION['customerID']);
    }
    public function confirm_logged_in() {
        if (!$this->logged_in()) {
            $redirect = new RedirectUser("signup.php");
        }
    }
}
//$length = 32;
//$_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);

