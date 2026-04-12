<?php
/**
*
* includes/constans.php
*
* Roberto Tonjaw. Dec 2013
*/

/**
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}


// User related
define('ANONYMOUS', 2);

// Login error codes
define('LOGIN_CONTINUE', 1);
define('LOGIN_BREAK', 2);
define('LOGIN_SUCCESS', 3);
define('LOGIN_SUCCESS_CREATE_PROFILE', 20);
define('LOGIN_ERROR_USERNAME', 10);
define('LOGIN_ERROR_PASSWORD', 11);
define('LOGIN_ERROR_ACTIVE', 12);
define('LOGIN_ERROR_ATTEMPTS', 13);
define('LOGIN_ERROR_EXTERNAL_AUTH', 14);
define('LOGIN_ERROR_PASSWORD_CONVERT', 15);

// tonjaw_chmod() permissions
@define('CHMOD_ALL', 7);
@define('CHMOD_READ', 4);
@define('CHMOD_WRITE', 2);
@define('CHMOD_EXECUTE', 1);

// Table names
//define('STYLES_TEMPLATE_TABLE',	$table_prefix . 'styles_template');
define('THEMES_TABLE',   		$table_prefix . 'themes');
define('USERS_TABLE',			$table_prefix . 'users');
define('USER_GROUPS_TABLE',		$table_prefix . 'user_groups');
define('NODES_TABLE',			$table_prefix . 'nodes');
define('ZONES_TABLE',			$table_prefix . 'zones');
define('LOGS_TABLE',			$table_prefix . 'logs');
define('MODULES_TABLE',			$table_prefix . 'modules');
define('MODULES_DETAIL_TABLE',		$table_prefix . 'modules_detail');
define('MODULES_DETAIL_CAT_TABLE',	$table_prefix . 'modules_detail_cat');
define('BROWSERS_TABLE',		$table_prefix . 'browsers');
define('PERMISSIONS_TABLE',		$table_prefix . 'permissions');
define('LANGUAGES_TABLE',		$table_prefix . 'languages');
define('SESSIONS_TABLE',		$table_prefix . 'sessions');
define('STYLES_TABLE',			$table_prefix . 'styles');
define('USER_PERMISSIONS_VIEW',		$table_prefix . 'view_user_permissions');
define('MODULES_VIEW',			$table_prefix . 'view_modules');
define('PRIVILEDGES_VIEW',		$table_prefix . 'view_priviledges');
define('STYLE_SCHEDULES_TABLE',		$table_prefix . 'style_schedules');
define('MENUS_TABLE',			$table_prefix . 'menus');
define('MENU_TRANSLATIONS_TABLE',	$table_prefix . 'menu_translations');
define('MENU_GROUPS_TABLE',		$table_prefix . 'menu_groups');
define('MENU_GROUP_TRANSLATIONS_TABLE',	$table_prefix . 'menu_group_translations');

define('PAGES_TABLE',			$table_prefix . 'pages');
//define('PAGE_THUMBNAILS_TABLE',		$table_prefix . 'page_thumbnails');
define('PAGE_TRANSLATIONS_TABLE',	$table_prefix . 'page_translations');

define('GREETINGS_TABLE',		$table_prefix . 'greetings');
define('GREETING_TRANSLATIONS_TABLE',	$table_prefix . 'greeting_translations');

define('TV_GROUPS_TABLE',		$table_prefix . 'tv_channel_groups');
define('TV_GROUP_TRANSLATIONS_TABLE',	$table_prefix . 'tv_channel_group_translations');
define('TV_CHANNELS_TABLE',		$table_prefix . 'tv_channels');
define('TV_GROUPINGS_TABLE',		$table_prefix . 'tv_channel_groupings');
define('TV_PROMO_TABLE',		$table_prefix . 'tv_promos');
define('POPUP_PROMOS_TABLE',		$table_prefix . 'popup_promos');
define('POPUP_PROMO_SCHEDULE_TABLE',		$table_prefix . 'popup_promo_schedule');

define('MOVIE_GROUPS_TABLE',		$table_prefix . 'movie_groups');
define('MOVIE_GROUP_TRANSLATIONS_TABLE',$table_prefix . 'movie_group_translations');
define('MOVIES_TABLE',			$table_prefix . 'movies');
define('MOVIE_TRANSLATIONS_TABLE',	$table_prefix . 'movie_translations');
define('MOVIE_GROUPINGS_TABLE',		$table_prefix . 'movie_groupings');

define('MUSIC_GROUPS_TABLE',		$table_prefix . 'music_groups');
define('MUSIC_GROUP_TRANSLATIONS_TABLE',$table_prefix . 'music_group_translations');
define('MUSIC_TABLE',			$table_prefix . 'music');
define('MUSIC_TRANSLATIONS_TABLE',	$table_prefix . 'music_translations');
define('MUSIC_GROUPINGS_TABLE',		$table_prefix . 'music_groupings');

define('BACKGROUND_MUSIC_TABLE',			$table_prefix . 'background_music');
define('BACKGROUND_MUSIC_GROUPINGS_TABLE',	$table_prefix . 'background_music_groupings');

define('VALAS_TABLE',			$table_prefix . 'valas');
define('INFORMATION_TABLE',			$table_prefix . 'information');
define('DEVICE_TABLE',			$table_prefix . 'device');

define('DIRECTORIES_TABLE',		$table_prefix . 'directories');
define('DIRECTORY_TRANSLATIONS_TABLE',	$table_prefix . 'directory_translations');
define('DIRECTORY_PROMOS_TABLE',		$table_prefix . 'directory_promos');
define('DIRECTORY_PROMO_TRANSLATIONS_TABLE',	$table_prefix . 'directory_promo_translations');
define('DIRECTORIES2_TABLE',		$table_prefix . 'directories2');
define('DIRECTORY2_TRANSLATIONS_TABLE',	$table_prefix . 'directory2_translations');
define('RESORTMAPS_TABLE',		$table_prefix . 'resortmaps');
define('RESORTMAP_TRANSLATIONS_TABLE',	$table_prefix . 'resortmap_translations');
define('ROOMSUITES_TABLE',		$table_prefix . 'roomsuites');
define('ROOMSUITE_TRANSLATIONS_TABLE',	$table_prefix . 'roomsuite_translations');
define('DININGS_TABLE',		$table_prefix . 'dinings');
define('DINING_TRANSLATIONS_TABLE',	$table_prefix . 'dining_translations');
define('MEETINGEVENTS_TABLE',		$table_prefix . 'meetingevents');
define('MEETINGEVENT_TRANSLATIONS_TABLE',	$table_prefix . 'meetingevent_translations');
define('RECREATIONALS_TABLE',		$table_prefix . 'recreationals');
define('RECREATIONAL_TRANSLATIONS_TABLE',	$table_prefix . 'recreational_translations');
define('GALLERIES_TABLE',		$table_prefix . 'galleries');
define('GALLERY_TRANSLATIONS_TABLE',	$table_prefix . 'gallery_translations');
define('CONTACTUS_TABLE',		$table_prefix . 'contactus');
define('CONTACTUS_TRANSLATIONS_TABLE',	$table_prefix . 'contactus_translations');
define('INHOUSES_TABLE',		$table_prefix . 'inhouses');
define('INHOUSE_TRANSLATIONS_TABLE',	$table_prefix . 'inhouse_translations');
define('PUBLICPLACES_TABLE',		$table_prefix . 'publicplaces');
define('PUBLICPLACE_TRANSLATIONS_TABLE',	$table_prefix . 'publicplace_translations');
define('FORGETS_TABLE',		$table_prefix . 'forgets');
define('FORGET_TRANSLATIONS_TABLE',	$table_prefix . 'forget_translations');
define('LAUNDRY_TABLE',		$table_prefix . 'laundry');
define('LAUNDRY_TRANSLATIONS_TABLE',	$table_prefix . 'laundry_translations');
define('DROP_PICKUPS_TABLE',		$table_prefix . 'drop_pickups');
define('DROP_PICKUP_TRANSLATIONS_TABLE',	$table_prefix . 'drop_pickup_translations');
define('BUSINESS_CENTERS_TABLE',		$table_prefix . 'business_centers');
define('BUSINESS_CENTER_TRANSLATIONS_TABLE',	$table_prefix . 'business_center_translations');
define('WAKEUP_CALLS_TABLE',		$table_prefix . 'wakeup_calls');
define('WAKEUP_CALL_TRANSLATIONS_TABLE',	$table_prefix . 'wakeup_call_translations');
define('CAR_RENTALS_TABLE',		$table_prefix . 'car_rentals');
define('CAR_RENTAL_TRANSLATIONS_TABLE',	$table_prefix . 'car_rental_translations');
define('DOCTORS_TABLE',		$table_prefix . 'doctors');
define('DOCTOR_TRANSLATIONS_TABLE',	$table_prefix . 'doctor_translations');
define('WHATSON_TABLE',		$table_prefix . 'whatson');
define('WHATSON_TRANSLATIONS_TABLE',	$table_prefix . 'whatson_translations');
define('INTERESTS_TABLE',		$table_prefix . 'interests');
define('INTEREST_TRANSLATIONS_TABLE',	$table_prefix . 'interest_translations');
define('MASSAGES_TABLE',		$table_prefix . 'massages');
define('MASSAGE_TRANSLATIONS_TABLE',	$table_prefix . 'massage_translations');

define('WEATHER_TABLE',			$table_prefix . 'weather');
define('ROOMS_TABLE',			$table_prefix . 'rooms');
define('SERVICE_GROUPS_TABLE',		$table_prefix . 'service_groups');
define('SERVICE_GROUP_TRANSLATIONS_TABLE',$table_prefix . 'service_group_translations');
define('SERVICES_TABLE',		$table_prefix . 'services');
define('SERVICE_TRANSLATIONS_TABLE',	$table_prefix . 'service_translations');

define('RUNNINGTEXT_TABLE',		$table_prefix . 'runningtexts');
define('RUNNINGTEXT_GROUPINGS_TABLE',	$table_prefix . 'runningtext_groupings');
define('RUNNINGTEXT_ZONE_GROUPINGS_TABLE',	$table_prefix . 'runningtext_zone_groupings');
define('RUNNINGTEXT_TRANSLATIONS_TABLE',$table_prefix . 'runningtext_translations');
define('RUNNINGTEXT_LOG_TABLE',$table_prefix . 'runningtext_logs');
define('RUNNINGTEXT_FIDS_GROUPINGS_TABLE',	$table_prefix . 'runningtext_fids_groupings');

define('SPA_GROUPS_TABLE',		$table_prefix . 'spa_groups');
define('SPA_GROUP_TRANSLATIONS_TABLE',	$table_prefix . 'spa_group_translations');
define('SPAS_TABLE',			$table_prefix . 'spas');
define('SPA_TRANSLATIONS_TABLE',	$table_prefix . 'spa_translations');

define('SHOP_GROUPS_TABLE',		$table_prefix . 'shop_groups');
define('SHOP_GROUP_TRANSLATIONS_TABLE',	$table_prefix . 'shop_group_translations');
define('SHOPS_TABLE',			$table_prefix . 'shops');
define('SHOP_TRANSLATIONS_TABLE',	$table_prefix . 'shop_translations');

define('TOUR_GROUPS_TABLE',		$table_prefix . 'tour_groups');
define('TOUR_GROUP_TRANSLATIONS_TABLE',	$table_prefix . 'tour_group_translations');
define('TOURS_TABLE',			$table_prefix . 'tours');
define('TOUR_TRANSLATIONS_TABLE',	$table_prefix . 'tour_translations');

define('CARS_TABLE',			$table_prefix . 'cars');
define('CAR_TRANSLATIONS_TABLE',	$table_prefix . 'car_translations');

define('TERAPHISTS_TABLE',		$table_prefix . 'teraphists');
define('TERAPHIST_TRANSLATIONS_TABLE',	$table_prefix . 'teraphist_translations');

define('GUESTS_TABLE',			$table_prefix . 'guests');
define('GUEST_BILLS_TABLE',		$table_prefix . 'guest_bills');
define('GUEST_MESSAGES_TABLE',		$table_prefix . 'guest_messages');
define('GUEST_SERVICES_TABLE',		$table_prefix . 'guest_services');
define('GUEST_SERVICES_DETAIL_TABLE',	$table_prefix . 'guest_services_detail');
define('GUEST_BASKETS_TABLE',		$table_prefix . 'guest_baskets');
define('GUEST_ORDERS_TABLE',		$table_prefix . 'guest_orders');
define('GUEST_ORDERS_DETAIL_TABLE',	$table_prefix . 'guest_orders_detail');
define('GUEST_REQUESTS_TABLE',		$table_prefix . 'guest_requests');
define('GUEST_REQUEST_TRANSLATIONS_TABLE',		$table_prefix . 'guest_request_translations');

define('OUTLET_INDIRECT_BUFFER_TABLE',	$table_prefix . 'outlet_indirect_buffer');


define('AIRPORTS_TABLE',		$table_prefix . 'airports');
define('AIRPORT_FIDS_TABLE',		$table_prefix . 'airport_fids');
define('AIRPORT_FLIGHT_STATUS_TABLE',		$table_prefix . 'airport_flight_status');
define('AIRPORT_PASSENGERS_TABLE',		$table_prefix . 'airport_passengers');
define('AIRPORT_FIDS_UPDATE_TABLE',		$table_prefix . 'airport_fids_update');
define('AIRPORT_FIDS_GROUPINGS_TABLE',		$table_prefix . 'airport_fids_groupings');
define('AIRPORT_FIDS_LOG_TABLE',             $table_prefix . 'airport_fids_log');

define('GUEST_GROUPS_TABLE',			$table_prefix . 'guest_groups');
define('GUEST_GROUPS_INFO_TABLE',		$table_prefix . 'guest_groups_info');
define('GUEST_GROUPS_DETAIL_TABLE',		$table_prefix . 'guest_groups_detail');

define('SIGNAGE_TEMPLATES_TABLE',		$table_prefix . 'signage_templates');
define('SIGNAGES_TABLE',			$table_prefix . 'signages');
define('SIGNAGE_ZONE_GROUPINGS_TABLE',		$table_prefix . 'signage_zone_groupings');
define('SIGNAGE_ROOM_GROUPINGS_TABLE',		$table_prefix . 'signage_room_groupings');
define('SIGNAGE_REGIONS_TABLE',			$table_prefix . 'signage_regions');
define('SIGNAGE_PLAYLIST_TABLE',		$table_prefix . 'signage_playlists');
define('SIGNAGE_PLAYLIST_CONTENT_TABLE',	$table_prefix . 'signage_playlist_contents');
define('SIGNAGE_IMAGE_TABLE',			$table_prefix . 'signage_images');
define('SIGNAGE_TEXT_TABLE',			$table_prefix . 'signage_texts');
define('SIGNAGE_CLIP_TABLE',			$table_prefix . 'signage_clips');
define('SIGNAGE_RSS_TABLE',			$table_prefix . 'signage_rss');
define('SIGNAGE_REGION_GROUPINGS_TABLE',	$table_prefix . 'signage_region_groupings');
define('SIGNAGE_CONTENT_SCHEDULE_TABLE',	$table_prefix . 'signage_content_schedules');

define('SIGNAGE_ADS_TABLE',			$table_prefix . 'signage_ads');
define('SIGNAGE_ADS_LOG_TABLE',			$table_prefix . 'signage_ads_logs');

define('SIGNAGE_URGENCIES_TABLE',		$table_prefix . 'signage_urgencies');
define('SIGNAGE_URGENCIES_TRANSLATION_TABLE',		$table_prefix . 'signage_urgencies_translations');
define('SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE',	$table_prefix . 'signage_urgency_zone_groupings');
define('SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE',	$table_prefix . 'signage_urgency_room_groupings');
define('SIGNAGE_GENERALS_TABLE',		$table_prefix . 'signage_generals');

define('EMERGENCIES_TABLE',			$table_prefix . 'emergencies');
define('TARGET_GATES_TABLE',			$table_prefix . 'target_gates');
define('NODE_TARGET_GATE_GROUPINGS_TABLE',	$table_prefix . 'node_target_gate_groupings');

define('OCCUPANCY_TABLE',			$table_prefix . 'occupancy_daily');
define('OCCUPANCY_DETAIL_TABLE',		$table_prefix . 'occupancy_detail');

define('HOTSPOTS_TABLE',			$table_prefix . 'hotspots');

define('SYNC_TABLE',		$table_prefix . 'sync_flag');
define('CONFIGURATION_TABLE',		$table_prefix . 'configuration');


define('FILE_UPLOAD', 1);

define('ADS_POPUPS_TABLE',		$table_prefix . 'ads_popups');
define('ADS_POPUP_SCHEDULES_TABLE',		$table_prefix . 'ads_popup_schedules');
define('ADS_SLOTS_TABLE',		$table_prefix . 'ads_slots');
define('ADS_ZONE_GROUPINGS_TABLE',		$table_prefix . 'ads_zone_groupings');
define('ADS_CHANNEL_GROUPINGS_TABLE',		$table_prefix . 'ads_channel_groupings');
define('ADS_BANNERS_TABLE',		$table_prefix . 'ads_banners');
define('ADS_BANNER_SCHEDULES_TABLE',		$table_prefix . 'ads_banner_schedules');
define('ADS_BANNER_ZONE_GROUPINGS_TABLE',		$table_prefix . 'ads_banner_zone_groupings');
define('ADS_HOME_TABLE',		$table_prefix . 'ads_home');
define('ADS_HOME_SCHEDULES_TABLE',		$table_prefix . 'ads_home_schedules');
define('ADS_HOME_SCHEDULE_VIEWED_TABLE',		$table_prefix . 'ads_home_schedule_viewed');
define('ADS_HOME_ZONE_GROUPINGS_TABLE',		$table_prefix . 'ads_home_zone_groupings');
define('ADS_LOGS_TABLE',		$table_prefix . 'ads_logs');

define('ADS_POPUP_VIEW',		$table_prefix . 'view_ads_popup');
define('ADS_BANNER_VIEW',		$table_prefix . 'view_ads_banner');
define('ADS_HOME_VIEW',		$table_prefix . 'view_ads_home');


?>
