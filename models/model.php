<?php

function connectDb() {
    $dbinfo = parse_ini_file('db.ini');
    try {
        $dbh = new PDO(sprintf('%s:host=%s;dbname=%s', $dbinfo['driver'], $dbinfo['host'], $dbinfo['dbname']), $dbinfo['username'], $dbinfo['password']);
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
    }
    return $dbh;
}
