<?php

main::start();

class main {

    static public function start()
    {

        $file = fopen("TestFile.csv", "r");

        while (!feof($file)) {

            print_r(fgetcsv($file));

        }
    fclose($file);
    }
}
