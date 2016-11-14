(function($) {
$.fn.hoverfade = function() //wrap our plugin codes in jquery function property.
{
    $(this).fadeTo("slow", 0.30); // on load, reduce element(this) opacity to 30%

    this.mouseenter(OnEnter).mouseleave(OnLeave); //On mouseenter / mouseleave, call our functions

        function OnEnter() //Executes on mouseenter
    {
        $(this).fadeTo("slow", 1); //Bring opacity back to 100%
    }
    function OnLeave() //Executes on mouseleave
    {
        $(this).fadeTo("slow", 0.30); //recude opacity to 30%
    }
}
})(jQuery);