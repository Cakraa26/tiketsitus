<?php
$connection = mysqli_connect(
    "localhost", 
    "root", 
    "", 
    "trening"
);

if (! $connection){
    die ("Koneksi gagal: " . mysqli_connect_error());
} 

function insert_data($table, $data){
    global $connection;
    
    $colums = implode_column_names(array_keys($data));
    
    $bindingStatement = make_binding_statement($data);
    
    $valuesType = get_values_type_binding($data);
    
    $query = "INSERT INTO `{$table}` ({$colums}) VALUES ({$bindingStatement})";


    
    $preparedStatement = mysqli_prepare($connection, $query);
    
    mysqli_stmt_bind_param($preparedStatement, $valuesType, ...array_values($data));

    $result = mysqli_stmt_execute($preparedStatement);

    return $result;
}

function implode_column_names($columns){
    $columNames = [];

    foreach($columns as $index => $column){
        $columNames[$index] = "`{$column}`";
    }

    return implode(",", $columns);
}

function get_values_type_binding($values){
    $valuesType = [];

    foreach ($values as $index => $value){
        $type = gettype($value);

        if($type == "float"){
            $valuesType[$index] = "d";
        }else{
            $valuesType[$index] = $type[0];
        }
    }


    return implode("", $valuesType);
}

function make_binding_statement(array $data){
    $bindings = array_fill(0, (count($data)), "?");

    return implode(",", $bindings);
}

function get_all_data($table, $columns = "*")
{
  global $connection;

  $query = "SELECT {$columns} FROM `{$table}`";

  $result = mysqli_query($connection, $query);

  return $result;
}

function build_select_query($table, $column, $constraints = [])
{
  $query = "SELECT {$column} FROM `{$table}`";

  if (count($constraints) === 0) {
    return $query;
  }

  $query .= " WHERE ";

  // var_dump($constraints);
  // die;

  foreach ($constraints as $constraint) {
    $query .= implode(' ', array_values($constraint)) . " ";
  }

  return $query;

  // contoh constraint
  /**
   * [
   *  [
   *    "column" => "name",
   *    "value"  => "john",
   *    "operator" => "=",
   *    "boolean" => "OR"
   *  ]
   * ]
   *
   */


}

function get_paginated_data($table, $column, $perPage = 10, $page = 1)
{
  global $connection;

  $offset = ($page - 1) * $perPage;

  $query = "SELECT {$column} FROM `{$table}` LIMIT {$offset}, {$perPage}";

  $result = mysqli_query($connection, $query);

  return $result;
}