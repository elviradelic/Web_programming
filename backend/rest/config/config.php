<?php

class Config {
    public static function DB_HOST() {
        return 'localhost';
    }

    public static function DB_PORT() {
        return '3307';
    }

    public static function DB_NAME() {
        return 'event_management';
    }

    public static function DB_USER() {
        return 'root';
    }

    public static function DB_PASSWORD() {
        return '';
    }

    public static function JWT_SECRET() {
        return 'event-management-secret-key';
    }
}
