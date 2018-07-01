<?php

// Begin Wordpress function.php code for XRP Tipbot //

// Add the following code below to the end of your /wp-content/themes/<themename>/functions.php
// Afterwards, be sure to Edit your Profile and Add your Twitter handle
// You may need to set an Author to the posts you want to display the tip button by editing/updating a post

// Allow Adding Twitter Account to User/Author Profile on some older or modified installations of WP

function wpb_new_contactmethods( $contactmethods ) {

	return $contactmethods;
}

// Adds Social Fields to the User Profile page (/wp-admin/profile.php) on some older or modified installations of WP

add_filter('user_contactmethods','wpb_new_contactmethods',10,1);

// Generate XRP Tipbot Code with Twitter Handle

function wp_author_xrp_tipbot_box( $content ) {
 
	global $post;
 
// Detect if it is a single post with a post author

	if ( is_single() && isset( $post->post_author ) ) {
 
// Check if author has a twitter account in their profile

	if ( get_the_author_meta('twitter') ) {
	
		$twitter = get_the_author_meta('twitter', $post->post_author);
 
// Display XRP Tipbot Button
	
	// You can add/adjust these parameters to the <a ...> tag.
	// amount=".50" ... adjust the top amount
	// size="275" ... adjust button size
	// unique="true" ... to prevent users to be able to click the Tip button for the second time.
	// label="Give me" ... to change the text before tipping (the amount is appended after this string)
	// labelpt="Woohooo " ... to change the text after tipping (the amount is appended after this string)
	
	
		$tipbot_details .= '<a amount="0.25" size="275" to="' . $twitter . '" network="twitter" href="https://www.xrptipbot.com" target="_blank"></a>
		<script async src="https://www.xrptipbot.com/static/donate/tipper.js" charset="utf-8"></script>';
 
	} 
 
// Pass info to post content

	$content = $content . '<footer class="xrptipbot" ><span style="display: inline-block;margin-bottom: 5px;">Feel like sending <a href="https://twitter.com/' . $twitter . '" target="_blank">@' . $twitter . '</a> a tip?</span></br>' . $tipbot_details . '</footer>';
	// Customize the area around the button (margins, padding, etc) of class .xrptipbot in the custom.css of your theme
	}
	return $content;
	}
 
// Add our function to the post content filter 

add_action( 'the_content', 'wp_author_xrp_tipbot_box' );
 
// Allow HTML in XRP button section 

remove_filter('pre_user_description', 'wp_filter_kses');

//  END XRP Tip Bot Function Code //
