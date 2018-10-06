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

        $fieldNames = array();
        $count = 0;

        while(!feof($file)){

            $record = fgetcsv($file);
            if($count == 0)
            {
                $fieldNames = $record;
            }
            else
            {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
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

    public static function create(Array $fieldNames = null, Array $record = null){

        print_r($fieldNames);
        print_r($record);
        //$record = new record($array);
        return $record;

}

}