<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Dynamic_Winners
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dw_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'dw_body_classes' );

/**
 * Builds the share buttons acrross different articles / pages
 * @param string $label     What appears before the button
 * @param string $title     Normally the page title
 * @param string $description   Normally the page description
 * @param string $classes       CSS classes to add on the wrapper
 * @return string (html)
 */
function dw_share_buttons( $label = 'Share', $url = '', $title = '', $description = '', $classes = '' ) {
	$url = urlencode(html_entity_decode( $url, ENT_COMPAT, 'UTF-8') );
	$title = rawurlencode(html_entity_decode( $title, ENT_COMPAT, 'UTF-8') );
	$description = urlencode(html_entity_decode( $description, ENT_COMPAT, 'UTF-8') );
	$html = '<div class="share-this ' . $classes . '">';
	if ( $label != '' ) {
		$html .= '<span class="label">' . $label . ': </span>';
	}
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' Facebook" href="https://www.facebook.com/sharer/sharer.php?t=' . $title . '&u=' . $url . '" class="link-share-facebook"><span class="icon-facebook"></span></a>';
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' Twitter" href="https://twitter.com/intent/tweet?original_referer=' . $url . '&text=' . $title . ': ' . $url . '&via=dynamicwinners" class="link-share-twitter"><span class="icon-twitter"></span></a>';
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' Google+" href="https://plus.google.com/share?url=' . $url . '" class="link-share-gplus"><span class="icon-gplus"></span></a>';
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' LinkedIn" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '" class="link-share-in"><span class="icon-linkedin"></span></a>';
//	$html .= '<a title="'. esc_html__( 'Send by', 'dw' ) .' email" href="mailto:?subject=' . $title . '&body='. esc_html__( 'I have just read this interesting article', 'dw' ) .': ' . $url . '" class="link-share-email"><span class="icon--email"></span></a>';
	//$html .= '<a title="'. esc_html__( 'Share on', 'eduardodomingos' ) .' WhatsApp" href="whatsapp://send?text=' . $title . ': ' . $url . '" class="link-share-whatsapp" data-action="share/whatsapp/share" style="display:none"><span class="icon--whatsapp"></span></a>';
	$html .= '</div>';
	return $html;
}
