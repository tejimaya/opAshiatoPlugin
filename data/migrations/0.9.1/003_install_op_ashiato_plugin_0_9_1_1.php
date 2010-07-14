<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class installOpAshiatoPlugin_0_9_1_1 extends opMigration
{
  public function up()
  {
    $conn = Doctrine_Manager::connection();

    // ashiato create index
    $table = 'ashiato';

    $conn->export->createIndex('ashiato', 'member_id_to_member_id_from_updated_at_idx', array(
      'fields' => array (
        'member_id_to',
        'member_id_from',
        'updated_at',
    )
    ));

    if (!$conn->import->tableIndexExists('ashiato_to_create_at_idx', $table))
    {
      $conn->export->createIndex($table, 'create_at_idx', array(
        'fields' => array (
          'created_at',
      )
      ));
    }

    if (!$conn->import->tableIndexExists('ashiato_to_r_date_idx', $table))
    {
      $conn->export->createIndex('ashiato', 'member_id_to_r_date_idx', array(
        'fields' => array (
          'member_id_to',
          'r_date',
        )
      ));
    }
  }

  public function down()
  {
  }
}
