<li id="tab_mailing_settings"<?php if ($selected_tab == 'mailing_settings'): ?> class="selected"<?php endif; ?>><?php echo javascript_link_tag(__('Outgoing email settings'), array('onclick' => "TBG.Main.Helpers.tabSwitcher('tab_mailing_settings', 'project_config_menu');")); ?></li>
