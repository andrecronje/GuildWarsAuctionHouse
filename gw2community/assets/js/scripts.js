/*$.get( "ajax/reddit_feed.php", function( data ) {
  $( "#reddit_content" ).html( data );
});*/

$.get( "assets/ajax/gw2tp.php", function( data ) {
  $( "#flip_content" ).html( data );
  initFontResize();
});