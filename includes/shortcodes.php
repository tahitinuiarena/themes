<?php
/*
	SHORTCODES
*/


/*
==============================================================================================
						COLUMNS
==============================================================================================
*/

/*
* alpha = true ( margin left: 0px )
* omega = true ( margin right: 0px )
*
*
*
*/

/* One column */
function crumble_one_column( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="one columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="one columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="one columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('one_column', 'crumble_one_column');

/* Two Columns */
function crumble_two_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="two columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="two columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="two columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('two_columns', 'crumble_two_columns');

/* Three Columns */
function crumble_three_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="three columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="three columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="three columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('three_columns', 'crumble_three_columns');


/* Four Columns */
function crumble_four_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="four columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="four columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="four columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('four_columns', 'crumble_four_columns');


/* Five Columns */
function crumble_five_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="five columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="five columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="five columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('five_columns', 'crumble_five_columns');

/* Six Columns */
function crumble_six_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="six columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="six columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="six columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('six_columns', 'crumble_six_columns');

/* Seven Columns */
function crumble_seven_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="seven columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="seven columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="seven columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('seven_columns', 'crumble_seven_columns');

/* Eight Columns */
function crumble_eight_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="eight columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="eight columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="eight columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('eight_columns', 'crumble_eight_columns');

/* Nine Columns */
function crumble_nine_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="nine columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="nine columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="nine columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('nine_columns', 'crumble_nine_columns');

/* Ten Columns */
function crumble_ten_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="ten columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="ten columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="ten columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('ten_columns', 'crumble_ten_columns');

/* Eleven Columns */
function crumble_eleven_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="eleven columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="eleven columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="eleven columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('eleven_columns', 'crumble_eleven_columns');

/* Twelve Columns */
function crumble_twelve_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="twelve columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="twelve columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="twelve columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('twelve_columns', 'crumble_twelve_columns');


/* Thirteen Columns */
function crumble_thirteen_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="thirteen columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="thirteen columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="thirteen columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('thirteen_columns', 'crumble_thirteen_columns');

/* Fourteen Columns */
function crumble_fourteen_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="fourteen columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="fourteen columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="fourteen columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('fourteen_columns', 'crumble_fourteen_columns');


/* Fifteen Columns */
function crumble_fifteen_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="fifteen columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="fifteen columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="fifteen columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('fifteen_columns', 'crumble_fifteen_columns');


/* Sixteen Columns */
function crumble_sixteen_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alpha' => '0',
		'omega' => '0',		
	), $atts ) );
	
	if(  $alpha == '1' ) {
		$code = '<div class="sixteen columns alpha">' . do_shortcode( $content ) . '</div>';
	} else if(  $omega == '1' ) {
		$code = '<div class="sixteen columns omega">' . do_shortcode( $content ) . '</div>';
	} else {
		$code = '<div class="sixteen columns">' . do_shortcode( $content ) . '</div>';
	}	
		
	return $code;
}
add_shortcode('sixteen_columns', 'crumble_sixteen_columns');


/*
==============================================================================================
						MARGINS
==============================================================================================
*/

/*
-------------------------------------
	Top Margins
-------------------------------------	
*/

/* margin top 5px  */
function crumble_margin_5t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-5t"></div>';
}
add_shortcode('margin_5t', 'crumble_margin_5t');

/* margin top 10px  */
function crumble_margin_10t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-10t"></div>';
}
add_shortcode('margin_10t', 'crumble_margin_10t');

/* margin top 15px  */
function crumble_margin_15t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-15t"></div>';
}
add_shortcode('margin_15t', 'crumble_margin_15t');

/* margin top 20px  */
function crumble_margin_20t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-20t"></div>';
}
add_shortcode('margin_20t', 'crumble_margin_20t');

/* margin top 25px  */
function crumble_margin_25t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-25t"></div>';
}
add_shortcode('margin_25t', 'crumble_margin_25t');

/* margin top 30px  */
function crumble_margin_30t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-30t"></div>';
}
add_shortcode('margin_30t', 'crumble_margin_30t');

/* margin top 35px  */
function crumble_margin_35t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-35t"></div>';
}
add_shortcode('margin_35t', 'crumble_margin_35t');

/* margin top 40px  */
function crumble_margin_40t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-40t"></div>';
}
add_shortcode('margin_40t', 'crumble_margin_40t');

