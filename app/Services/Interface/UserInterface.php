<?php

namespace App\Services\Interface;

interface UserInterface {
    public function getUserById($id);

    public function checkUserRole();
}
