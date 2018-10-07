<?php

main::start("TestFile.csv");

class main {

    static public function start($filename)
    {

        $records = csv :: getRecords($filename);

        $table = html::generateTable($records);

        printTable::display_table_data($table);

    }

}

class html
{

    public static function generateTable($records)
    {

        $html = '<html>';

        $html .= html_header::getHtmlHeader();
        $html .= html_body::open_HtmlBody();
        $html .= html_table::openhtmlTable();

        $count = 0;


        foreach ($records as $record) {

            /* if($count == 0)
            {
                 $html .= html_tableHead::open_TableHead();

                 $html .= create_table_Rows::open_tableRow();

                 $array = $record->returnArray();
                 $fields = array_keys($array);
                 $values = array_values($array);

               /*  foreach($fields as  $value) {
                     $html .= create_table_Header::createHeader($value);
                 }

                 $html .= html_tableHead::close_TableHead();

                 foreach($values as  $value2){
                     $html .= tableData::printTabledata($value2);
                 }

                 $html .= create_table_Rows::close_tableRow();


             } else
               {

                 $array = $record->returnArray();
                 $values = array_values($array);
                 $html .= create_table_Rows::open_tableRow();

                 foreach($values as  $value2)
               {
                     $html .= tableData::printTabledata($value2);
                 }

                 $html .= create_table_Rows::close_tableRow();

                }

             $count++;*/

            $array = $record->returnArray();
            $fields = array_keys($array);
            $values = array_values($array);
            while ($count == 0) {
                $html .= html_tableHead::open_TableHead();
                $html .= create_table_Rows::open_tableRow();
                $html .= helper::loopingIt($fields, 0);
                $html .= create_table_Rows::close_tableRow();
                $html .= html_tableHead::close_TableHead();
                $count++;
            }
            $html .= create_table_Rows::open_tableRow();
            $html .= helper::loopingIt($values, 1);
            $html .= create_table_Rows::close_tableRow();
        }
            //Finish table and return
            $html .= html_table::closehtmlTable();
            $html .= html_body::close_HtmlBody();
            $html .= '</html>';
            return $html;

    }
}



// create table header
class create_table_Header{

    public static function createHeader ($value){

        return '<th>'. $value . '</th>';

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
        return '<table class="table table-bordered  table table-striped">';
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

// create table rows
class create_table_Rows{

    public static function open_tableRow(){
        return '<tr>';
    }
    public static function close_tableRow(){
        return '</tr>';
    }
}

// get table data
class tableData{
    public static function printTabledata ($value){
        return '<td>'. $value . '</td>';
    }
}

class html_tableHead{
    public static function open_TableHead(){
        return '<thead class="thead-dark">';
    }
    public static function close_TableHead(){
        return '</thead >';
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

    public function createProperty($name , $value)
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

class printTable{
    public static function display_table_data($table){

        echo $table;

    }
}

class helper{

    public static function loopingIt($values ,$tag)
    {
        $html = '<html>';
        foreach($values as $property=>$value2){
            if($tag==0){
                $html .= create_table_Header::createHeader($value2);
            }
            else {
                $html .= tableData::printTabledata($value2);
            }
        }
        return $html;
    }
}