/* margin top 45px  */
function crumble_margin_45t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-45t"></div>';
}
add_shortcode('margin_45t', 'crumble_margin_45t');

/* margin top 50px  */
function crumble_margin_50t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-50t"></div>';
}
add_shortcode('margin_50t', 'crumble_margin_50t');

/* margin top 55px  */
function crumble_margin_55t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-55t"></div>';
}
add_shortcode('margin_55t', 'crumble_margin_55t');

/* margin top 60px  */
function crumble_margin_60t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-60t"></div>';
}
add_shortcode('margin_60t', 'crumble_margin_60t');



/*
-------------------------------------
	Bottom Margins
-------------------------------------	
*/

/* margin botom 5px  */
function crumble_margin_5b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-5b"></div>';
}
add_shortcode('margin_5b', 'crumble_margin_5b');

/* margin bottom 10px  */
function crumble_margin_10b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-10b"></div>';
}
add_shortcode('margin_10b', 'crumble_margin_10b');

/* margin bottom 15px  */
function crumble_margin_15b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-15b"></div>';
}
add_shortcode('margin_15b', 'crumble_margin_15b');

/* margin bottom 20px  */
function crumble_margin_20b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-20b"></div>';
}
add_shortcode('margin_20b', 'crumble_margin_20b');

/* margin bottom 25px  */
function crumble_margin_25b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-25b"></div>';
}
add_shortcode('margin_25b', 'crumble_margin_25b');

/* margin bottom 30px  */
function crumble_margin_30b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-30b"></div>';
}
add_shortcode('margin_30b', 'crumble_margin_30b');

/* margin bottom 35px  */
function crumble_margin_35b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-35b"></div>';
}
add_shortcode('margin_35b', 'crumble_margin_35b');

/* margin bottom 40px  */
function crumble_margin_40b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-40b"></div>';
}
add_shortcode('margin_40b', 'crumble_margin_40b');

/* margin bottom 45px  */
function crumble_margin_45b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-45b"></div>';
}
add_shortcode('margin_45b', 'crumble_margin_45b');

/* margin bottom 50px  */
function crumble_margin_50b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-50b"></div>';
}
add_shortcode('margin_50b', 'crumble_margin_50b');

/* margin bottom 55px  */
function crumble_margin_55b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-55b"></div>';
}
add_shortcode('margin_55b', 'crumble_margin_55b');

/* margin bottom 60px  */
function crumble_margin_60b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-60b"></div>';
}
add_shortcode('margin_60b', 'crumble_margin_60b');


/*
-------------------------------------
	No Top Margin
-------------------------------------	
*/
function crumble_no_margin_b($atts, $content = null) {
	return '<div class="no-margin-b"></div>';
}
add_shortcode('no_margin_b', 'crumble_no_margin_b');


/*
-------------------------------------
	No Top Margin
-------------------------------------	
*/

function crumble_no_margin_t($atts, $content = null) {
	return '<div class="no-margin-t"></div>';
}
add_shortcode('no_margin_t', 'crumble_no_margin_t');




/*
==============================================================================================
						Highlights
==============================================================================================
*/

/* standard Highlights  */
function crumble_stdHLight($atts, $content = null) {
	return '<span class="highlight">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight', 'crumble_stdHLight');

/* pink Highlights  */
function crumble_pinkHLight($atts, $content = null) {
	return '<span class="highlight pink">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_pink', 'crumble_pinkHLight');

/* green Highlights  */
function crumble_greenHLight($atts, $content = null) {
	return '<span class="highlight green">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_green', 'crumble_greenHLight');

/* red Highlights  */
function crumble_redHLight($atts, $content = null) {
	return '<span class="highlight red">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_red', 'crumble_redHLight');

/* orange Highlights  */
function crumble_orangeHLight($atts, $content = null) {
	return '<span class="highlight orange">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_orange', 'crumble_orangeHLight');

/* blue Highlights  */
function crumble_blueHLight($atts, $content = null) {
	return '<span class="highlight blue">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_blue', 'crumble_blueHLight');

/* yellow Highlights  */
function crumble_yellowHLight($atts, $content = null) {
	return '<span class="highlight yellow">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_yellow', 'crumble_yellowHLight');

/* custom Highlights  */
function crumble_customHLight($atts, $content = null) {
	return '<span class="highlight custom">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_custom', 'crumble_customHLight');

/*
==============================================================================================
						TEXT ALIGNS
==============================================================================================
*/

