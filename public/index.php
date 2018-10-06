<?php

main::start("TestFile.csv");

class main {

    static public function start($filename)
    {

        $records = csv :: getRecords($filename);

    }
}

class csv{

    public static function getRecords($filename)
    {
        $file = fopen($filename, "r");

        while(!feof($file)){

            $record = fgetcsv($file);
            $records[] = recordFactory::create($record);

        }
        fclose($file);
        return $records;
    }
}

class record{

    public function __construct(Array $record = null)
    {
        print_r($record);
        $this->createProperty();

    }

    public function createProperty($name = "FirstName", $value="Sagar")
    {

        $this->{$name} = $value;

    }
}

class recordFactory{

    public static function create(Array $array = null){

        $record = new record($array);
        return $record;

}

}