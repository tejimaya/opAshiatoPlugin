<?php
$this->dispatcher->connect(
  'op_action.post_execute_member_profile',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberById')
);

$this->dispatcher->connect(
  'op_action.post_execute_member_smtProfile',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberById')
);

$this->dispatcher->connect(
  'op_action.post_execute_friend_list',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberById')
);

$this->dispatcher->connect(
  'op_action.post_execute_friend_smtList',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberById')
);

$this->dispatcher->connect(
  'op_action.post_execute_diary_show',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberByDiary')
);

$this->dispatcher->connect(
  'op_action.post_execute_diary_smtShow',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberByDiary')
);

$this->dispatcher->connect(
  'op_action.post_execute_diary_listMember',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberById')
);

$this->dispatcher->connect(
  'op_action.post_execute_diary_smtListMember',
  array('opRegisterAshiato', 'listenToPostActionEventRetriveMemberById')
);

$this->dispatcher->connect(
  'op_action.pre_execute_member_delete',
  array('opRemoveAshiato', 'listenToPreActionEventRetriveMemberById')
);
