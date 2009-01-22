<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class opAshiatoPluginUpdate_1_0beta3_to_1_0beta4_dev_200901221242 extends opUpdate
{
  public function update()
  {
    $this->addColumn('ashiato', 'r_date', 'date');
  }
}
