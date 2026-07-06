<?php
namespace App\Config;

enum UserStatus : string 
{
    case developer = 'Developer';
    case admin = 'Admin';
}