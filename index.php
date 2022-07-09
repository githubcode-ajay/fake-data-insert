<!-- https://github.com/fzaninotto/Faker -->
<?php

require 'vendor/autoload.php';
require 'function.php';

// faker implement
class Faker{
    protected $db;
    protected $faker;

    public function __construct(){
        $this->db = new MysqliDb('localhost', '<username>', '<password>', '<db name>');
        $this->faker = Faker\Factory::create();
    }

    public function inserting(){
        $table_name = "<table name>";
        $start_time = microtime(true);
        
        $data = [];
        for($i = 0; $i < 100; $i++){
            $data[] = array(
                'exam_name' => $this->faker->name,
                'description' => $this->faker->address,
                'price' => $this->faker->numberBetween($min = 10, $max = 13),
                // 'contect_no' => $this->faker->e164PhoneNumber,
            );
        }

        if(!$this->db->insertMulti($table_name,$data)) {
            echo 'insert failed: ' . $this->db->getLastError();
        } else {
            echo microtime(true) - $start_time;
        }
    }
}

// execution
$object = new Faker();
$object->inserting();