/* align: Left  */
function crumble_alignLeft($atts, $content = null) {
	return '<p class="text-left">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_left', 'crumble_alignLeft');

/* align: Right  */
function crumble_alignRight($atts, $content = null) {
	return '<p class="text-right">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_right', 'crumble_alignRight');

/* align: Center  */
function crumble_alignCenter($atts, $content = null) {
	return '<p class="text-center">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_center', 'crumble_alignCenter');

/* align: Justify  */
function crumble_alignJustify($atts, $content = null) {
	return '<p class="text-justify">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_justify', 'crumble_alignJustify');


/*
==============================================================================================
						TEXT Italic/Bold
==============================================================================================
*/
/* style: Italic  */
function crumble_fontItalic($atts, $content = null) {
	return '<p class="italic">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('font_italic', 'crumble_fontItalic');

/* style: Bold  */
function crumble_fontBold($atts, $content = null) {
	return '<p class="bold">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('font_bold', 'crumble_fontBold');


/*
==============================================================================================
						DROPCAPS
==============================================================================================
*/

/* standard dropcap  */
function crumble_stdDrop($atts, $content = null) {
	return '<span class="dropcap">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap', 'crumble_stdDrop');

/* pink dropcap  */
function crumble_pinkDrop($atts, $content = null) {
	return '<span class="dropcap pink">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_pink', 'crumble_pinkDrop');

/* green dropcap  */
function crumble_greenDrop($atts, $content = null) {
	return '<span class="dropcap green">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_green', 'crumble_greenDrop');

/* red dropcap  */
function crumble_redDrop($atts, $content = null) {
	return '<span class="dropcap red">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_red', 'crumble_redDrop');

/* orange dropcap  */
function crumble_orangeDrop($atts, $content = null) {
	return '<span class="dropcap orange">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_orange', 'crumble_orangeDrop');

/* blue dropcap  */
function crumble_blueDrop($atts, $content = null) {
	return '<span class="dropcap blue">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_blue', 'crumble_blueDrop');

/* blue dropcap  */
function crumble_yellowDrop($atts, $content = null) {
	return '<span class="dropcap yellow">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_yellow', 'crumble_yellowDrop');


/* custom dropcap  */
function crumble_customDrop($atts, $content = null) {
	return '<span class="dropcap custom">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_custom', 'crumble_customDrop');



/*
==============================================================================================
						Clear Float Blocks
==============================================================================================
*/
function crumble_floatClear($atts, $content = null) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'crumble_floatClear');



/*
==============================================================================================
						Lists
==============================================================================================
*/

/*
	style: unordered / ordered / square / circle / disc / arrow
*/
function crumble_list_shortcode($atts, $content = null) {
	extract( shortcode_atts( 
		array( 
			"style" => '1',
			"underline" => '1' 
		), $atts));
	
	$code = '';
	$list_type = '';
	
	switch ($style) {
	 case 1:
			$list_type = 'unordered';
			break;
	 case 2:
	 		$list_type = 'ordered';
			break;

	 case 3:
	 		$list_type = 'square';
			break;
			
	 case 4:
	 		$list_type = 'circle';
			break;

	 case 5:
	 		$list_type = 'bullets';
			break;
			
	 case 6:
	 		$list_type = 'arrow';
			break;

	 case 7:
	 		$list_type = 'arrow2';
			break;
		
	}
	
	if( $underline == "1" ) {
		$code = '<ul class="list '.$list_type.' underline">' . do_shortcode ( $content ) . '</ul>';
	} else {
		$code = '<ul class="list '.$list_type.'">' . do_shortcode ( $content ) . '</ul>';
	}
	
	return $code;
	
}
add_shortcode('list', 'crumble_list_shortcode' );	


/*
==============================================================================================
						SEPARATORS
==============================================================================================
*/

/* divider full width 1px  */
function crumble_divider_1px($atts, $content = null) {
	return '<div class="divider-1px"></div>';
}
add_shortcode('divider_1px', 'crumble_divider_1px');

/* divider full width 5px  */
function crumble_divider_5px($atts, $content = null) {
	return '<div class="divider-5px"></div>';
}
add_shortcode('divider_5px', 'crumble_divider_5px');

/* divider full width 10px  */
function crumble_divider_10px($atts, $content = null) {
	return '<div class="divider-10px"></div>';
}
add_shortcode('divider_10px', 'crumble_divider_10px');

/* divider full width 15px  */
function crumble_divider_15px($atts, $content = null) {
	return '<div class="divider-15px"></div>';
}
add_shortcode('divider_15px', 'crumble_divider_15px');

/* divider full width 20px  */
function crumble_divider_20px($atts, $content = null) {
	return '<div class="divider-20px"></div>';
}
add_shortcode('divider_20px', 'crumble_divider_20px');

/* divider full width 1px dotted  */
function crumble_divider_1px_dashed($atts, $content = null) {
	return '<div class="divider-1px-dashed"></div><div class="clear"></div>';
}
add_shortcode('divider_1px_dashed', 'crumble_divider_1px_dashed');




/*
==============================================================================================
						Video Shortcode
==============================================================================================
*/
/* 
	id: video id from video services(Support: Youtube , Vimeo , Dialymotion )
	type: video type: youtube/vimeo/dailymotion
	width: Video Width
	height: Video Height

*/
	function crumble_video($atts, $content = null) {
		extract ( shortcode_atts(
			array(
				'id' => '',
				'type' => '',
				'width' => '',
				'height' => '220'
			), $atts ) );
		



			if( $type == 'youtube' ) { 
				$code = '<iframe width="' . $width . '" height="' .$height . '" src="http://www.youtube.com/embed/'. $id . '" frameborder="0" allowfullscreen></iframe>';
			} 
			
			if( $type == 'vimeo') { 
				$code = '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="' . $width . '" height="' . $height . '"></iframe>';
			} 
			
			if($type == 'dailymotion') { 
				$code = '<iframe width="' . $width . '" height="' . $height . '" src="http://www.dailymotion.com/embed/video/'. $id . '?logo=0"></iframe>';
			 } 
			 
		$code = '<div class="video-frame">' . $code . '</div>';

			
		return $code;
	}
add_shortcode('video', 'crumble_video');



/*
==============================================================================================
						Collapse
==============================================================================================
*/

function crumble_collapse( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Collapse Title',

	), $atts ) );
	
	$code =  '<div class="collapse-crumble">';
	$code .= '<h6>' . $title . '</h6>';
	$code .= '<div class="toggle-content">';
	$code .= do_shortcode( $content ) . '</div><!-- /toggle-content -->';
	$code .= '</div><!-- /collapse -->';
			
	return $code;
}
add_shortcode('collapse', 'crumble_collapse');




