<?php

main::start("TestFile.csv");

class main {

    static public function start($filename)
    {

        $records = csv :: getRecords($filename);

        $table = html::generateTable($records);

    }

}

class html
{

    public static function generateTable($records)
    {

        $html = '<html>';

        $html .= html_header::getHtmlHeader();
        $html .= html_body::open_HtmlBody() ;
        $html .= html_table::openhtmlTable();

        $html .= html_table::closehtmlTable();
        $html .= html_body::close_HtmlBody() ;
        $html .= '</html>';

        return $html;

    }
}


class html_header{
    public static function getHtmlHeader(){
        $html_header = '<head>';


        $html_header .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
        $html_header .= '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';
        $html_header .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
        $html_header .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
        $html_header .= '</head>';

        return $html_header;
    }
}



class html_table{
    public static function openhtmlTable(){
        return '<table class="table table-bordered">';
    }
    public static function closehtmlTable(){
        return '</table>';
    }
}

class html_body{

    public static function open_HtmlBody(){
        return '<body>';
    }
    public static function close_HtmlBody(){
        return '</body>';
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

    public function __construct(Array $fieldNames = null, Array $values = null)
    {

       $record = array_combine($fieldNames,$values);

       foreach($record as $property => $value) {

           $this->createProperty($property, $value);

       }

    }

    public function returnArray()
    {
        $array=(array) $this;
        return $array;
    }

    public function createProperty($name = "FirstName", $value="Sagar")
    {

        $this->{$name} = $value;

    }

}

class recordFactory{

    public static function create(Array $fieldNames = null, Array $values = null)
    {

        $record = new record($fieldNames, $values);
        return $record;

    }

}