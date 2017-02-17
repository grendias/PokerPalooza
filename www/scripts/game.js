$(function () {
    if (!$('.game').data('id') || $('.game').data('id') == 0)
    {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup.main-menu').removeClass('hidden');
    };
    
    $(".blinds li.completed-0").first().addClass('active');
    
    $(document).keypress(function(e) {
        if(e.which == 13) {
            e.stopImmediatePropagation();
            $(".popup").each(function() {
                if (!$(this).hasClass('hidden')) {
                    $(this).find('.submit').click();
                    return false;
                }
            });
        }
    });
    
    $('#Menu_Expand').on('click', function () {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup.main-menu').removeClass('hidden');
    });

    $('.menu-collapse').on('click', function () {
        $('#Modal_Overlay').addClass('hidden');
        $('.popup.main-menu').addClass('hidden');
    });
    
    $('#New_Game').on('click', function () {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup').addClass('hidden');
        $('.popup.new-game').removeClass('hidden');
    });
    
    $('#Close_Game').on('click', closeGame);

    $('#Button_Upsert_Game').on('click', function () {
        upsertGame();
    });

    $('.button.cancel').on('click', function () {
        $('#Modal_Overlay').addClass('hidden');
        $(this).closest('.popup').addClass('hidden');
    });
    
    $('#Configure_Payouts').on('click', function () {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup.set-payouts').removeClass('hidden');
    });

    $('#Button_Upsert_Payouts').on('click', function () {
        upsertPayouts();
    });
    
    $('#Theme_Picker').on('change', function () {
       updateTheme(); 
    });
    
    function closeGame() {
        $.ajax({
            url: "api/closegame.php",
            type: "post",
            contentType: 'application/json'
        }).done(function (data) {
            if (data)
            {
                if (data.message && data.message != "000000") {
                    $('#result_message').html(data.message);
                    $('#modal_overlay').addClass('hidden');
                    $('.popup.main-menu').addClass('hidden');
                }
                else {
                    $('#modal_overlay').addClass('hidden');
                    $('.popup.main-menu').addClass('hidden');
                    location.reload();
                }
            }
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }

    function upsertGame() {
        var data = {
            'Date': $('#Date').val(),
            'BlindIncrementID': $('#BlindIncrementID').val(),
            'BuyInID': $('#BuyinID').val(),
            'BeginningStack': $('#BeginningStack').val(),
            'BumpCost': $('#BumpCost').val(),
            'BumpStack': $('#BumpStack').val()
        };

        $.ajax({
            url: "api/upsertgame.php",
            type: "post",
            contentType: 'application/json',
            data: JSON.stringify(data),
        }).done(function (data) {
            if (data)
            {
                if (data.message) {
                    $('#result_message').html(data.message);
                }
                else {
                    $('#modal_overlay').addClass('hidden');
                    $('.popup.new-game').addClass('hidden');
                    location.reload();
                }
            }
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }

    function upsertPayouts(data) {
        var data = {
            'Date': $('#Date').val(),
            'BlindIncrementID': $('#BlindIncrementID').val(),
            'BuyInID': $('#BuyinID').val(),
            'BeginningStack': $('#BeginningStack').val()
        };

        $.ajax({
            url: "api/upsertgame.php",
            type: "post",
            contentType: 'application/json',
            data: JSON.stringify(data),
        }).done(function (data) {
            if (data)
            {
                if (data.message) {
                    $('#result_message').html(data.message);
                }
                else {
                    $('#modal_overlay').addClass('hidden');
                    $('.popup-new-game').addClass('hidden');
                    location.reload();
                }
            }
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }

    function updateTheme() {
        var data = {
            'GameID': $('.game').data('id'),
            'ThemeID': $('#Theme_Picker').val()
        };

        $.ajax({
            url: "api/updatetheme.php",
            type: "post",
            contentType: 'application/json',
            data: JSON.stringify(data),
        }).done(function (data) {
            if (data)
            {
                if (data.message) {
                    $('#result_message').html(data.message);
                }
            }
            else {
                $('#modal_overlay').addClass('hidden');
                $('.popup-main-menu').addClass('hidden');
                location.reload();
            }
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }
});