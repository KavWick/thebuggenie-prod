<div class="dashboard_spent_time">
    <?php if (count($spenttimes) > 0): ?>
        <table cellpadding=0 cellspacing=0 class="recent_activities">
            <?php $prev_date = null; ?>
            <?php foreach ($spenttimes as $spenttime): ?>
		<?php $issue = $spenttime['issue']; ?>
		<?php $logtime = $spenttime['spenttime']; ?>
                <?php $date = tbg_formatTime($logtime->getEditedAt(), 5); ?>
                <?php if ($date != $prev_date): ?>
                    <tr>
                        <td class="latest_action_dates_cell" colspan="2">
                            <div class="latest_action_dates"><?php echo $date; ?></div>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php include_component('main/logspenttime', array('log_time' => $logtime, 'issue' => $issue, 'include_project' => true, 'include_issue_title' => true, 'include_time' => true)); ?>
                <?php $prev_date = $date; ?>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="faded_out" style="padding: 5px 5px 10px 5px;"><?php echo __("You haven't done anything recently"); ?></div>
    <?php endif; ?>
</div>

