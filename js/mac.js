(function ($) {
Drupal.behaviors.mac = {
attach: function(context, settings) {
  $('.section-blog .links .node-readmore a').addClass("btn btn-custom");
}
};
})(jQuery);