<?php
$name = 'FamFamFam:Mini';
$prefix = 'ico/famfamfam/mini/gif/';
$icons = array( 'action_back.gif', 'action_forward.gif', 'action_go.gif',
'action_paste.gif', 'action_print.gif', 'action_refresh_blue.gif',
'action_refresh.gif', 'action_save.gif', 'action_stop.gif',
'application_dreamweaver.gif', 'application_firefox.gif',
'application_flash.gif', 'arrow_down.gif', 'arrow_left.gif', 'arrow_right.gif',
'arrow_up.gif', 'box.gif', 'calendar.gif', 'comment_blue.gif',
'comment_delete.gif', 'comment.gif', 'comment_new.gif', 'comment_yellow.gif',
'copy.gif', 'cut.gif', 'date_delete.gif', 'date.gif', 'date_new.gif',
'file_acrobat.gif', 'file_font.gif', 'file_font_truetype.gif', 'flag_blue.gif',
'flag_green.gif', 'flag_orange.gif', 'flag_red.gif', 'flag_white.gif',
'folder_delete.gif', 'folder.gif', 'folder_images.gif', 'folder_lock.gif',
'folder_new.gif', 'folder_page.gif', 'icon_accept.gif', 'icon_airmail.gif',
'icon_alert.gif', 'icon_attachment.gif', 'icon_clock.gif',
'icon_component.gif', 'icon_download.gif', 'icon_email.gif',
'icon_extension.gif', 'icon_favourites.gif', 'icon_get_world.gif',
'icon_history.gif', 'icon_home.gif', 'icon_info.gif', 'icon_key.gif',
'icon_link.gif', 'icon_mail.gif', 'icon_monitor_mac.gif',
'icon_monitor_pc.gif', 'icon_network.gif', 'icon_package_get.gif',
'icon_package.gif', 'icon_package_open.gif', 'icon_padlock.gif',
'icon_security.gif', 'icon_settings.gif', 'icon_user.gif', 'icon_wand.gif',
'icon_world_dynamic.gif', 'icon_world.gif', 'image.gif', 'image_new.gif',
'interface_browser.gif', 'interface_dialog.gif', 'interface_installer.gif',
'list_comments.gif', 'list_components.gif', 'list_errors.gif',
'list_extensions.gif', 'list_images.gif', 'list_keys.gif', 'list_links.gif',
'list_packages.gif', 'list_security.gif', 'list_settings.gif',
'list_users.gif', 'list_world.gif', 'note_delete.gif', 'note.gif',
'note_new.gif', 'page_alert.gif', 'page_attachment.gif', 'page_bookmark.gif',
'page_boy.gif', 'page_code.gif', 'page_colors.gif', 'page_component.gif',
'page_cross.gif', 'page_delete.gif', 'page_deny.gif', 'page_down.gif',
'page_dynamic.gif', 'page_edit.gif', 'page_extension.gif',
'page_favourites.gif', 'page_find.gif', 'page_flash.gif', 'page.gif',
'page_girl.gif', 'page_html.gif', 'page_java.gif', 'page_key.gif',
'page_left.gif', 'page_link.gif', 'page_lock.gif', 'page_new.gif',
'page_next.gif', 'page_package.gif', 'page_php.gif', 'page_prev.gif',
'page_refresh.gif', 'page_right.gif', 'page_script.gif', 'page_security.gif',
'page_settings.gif', 'page_sound.gif', 'page_tag_blue.gif', 'page_tag_red.gif',
'page_text_delete.gif', 'page_text.gif', 'page_tick.gif', 'page_tree.gif',
'page_up.gif', 'page_url.gif', 'page_user_dark.gif', 'page_user.gif',
'page_user_light.gif', 'page_video.gif', 'page_wizard.gif', 'table_delete.gif',
'table.gif', 'tables.gif' );


$layout = bu::layout('bubujka_basic');
$title = sf('%s %s',$name,' icons set');
$layout->setTitle($title);
$layout->setContent(bu::view('icons',array('icons'=>$icons,'prefix'=>$prefix)));
$layout->generate();
