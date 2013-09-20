<?php
require_once("vendor/class.uFlex.php");
class ThUser extends uFlex{
    public function isAdmin() {
        if($this->data['group_id'] == 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>