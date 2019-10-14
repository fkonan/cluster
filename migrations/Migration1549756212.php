<?php
namespace Migrations;
use Core\Migration;
use Core\H;
class Migration1549756212 extends Migration {
  public function up() {
    $table = "migrations";
    $this->createTable($table);
    $this->addColumn($table, 'migration', 'varchar',['size'=>35]);
    $this->addIndex($table,'migration');
  }
}
