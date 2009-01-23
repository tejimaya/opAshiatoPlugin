<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class opAshiatoPluginUpdate_1_0beta4_dev_200901221242_to_1_0beta4_dev_200901232244 extends opUpdate
{
  public function update()
  {
    $this->dropForeignKey('ashiato', 'ashiato_FK_1');
    $this->dropForeignKey('ashiato', 'ashiato_FK_2');

    $this->createForeignKey('ashiato', array(
      'name'         => 'ashiato_FK_1',
      'local'        => 'member_id_from',
      'foreign'      => 'id',
      'foreignTable' => 'member',
      'onDelete'     => 'CASCADE',
    ));

    $this->createForeignKey('ashiato', array(
      'name'         => 'ashiato_FK_2',
      'local'        => 'member_id_to',
      'foreign'      => 'id',
      'foreignTable' => 'member',
      'onDelete'     => 'CASCADE',
    ));
  }
}
