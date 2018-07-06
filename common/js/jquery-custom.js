$(document).ready(function(){

    $('.slot-game-button').click(function(){
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
    });


    $(".box-balance").click(function() {
        $('.box-balance-container').slideToggle('slow', 'easeInOutBack');
    });

    //Language Option
    $(".lang-active").click(function(){
        $("#lang-list").slideToggle('slow', 'easeInOutBack');
    });

    //Tooltip
    $('.tooltip').hide();
    $('.icon-tip-currency').hover(function(){ $('.tooltipCurrency').show();}, function() {$('.tooltipCurrency').hide(); });
    $('.icon-tip-wallet').hover(function(){ $('.tooltipWallet').show();}, function() {$('.tooltipWallet').hide(); });
    $('.icon-tip-mainwallet').hover(function(){ $('.tooltipMainWallet').show();}, function() {$('.tooltipMainWallet').hide(); });

    $('.terms-container').hide();
    $('.link-terms').click(function() {
        $('.terms-container').fadeIn(20);
    });
    $('.terms-container h1 a').click(function() {
        $('.terms-container').fadeOut(20);
    });


    //Text Count
    var text_max = 99;
    $('#textarea_feedback').html(text_max);
    $('#textarea').keyup(function() {
        var text_length = $('#textarea').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_remaining);
    });

    //Placeholder
    $("input, input:password, textarea").placeholder({customClass:'placeholder'});

    //Scrollbar Custom
    $(".notice-content, .terms-content").mCustomScrollbar({scrollInertia:200});
    $("#popup-wallet div.popup-content").mCustomScrollbar({scrollInertia:200});
    $("#popup-customer div.popup-content").mCustomScrollbar({scrollInertia:200});


    //Pagination
    $('#pagination-container, #pagination-container2, #pagination-container3, #pagination-container4, #pagination-container5').simplePagination({
        pagination_container: 'div.list-items',
        items_per_page: 12,
        number_of_visible_page_numbers: 10
    });
});