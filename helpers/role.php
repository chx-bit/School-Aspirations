<?php
function checkRole($role){
    $_SESSION['role'] !== $role && exit('y gaisok se');
}