<li class="searchterm"><?php echo $searchterm; ?><br><span class="informal"><?php echo __('Select this to search the wiki for this term'); ?></span><span class="url informal"><?php echo (\thebuggenie\core\framework\Context::isProjectContext()) ? make_url('publish_find_project_articles', array('project_key' => \thebuggenie\core\framework\Context::getCurrentProject()->getKey(), 'articlename' => $searchterm)) : make_url('publish_find_articles', array('articlename' => $searchterm)); ?></span></li>