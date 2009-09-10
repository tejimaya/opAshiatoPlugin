<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class installOpAshiatoPlugin_0_9_0_2 extends opMigration
{
  public function up()
  {
    $navi = new Navigation();
    $navi->Translation['en']->caption = 'Footprint';
    $navi->Translation['ja_JP']->caption = 'あしあと';
    $navi->setType('default');
    $navi->setUri('ashiato/list');
    $navi->setSortOrder(12);
    $navi->save();

    $navi = new Navigation();
    $navi->Translation['en']->caption = 'Footprint';
    $navi->Translation['ja_JP']->caption = '[i:91]あしあと';
    $navi->setType('mobile_home');
    $navi->setUri('ashiato/list');
    $navi->setSortOrder(12);
    $navi->save();
  }

  public function down()
  {
    $deleted = Doctrine_Query::create()
    ->delete()
    ->from('Navigation')
    ->andWhere('uri = ?', 'ashiato/list')
    ->execute();
  }
}