/*
==============================================================================================
						Google Adsense
==============================================================================================
*/

function crumble_adsense( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'float' => 'left',
		'ad_client' => 'pub-XXXXXXXXXXX',
		'ad_slot' => 'XXXXXXXXXX',
		'ad_width' => '250',
		'ad_height' => '250'

	), $atts ) );
	
	$code = '<div class="adsense-'. $float . '">
		<script type="text/javascript"><!--
    		google_ad_client = "' . $ad_client . '";
    		google_ad_slot = "' . $ad_slot . '";
    		google_ad_width = ' . $ad_width . ';
    		google_ad_height = ' . $ad_height .';
    		//-->
    		</script>
    		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
		</div>';
					
	return $code;
}
add_shortcode('show_AdSense', 'crumble_adsense');
			
			
			
			
			
/*
==============================================================================================
						Float Images
==============================================================================================
*/
/* 
	link: url for your image
	align: left/right/center
	alt: alternative text for your image

*/
function crumble_imgalign($atts, $content = null) {
	extract( shortcode_atts( array(
		'link' => '',
		'align' => 'left',
		'alt' => '',
		'width' => '',
		'height' => ''
	), $atts ) );
	
	if( $align == "left") $code = '<div class="image-border alignleft"><img src="' . $link . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" /><div class="clear"></div></div>';	
	if( $align == "right") $code = '<div class="image-border alignright"><img src="' . $link . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"  /><div class="clear"></div></div>';		
	if( $align == "center") $code = '<div class="image-border aligncenter"><img src="' . $link . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"  /><div class="clear"></div></div>';		
		
	return $code;
}
add_shortcode('image', 'crumble_imgalign');




/*
	--------------------------------------------------------------------------------------------
						ADD SHORTCODES (LIST) TO THE WP EDITOR
	--------------------------------------------------------------------------------------------	
*/


