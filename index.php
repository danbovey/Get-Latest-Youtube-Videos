<?php
$video = null;
if(!empty($_GET['v'])) {
	$video = $_GET['v'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Get Latest YouTube Videos</title>
	</head>
	<body>
		<section class="video">
		<?php if($video !== null) { ?>
		<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/<?php echo $video; ?>?autoplay=1" frameborder="0" allowfullscreen id="video"></iframe>
		<?php } else { ?>
		<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/CVzWNDklzr0" frameborder="0" allowfullscreen id="video"></iframe>
		<?php } ?>
		</section>
		<section id="videos">
			<?php
			$feedURL = 'http://gdata.youtube.com/feeds/api/users/YOUTUBE_USERNAME/uploads?max-results=50';
			$sxml = simplexml_load_file($feedURL);
			$i=0;
			foreach ($sxml->entry as $entry) {
				$media = $entry->children('media', true);
				$videos = (string)$media->group->player->attributes()->url;
				$thumbnail = (string)$media->group->thumbnail[0]->attributes()->url;
				preg_match('~v=([0-9a-z_]+)~i', $videos, $videos);
				$videos = str_replace('v=', '', $videos);
			?>
			<a href="<?php echo $videos[0]; ?>" class="video"><img src="<?php echo $thumbnail; ?>"></a>
			<?php
			}
			?>
		</section>
	</body>
</html>