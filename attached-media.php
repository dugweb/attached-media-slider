// RV Detail page with image slider of attached images.
function get_attached_media_for_post($atts) {
	extract( shortcode_atts( array(
		'postid' => ''), $atts)
	);
	
  
	$gallery = get_attached_media('image', $postid);
	$pagingbtns = "<div id='attachments-carousel' class='attached-images carousel slide'>";		
	$pagingbtns .= "<ol class='carousel-indicators'>";
	$carouselinner = "<div class='carousel-inner'>";
	
	
	$index = 0;
	foreach ($gallery as $image) {
		
		$img_full = wp_get_attachment_url($image->ID);
		$img = wp_get_attachment_image_src($image->ID, 'large');
		
		if ($img !== false) {
			$active = "";
			
			if ($index == 0) {
				$active = "active";	
			}
			
			
			$pagingbtns .= "<li data-target='#attachments-carousel' data-slide-to='" . $index ."' class='" . $active . "'>";
			
			
			$carouselinner .= "<div class='item " . $active . "'>";
			$carouselinner .= "<a class='' href='". $img_full ."' title='". $image->post_title . "'>";
			$carouselinner .= "<img src='" . $img[0] . "' class='img-responsive' /></a>";
			$carouselinner .= "</div>";
			
		}
		$index += 1;
	}
	
	$pagingbtns .= "</ol>";
	$carouselinner .= "</div>";
	
	$controls = '<a class="left carousel-control" href="#attachments-carousel" role="button" data-slide="prev">';
    $controls .= '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
    $controls .= '<span class="sr-only">Previous</span>';
    $controls .= '</a>';
    $controls .= '<a class="right carousel-control" href="#attachments-carousel" role="button" data-slide="next">';
    $controls .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
    $controls .= '<span class="sr-only">Next</span>';
    $controls .= '</a>';
	
	$output = $pagingbtns . $carouselinner . $controls;
	$output .= "</div>";

	return $output;
}
add_shortcode('attached_pics', 'get_attached_media_for_post');
