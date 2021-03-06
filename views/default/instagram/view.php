<?php
/*
Theme Name: Instagram
Theme URI: https://github.com/manacim/Instagram
Author: Cim
Author URI: https://demyx.com/
Description: Instagram widget that displays up to 9 recent posts.
Version: 2.0.0
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: instagram
*/

$username = $_GET['username'];
$id = $_GET['id'];
$json = file_get_contents('https://www.instagram.com/'.$username.'/media/');
$content = json_decode($json);
$items = $content->items;

echo '<div class="ig-container">';
foreach ($items as $key => $value) {
	if ($key == $id) {
		echo '
			<div class="ig-user">
				<img src="'.$value->user->profile_picture.'"> <span><a href="https://instagram.com/'.$value->user->username.'" target="_blank">' . $value->user->full_name . 
			'</a></span></div>';
		echo '<a href="'.$value->link.'" target="_blank"><img src="' . $value->images->standard_resolution->url . '" class="ig-main"></a>';
		echo '
			<ul class="ig-meta">
				<li><i class="fa fa-heart"></i>'.format_num($value->likes->count).'</li>
				<li><i class="fa fa-comment"></i>'.format_num($value->comments->count).'</li>
				<li><i class="fa fa-clock-o"></i>'.elgg_get_friendly_time($value->created_time).'</li>
			</ul>
			<div class="ig-caption">
				'.$value->caption->text.'
			</div>
		';
	}
}
echo '</div>';