<?php

main::start();

class main {

    static public function start()
    {

        $file = fopen("TestFile.csv", "r");

        while (!feof($file)) {

            $record = fgetcsv($file);
            $records[] = $record;
        }
    fclose($file);
    print_r($records);
    }
}
