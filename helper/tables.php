<?php
class Tables {
    public function getMitglied() {
        return "CREATE TABLE mitglied(
            mitglied_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            passwort VARCHAR(255) NOT NULL,
            vorname VARCHAR(255) NOT NULL,
            nachname VARCHAR(255) NOT NULL,
            geburtsdatum DATE NOT NULL,
            adresse_id INT(10) NOT NULL,
            telefon VARCHAR(255) NOT NULL,
            rang VARCHAR(255) NULL,
            UNIQUE(email)
            ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_unicode_ci";
    }
    
    public function getAdresse() {
        return "CREATE TABLE adresse (
                    adresse_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    strasse VARCHAR(255) NOT NULL,
                    hausnummer VARCHAR(255) NOT NULL,
                    postleitzahl INT(5) NOT NULL
                    )
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci";
    }
    
    public function getPostleitzahl() {
        return "CREATE TABLE postleitzahl (
                    postleitzahl INT(5) UNSIGNED NOT NULL PRIMARY KEY,
                    ort VARCHAR(255) NOT NULL
                    )
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci";
    }
    
    public function getSportarten() {
        return "CREATE TABLE sportarten (
                    sportart_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    sportart VARCHAR(255) NOT NULL,
                    UNIQUE(sportart)
                    )
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci";
    }
    
    public function getSportstaette() {
        return "CREATE TABLE sportstaette (
                    sportstaette_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    bezeichnung VARCHAR(255) NOT NULL,
                    adresse_id INT(10) NOT NULL,
                    sportart VARCHAR(255) NOT NULL
                    )
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci";
    }
    
    public function getKurse() {
        return "CREATE TABLE kurse (
                    kurs_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    kursname VARCHAR(255) NOT NULL,
                    maxteilnehmer INT NOT NULL,
                    mitglied_id INT(10) NOT NULL,
                    sportart_id INT(10) NOT NULL,
                    beginn DATE NOT NULL,
                    ende DATE NOT NULL
                    )
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci";
    }
    
    public function getBuchungen() {
        return "CREATE TABLE buchungen (
                    buchungs_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    mitglied_id INT(10) NOT NULL,
                    kurs_id INT(10) NOT NULL
                    )
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci";
    }
}
?>
