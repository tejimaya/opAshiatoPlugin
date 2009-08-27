<?php use_stylesheet('ashiato.css') ?>
<div class="dparts"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Pageview logs') ?></h3></div>
<div class="box"><div class="body">
<?php echo __('Pageview Logs of %1%', array('%1%' => $sf_user->getMember()->getName())) ?>
<?php echo __('Pageview %d Logs Explanation', array('%d' => sfConfig::get('mod_ashiato_max_ashiato'))) ?>
<p><?php echo __('Pageview %d Count', array('%d' =>$count)) ?></p>
<dl class="ashiatoBox">
    <?php foreach ($pager->getResults() as $ashiato) : ?>
    <dt><?php echo op_format_date($ashiato->updated_at, 'XDateTimeJaBr'); ?></dt>
    <dd><?php echo link_to($ashiato->Member_2->name, 'member/profile?id=' . $ashiato->Member_2->id); ?></dd>
    <?php endforeach; ?>
</dl>
</div>
</div>
</div></div>
