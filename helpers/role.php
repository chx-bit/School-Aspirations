<?php
function checkRole($role){
    $_SESSION['role'] !== $role && redirectTo('not-found.html');
}