add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    echo '&nbsp;<select id="sc_select">';
            
            /* Columns */
            echo "<option value='[one_column alpha=\"0\" omega=\"0\"]content here[/one_column]'>1 Column</option>";
            echo "<option value='[two_columns alpha=\"0\" omega=\"0\"]content here[/two_columns]'>2 Columns</option>";            
            echo "<option value='[three_columns alpha=\"0\" omega=\"0\"]content here[/three_columns]'>3 Columns</option>";                        
            echo "<option value='[four_columns alpha=\"0\" omega=\"0\"]content here[/four_columns]'>4 Columns</option>";                        
            echo "<option value='[five_columns alpha=\"0\" omega=\"0\"]content here[/five_columns]'>5 Columns</option>";                        
            echo "<option value='[six_columns alpha=\"0\" omega=\"0\"]content here[/six_columns]'>6 Columns</option>";                        
            echo "<option value='[seven_columns alpha=\"0\" omega=\"0\"]content here[/seven_columns]'>7 Columns</option>";                        
            echo "<option value='[eight_columns alpha=\"0\" omega=\"0\"]content here[/eight_columns]'>8 Columns</option>";                        
            echo "<option value='[nine_columns alpha=\"0\" omega=\"0\"]content here[/nine_columns]'>9 Columns</option>";                        
            echo "<option value='[ten_columns alpha=\"0\" omega=\"0\"]content here[/ten_columns]'>10 Columns</option>";                        
            echo "<option value='[eleven_columns alpha=\"0\" omega=\"0\"]content here[/eleven_columns]'>11 Columns</option>";                        
            echo "<option value='[twelve_columns alpha=\"0\" omega=\"0\"]content here[/twelve_columns]'>12 Columns</option>";                        
            echo "<option value='[thirteen_columns alpha=\"0\" omega=\"0\"]content here[/thirteen_columns]'>13 Columns</option>";                        
            echo "<option value='[fourteen_columns alpha=\"0\" omega=\"0\"]content here[/fourteen_columns]'>14 Columns</option>";                                    
            echo "<option value='[fifteen_columns alpha=\"0\" omega=\"0\"]content here[/fifteen_columns]'>15 Columns</option>";                                                
            echo "<option value='[sixteen_columns alpha=\"0\" omega=\"0\"]content here[/sixteen_columns]'>16 Columns</option>";                                                            
            
                      
            /* Margins */            
            echo "<option value='[margin_5t]'>Top Margin 5px</option>";            
            echo "<option value='[margin_10t]'>Top Margin 10px</option>";                        
            echo "<option value='[margin_15t]'>Top Margin 15px</option>";                                    
            echo "<option value='[margin_20t]'>Top Margin 20px</option>";                                    
            echo "<option value='[margin_25t]'>Top Margin 25px</option>";                        
            echo "<option value='[margin_30t]'>Top Margin 30px</option>";                                    
            echo "<option value='[margin_35t]'>Top Margin 35px</option>";                                                
            echo "<option value='[margin_40t]'>Top Margin 40px</option>";
            echo "<option value='[margin_45t]'>Top Margin 45px</option>";
            echo "<option value='[margin_50t]'>Top Margin 50px</option>";                                    
            echo "<option value='[margin_55t]'>Top Margin 55px</option>";            
            echo "<option value='[margin_60t]'>Top Margin 60px</option>";            

            echo "<option value='[margin_5b]'>Bottom Margin 5px</option>";            
            echo "<option value='[margin_10b]'>Bottom Margin 10px</option>";                        
            echo "<option value='[margin_15b]'>Bottom Margin 15px</option>";                                    
            echo "<option value='[margin_20b]'>Bottom Margin 20px</option>";                                    
            echo "<option value='[margin_25b]'>Bottom Margin 25px</option>";                        
            echo "<option value='[margin_30b]'>Bottom Margin 30px</option>";                                    
            echo "<option value='[margin_35b]'>Bottom Margin 35px</option>";                                                
            echo "<option value='[margin_40b]'>Bottom Margin 40px</option>";
            echo "<option value='[margin_45b]'>Bottom Margin 45px</option>";
            echo "<option value='[margin_50b]'>Bottom Margin 50px</option>";                                    
            echo "<option value='[margin_55b]'>Bottom Margin 55px</option>";            
            echo "<option value='[margin_60b]'>Bottom Margin 60px</option>";            

            echo "<option value='[no_margin_t]'>No Top Margin</option>";                        
            echo "<option value='[no_margin_b]'>No Bottom Margin</option>";                                    
           

           /* Highlights */            
		   echo "<option value='[highlight]content here[/highlight]'>Highlight</option>";           
		   echo "<option value='[highlight_pink]content here[/highlight_pink]'>Highlight Pink</option>";		   
		   echo "<option value='[highlight_green]content here[/highlight_green]'>Highlight Green</option>";		   
		   echo "<option value='[highlight_red]content here[/highlight_red]'>Highlight Red</option>";		   
		   echo "<option value='[highlight_orange]content here[/highlight_orange]'>Highlight Orange</option>";		   
		   echo "<option value='[highlight_blue]content here[/highlight_blue]'>Highlight Blue</option>";		   
		   echo "<option value='[highlight_yellow]content here[/highlight_yellow]'>Highlight Yellow</option>";		   		   		   		   		   		   
		   echo "<option value='[highlight_custom]content here[/highlight_custom]'>Highlight Custom (by color theme)</option>";		   		   		   		   		   		   		   


           /* Text Aligns */ 
           echo "<option value='[text_left]content here[/text_left]'>Text Align Left</option>";           
           echo "<option value='[text_right]content here[/text_right]'>Text Align Right</option>";           
           echo "<option value='[text_center]content here[/text_center]'>Text Align Center</option>";           
           echo "<option value='[text_justify]content here[/text_justify]'>Text Align Justify</option>";           

           /* Font Styles */ 
           echo "<option value='[font_italic]content here[/font_italic]'>Font Italic</option>";                                    
           echo "<option value='[font_bold]content here[/font_bold]'>Font Bold</option>";           

           /* Dropcaps */                       
		   echo "<option value='[dropcap]content here[/dropcap]'>Dropcap Standard</option>";		   		   		   		   		   		   		              
		   echo "<option value='[dropcap_pink]content here[/dropcap_pink]'>Dropcap Pink</option>";
		   echo "<option value='[dropcap_green]content here[/dropcap_green]'>Dropcap Green</option>";
		   echo "<option value='[dropcap_red]content here[/dropcap_red]'>Dropcap Red</option>";
		   echo "<option value='[dropcap_orange]content here[/dropcap_orange]'>Dropcap Orange</option>";
		   echo "<option value='[dropcap_yellow]content here[/dropcap_yellow]'>Dropcap Yellow</option>";		   
		   echo "<option value='[dropcap_blue]content here[/dropcap_blue]'>Dropcap Blue</option>";
		   echo "<option value='[dropcap_custom]content here[/dropcap_custom]'>Dropcap Custom (by color theme)</option>";		   		   		   		   		   		   
        
           /* Clear Floats */   
           echo "<option value='[clear]'>Clear Floats</option>";		   		   		   		   		   		   

             /* Lists */              
		   echo "<option value='[list style=\"1\" underline=\"1\"]<li>content here</li><li>content here</li><li>content here</li>[/list]'>Lists</option>";		   		   		   		   		   		   
           

           /* Dividers */              
		   echo "<option value='[divider_1px]'>Divider 1px</option>";		   		   		   		   		   		   
		   echo "<option value='[divider_5px]'>Divider 5px</option>";		   		   		   		   		   		   		   
		   echo "<option value='[divider_10px]'>Divider 10px</option>";		   		   		   		   		   		   		   			
		   echo "<option value='[divider_15px]'>Divider 15px</option>";		   		   		   		   		   		   		   					   
		   echo "<option value='[divider_20px]'>Divider 20px</option>";		   		   		   		   		   		   		   					      		   
		   echo "<option value='[divider_1px_dashed]'>Divider 1px Dashed</option>";		   		   		   		   		   		   		   
		   	   
           /* Images */              		   
		   echo "<option value='[image link=\"\" align=\"left\" alt=\"\"]' width=\"\" height=\"\">Image</option>";		   		   		   		   		   		   

           /* Video */              		   
		   echo "<option value='[video id=\"34162267\" type=\"vimeo\" width=\"\" height=\"320\"]'>Video</option>";		   		   		   		   		   		   

           /* Collapse */              		   
		   echo "<option value='[collapse title=\"Your Title\"]Content here[/collapse]'>Collapse</option>";		   		   		   		   		   		   

         /* AdSense */              		   
		   echo "<option value='[show_AdSense float=\"left\" ad_client=\"pub-XXXXXXXXXXX\" ad_slot=\"XXXXXXXXXX\" ad_width=\"250\" ad_height=\"250\" ]'>Google AdSense</option>";		   		   		   		   		   		   
		              
   echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
    echo '<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery("#sc_select").change(function() {
              send_to_editor(jQuery("#sc_select :selected").val());
                  return false;
        });
    });
    </script>';
}
?>