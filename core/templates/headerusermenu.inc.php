<nav class="tab_menu header_menu" id="header_userinfo">
    <div class="notifications" id="user_notifications">
        <h1>
            <?php echo __('Your notifications'); ?>
            <a href="javascript:void(0);" onclick="TBG.Main.Notifications.markAllRead();"><?php echo __('Mark all read'); ?></a>
        </h1>
        <div id="user_notifications_list_wrapper_nano" class="nano">
            <div id="user_notifications_list_wrapper" class="nano-content">
                <ul id="user_notifications_list" data-notifications-url="<?php echo make_url('get_partial_for_backdrop', array('key' => 'notifications')); ?>" data-offset="25">
                </ul>
            </div>
        </div>
        <?php echo image_tag('spinning_32.gif', array('id' => 'user_notifications_loading_indicator')); ?>
    </div>
    <ul>
        <?php if (!$tbg_user->isGuest()): ?>
            <li class="user_notifications_container nohover" id="user_notifications_container">
                <?= fa_image_tag('bell-o'); ?>
                <div id="user_notifications_count" class="notifications-indicator" data-callback-url=""><?php echo image_tag('spinning_16_white.gif'); ?></div>
            </li>
        <?php endif; ?>
        <?php if ($tbg_user->canAccessConfigurationPage()): ?>
            <li id="header_config_link" class="<?php if (\thebuggenie\core\framework\Context::getRouting()->getCurrentRouteModule() == 'configuration') echo ' selected'; ?>">
                <?php echo link_tag(make_url('configure'), fa_image_tag('cog')); ?>
            </li>
        <?php endif; ?>
        <li<?php if ($tbg_request->hasCookie('tbg3_original_username')): ?> class="temporarily_switched"<?php endif; ?> id="header_usermenu_link">
            <div id="header_userinfo_details">
                <?php if ($tbg_user->isGuest()): ?>
                    <a href="javascript:void(0);" <?php if (\thebuggenie\core\framework\Context::getRouting()->getCurrentRouteName() != 'login_page'): ?>onclick="TBG.Main.Login.showLogin('regular_login_container');"<?php endif; ?>><?php echo fa_image_tag('user') . '<span class="login_required_name">' . __('You are not logged in') . '</span>'; ?></a>
                <?php else: ?>
                    <?php echo link_tag(make_url('dashboard'), image_tag($tbg_user->getAvatarURL(true), array('alt' => '[avatar]', 'id' => 'header_avatar'), true)); ?>
                <?php endif; ?>
                <?php if (\thebuggenie\core\framework\Context::getRouting()->getCurrentRouteName() != 'login_page'): ?>
                    <?php echo javascript_link_tag(image_tag('tabmenu_dropdown.png', array('class' => 'menu_dropdown')), array('onmouseover' => "")); ?>
                <?php endif; ?>
            </div>
            <?php if (\thebuggenie\core\framework\Context::getRouting()->getCurrentRouteName() != 'login_page'): ?>
                <?php if (\thebuggenie\core\framework\Event::createNew('core', 'header_usermenu_decider')->trigger()->getReturnValue() !== false): ?>
                    <div class="tab_menu_dropdown user_menu_dropdown" id="user_menu">
                        <?php if ($tbg_user->isGuest()): ?>
                            <a href="javascript:void(0);" onclick="TBG.Main.Login.showLogin('regular_login_container');"><?php echo fa_image_tag('sign-in').__('Login'); ?></a>
                            <?php if (\thebuggenie\core\framework\Settings::isRegistrationAllowed()): ?>
                                <a href="javascript:void(0);" onclick="TBG.Main.Login.showLogin('register');"><?php echo fa_image_tag('user-plus').__('Register'); ?></a>
                            <?php endif; ?>
                            <?php \thebuggenie\core\framework\Event::createNew('core', 'user_dropdown_anon')->trigger(); ?>
                        <?php else: ?>
                            <div class="header" style="margin-bottom: 5px;">
                                <a href="javascript:void(0);" onclick="$('usermenu_changestate').toggle();" id="usermenu_changestate_toggler" class="button button-silver"><?php echo __('Change'); ?></a>
                                <?php echo image_tag('spinning_16.gif', array('style' => 'display: none;', 'id' => 'change_userstate_dropdown')); ?>
                                <?php echo __('You are: %userstate', array('%userstate' => '<span class="current_userstate userstate">'.__($tbg_user->getState()->getName()).'</span>')); ?>
                            </div>
                            <div id="usermenu_changestate" style="display: none;" onclick="$('usermenu_changestate').toggle();">
                                <?php foreach (\thebuggenie\core\entities\Userstate::getAll() as $state): ?>
                                    <?php if ($state->getID() == \thebuggenie\core\framework\Settings::getOfflineState()->getID()) continue; ?>
                                    <a href="javascript:void(0);" onclick="TBG.Main.Profile.setState('<?php echo make_url('set_state', array('state_id' => $state->getID())); ?>', 'change_userstate_dropdown');"><?php echo __($state->getName()); ?></a>
                                <?php endforeach; ?>
                            </div>
                            <?php echo link_tag(make_url('dashboard'), fa_image_tag('columns').__('Your dashboard')); ?>
                            <?php if ($tbg_response->getPage() == 'dashboard'): ?>
                                <?php echo javascript_link_tag(fa_image_tag('pencil-square-o').__('Customize your dashboard'), array('title' => __('Customize your dashboard'), 'onclick' => "$$('.dashboard').each(function (elm) { elm.toggleClassName('editable');});")); ?>
                            <?php endif; ?>
                            <?php echo link_tag(make_url('account'), fa_image_tag('user-md').__('Your account')); ?>
                            <?php if ($tbg_request->hasCookie('tbg3_original_username')): ?>
                                <div class="header"><?php echo __('You are temporarily this user'); ?></div>
                                <?php echo link_tag(make_url('switch_back_user'), image_tag('switchuser.png').__('Switch back to original user')); ?>
                            <?php endif; ?>
                            <?php if ($tbg_user->canAccessConfigurationPage()): ?>
                                <?php echo link_tag(make_url('configure'), fa_image_tag('cog').__('Configure %thebuggenie_name', array('%thebuggenie_name' => \thebuggenie\core\framework\Settings::getSiteHeaderName()))); ?>
                            <?php endif; ?>
                            <?php \thebuggenie\core\framework\Event::createNew('core', 'user_dropdown_reg')->trigger(); ?>
                            <?php echo link_tag('http://www.thebuggenie.com/help/'.\thebuggenie\core\framework\Context::getRouting()->getCurrentRouteName(), fa_image_tag('question-circle').__('Help for this page'), array('id' => 'global_help_link')); ?>
                            <a href="<?php echo make_url('logout'); ?>" onclick="<?php if (\thebuggenie\core\framework\Settings::isPersonaAvailable()): ?>if (navigator.id) { navigator.id.logout();return false; }<?php endif; ?>"><?php echo fa_image_tag('sign-out').__('Logout'); ?></a>
                            <div class="header"><?php echo __('Your issues'); ?></div>
                            <?php echo link_tag(make_url('my_reported_issues'), fa_image_tag('search') . __('Issues reported by me')); ?>
                            <?php echo link_tag(make_url('my_assigned_issues'), fa_image_tag('search') . __('Open issues assigned to me')); ?>
                            <?php echo link_tag(make_url('my_teams_assigned_issues'), fa_image_tag('search') . __('Open issues assigned to my teams')); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </li>
        <?php \thebuggenie\core\framework\Event::createNew('core', 'after_header_userinfo')->trigger(); ?>
    </ul>
</nav>
