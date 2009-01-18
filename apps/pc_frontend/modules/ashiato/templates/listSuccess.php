<div class="dparts"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Pageview logs') ?></h3></div>
<div class="box"><div class="body">
<?php echo __('Pageview Logs of %1%', array('%1%' => $sf_user->getMember()->getName())) ?>
<?php echo __('Pageview %d Logs Explanation', array('%d' => sfConfig::get('mod_ashiato_max_ashiato'))) ?>
<p><?php echo __('Pageview %d Count', array('%d' =>$count)) ?></p>
<ul>
    <?php foreach ($pager->getResults() as $ashiato) : ?>
    <?php $member = $ashiato->getMemberRelatedByMemberIdFrom(); ?>
    <li><?php echo $ashiato->getUpdatedAt(); ?><?php echo link_to($member->getName(), 'member/profile?id=' . $member->getId()); ?></li>
    <?php endforeach; ?>
</ul>
</div>
</div></div>