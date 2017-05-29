<?php if (isset($issue) && $issue instanceof \thebuggenie\core\entities\Issue && !($issue->isDeleted()) && $issue->hasAccess()): ?>
    <tr>
        <td class="imgtd"<?php if (!isset($include_issue_title) || $include_issue_title): ?> style="padding-top: <?php echo (isset($extra_padding) && $extra_padding) ? 10 : 3; ?>px;"<?php endif; ?>>
            <?php if (!isset($include_issue_title) || $include_issue_title): ?>
                <?php echo image_tag($issue->getIssueType()->getIcon() . '_tiny.png', array('style' => 'position: absolute; margin-top: -8px; margin-left: -6px;')); ?>
            <?php endif; ?>
        </td>
        <td style="clear: both;<?php if (!isset($include_issue_title) || $include_issue_title): ?> padding-bottom: <?php echo (isset($extra_padding) && $extra_padding) ? 15 : 10; ?>px;<?php endif; ?>">
            <?php if ((!isset($include_issue_title) || $include_issue_title) && (isset($include_time) && $include_time == true)): ?>
		<span class="time ">
		    <?php
			$spentTime = $log_time->getSpentTime();
			if ($spentTime['days'] != 0):
			    echo $spentTime['days'] . 'd ';
			endif;
			echo sprintf("%02d", $spentTime['hours']) . ':' . sprintf("%02d", $spentTime['minutes']);
			if ($spentTime['points'] != 0):
			    echo ' ' . $spentTime['points'] . 'p';
			endif;
		    ?>
		</span>&nbsp;
	    <?php endif; ?>
            <?php if (!isset($include_issue_title) || $include_issue_title): ?>
                <?php if (isset($include_project) && $include_project == true): ?><span class="faded_out smaller"><?php echo image_tag($issue->getProject()->getSmallIconName(), array('class' => 'issuelog-project-logo'), $issue->getProject()->hasSmallIcon()); ?></span><?php endif; ?>
            <?php endif; ?>
            <?php 

                $issue_title = tbg_decodeUTF8($issue->getFormattedTitle(true));
                if (isset($pad_length))
                {
                    $issue_title = tbg_truncateText($issue_title, $pad_length);
                }
                
            ?>
            <?php if (!isset($include_issue_title) || $include_issue_title): ?>
                <?php echo link_tag(make_url('viewissue', array('project_key' => $issue->getProject()->getKey(), 'issue_no' => $issue->getFormattedIssueNo())), $issue_title, array('class' => (($issue->IsClosed()) ? 'issue_closed' : 'issue_open'), 'style' => 'margin-top: 7px;')); ?>
            <?php endif; ?>
            <br>
            <div style="line-height: 1.4; word-break: break-all; word-wrap: break-word; -ms-word-break: break-all; <?php if (!isset($include_issue_title) || $include_issue_title == false): ?>margin-top: -7px; margin-bottom: 10px;<?php endif; ?>">
		<?php echo nl2br(tbg_truncateText(tbg_decodeUTF8($log_time->getComment()))); ?>
            </div>
        </td>
    </tr>
<?php endif; ?>

