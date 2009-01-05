<li><?php echo sprintf('ページ全体のアクセス数：(%d) アクセス', $count) ?></li>
<table>
  <tbody>
    <?php foreach ($pager->getResults() as $ashiato) : ?>
    <?php $member = $ashiato->getMemberRelatedByMemberIdFrom(); ?>
    <li><?php echo $ashiato->getUpdatedAt(); ?><?php echo link_to($member->getName(), 'member/profile?id=' . $ashiato->getId()); ?></li>
    <?php endforeach; ?>
  </tbody>
</table>
