<?php
namespace App\Config;

enum UserStatus : string 
{
    case user = 'User';
    case developer = 'Developer';
    case admin = 'Admin';
}