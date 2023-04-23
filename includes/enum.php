<?php

trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function get_array(): array
    {
        return self::array();
    }
}

enum FromUrl: string {
    use EnumToArray;

    // Success
    case LOGIN_SUCCESS = "LOGIN_SUCCESS";
    case LOGOUT_SUCCESS = "LOGOUT_SUCCESS";
    case REGISTER_SUCCESS = "REGISTER_SUCCESS";

    // Error
    case LOGIN_REQUIRED = "LOGIN_REQUIRED";
}