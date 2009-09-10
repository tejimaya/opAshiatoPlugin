<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class installOpAshiatoPlugin_0_9_0_1 extends opMigration
{
  public function up()
  {
    // create table
    $conn = Doctrine_Manager::connection();

    // ashiato create table
    $conn->export->createTable(
      'ashiato',
      array(
        'id' => array('type' => 'integer', 'primary' => true, 'autoincrement' => true),
        'member_id_from' => array('type' => 'integer', 'notnull' => true),
        'member_id_to' => array('type' => 'integer', 'notnull' => true),
        'r_date' => array('type' => 'date'),
        'created_at' => array('type' => 'timestamp'),
        'updated_at' => array('type' => 'timestamp'),
      )
    );

    // ashiato create foreignkey
    $conn->export->createForeignKey('ashiato', array(
      'name' => 'ashiato_FK_1',
      'local' => 'member_id_from',
      'foreign' => 'id',
      'foreignTable' => 'member',
      'onDelete' => 'CASCADE'
    ));
    $conn->export->createForeignKey('ashiato', array(
      'name' => 'ashiato_FK_2',
      'local' => 'member_id_to',
      'foreign' => 'id',
      'foreignTable' => 'member',
      'onDelete' => 'CASCADE'
    ));

    // ashiato create index
    $conn->export->createIndex('ashiato', 'ashiato_to_create_at_idx', array(
      'fields' => array (
        'member_id_to',
        'created_at',
      )
    ));
    $conn->export->createIndex('ashiato', 'ashiato_to_r_date_idx', array(
      'fields' => array (
        'member_id_to',
        'r_date',
      )
    ));
    $conn->export->createIndex('ashiato', 'ashiato_to_from_r_date_idx', array(
      'fields' => array (
        'member_id_to',
        'member_id_from',
        'r_date',
      )
    ));
    $conn->export->createIndex('ashiato', 'ashiato_to_from_r_date_create_at_idx', array(
      'fields' => array (
        'member_id_to',
        'member_id_from',
        'r_date',
        'created_at',
    )
    ));
    $conn->export->createIndex('ashiato', 'ashiato_create_at_idx', array(
      'fields' => array (
        'created_at',
    )
    ));
    $conn->export->createIndex('ashiato', 'ashiato_r_date_idx', array(
      'fields' => array (
        'r_date',
    )
    ));
  }

  public function down()
  {
    $this->dropTable('ashiato');
  }
}
