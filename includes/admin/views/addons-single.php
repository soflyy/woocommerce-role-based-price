<?php $slug =  $wc_rbp_plugin_data['addon_slug']; ?>
<div class="plugin-card plugin-card-<?php echo $slug; ?>">
	<?php wc_rbp_get_ajax_overlay(); ?>
	<div class="plugin-card-top">
		<div class="name column-name">
			<h3> 
			   <?php echo $wc_rbp_plugin_data['name']; ?> 
			   [<small><?php _e('V',WC_RBP_TXT);?> <?php echo $wc_rbp_plugin_data['version']; ?></small>] 
			   <?php $this->get_addon_icon($wc_rbp_plugin_data); ?>
			</h3>
		</div>
		<div class="desc column-description">
			<p><?php echo $wc_rbp_plugin_data['decs']; ?></p>
			<p class="authors">
				<cite>
					<?php _e('By',WC_RBP_TXT); ?> 
					<a href="<?php echo $wc_rbp_plugin_data['author_link']; ?>"> <?php echo $wc_rbp_plugin_data['author']; ?></a> 
				</cite> 
			</p>
		</div>
	</div>
	<div class="plugin-card-top wc-rbp-addons-required-plugins">
		<?php if(!empty($required_plugins)): ?>
			<div>
				<h3><?php _e('Required Plugins :',WC_RBP_TXT); ?></h3>
				<ul>
					<?php
						$echo = '';
						foreach($required_plugins as $plugin){
							$plugin_status = $this->check_plugin_status($plugin['slug']);
							$status_val = __('InActive',WC_RBP_TXT);
							$class = 'deactivated';
							if($plugin_status === 'notexist'){ $status_val = __('Plugin Dose Not Exist',WC_RBP_TXT); $class = 'notexist'; } 
							else if($plugin_status === true){ $status_val = __('Active',WC_RBP_TXT); $class = 'active'; }
							if(!isset($plugin['version'])){$plugin['version'] = '';}
							echo '<li class="'.$class.'">';
								echo '<span class="wc_rbp_required_addon_plugin_name">'.$plugin['name'].' ['.$plugin['version'].'] : </span>';
								echo '<span class="wc_rbp_required_addon_plugin_status '.$class.'">'.$status_val.'</span>';
							echo '</li>';
							unset($plugin_status);
						}
					?>
				</ul>
				<p> <span><?php _e('Above Mentioned Plugin name with version are Tested Upto',WC_RBP_TXT);?></span> </p>
				<small><strong><?php _e('Addon Slug : ',WC_RBP_TXT); ?></strong><?php echo $wc_rbp_plugin_slug;?></small>
			</div>
		<?php endif; ?>
	</div>
	<div class="plugin-card-bottom">
		<div class="column-updated" data-pluginslug="<?php echo $slug; ?>">
			<?php echo $this->get_addon_action_button($wc_rbp_plugin_slug,$required_plugins); ?>
		</div>
		<div class="column-downloaded"><strong><?php _e('Last Updated:',WC_RBP_TXT);?></strong>
			<span title="<?php echo $wc_rbp_plugin_data['last_update']; ?>"><?php echo $wc_rbp_plugin_data['last_update']; ?></span>
		</div>
		<div class="column-downloaded wc_rbp_ajax_response"></div>
	</div>
</div>