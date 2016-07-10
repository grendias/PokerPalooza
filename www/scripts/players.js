$(function () {
    if ($('.game').data('id') && $('.game').data('id') > 0 && $(".players li").length == 0)
    {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup.add-players').removeClass('hidden');
    };
    
    $('#Add_Player').on('click', function () {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup').addClass('hidden');
        $('.popup.add-player').removeClass('hidden');
    });

    $('#Add_Players').on('click', function () {
        $('#Modal_Overlay').removeClass('hidden');
        $('.popup').addClass('hidden');
        $('.popup.add-players').removeClass('hidden');
    });

    $('#Button_Upsert_Player').on('click', function () {
        upsertGamePlayer();
        
        $('#modal_overlay').addClass('hidden');
        $('.popup-add-player').addClass('hidden');
        stopTimer();
        location.reload();
    });

    $('#Button_Upsert_Players').on('click', function () {
        upsertGamePlayers();
    });

    $('#Button_Cancel_Upsert_Player').on('click', function () {
        $('#Modal_Overlay').addClass('hidden');
        $('.popup.add-player').addClass('hidden');
    });

    $('#Button_Cancel_Upsert_Players').on('click', function () {
        $('#Modal_Overlay').addClass('hidden');
        $('.popup.add-players').addClass('hidden');
    });

    $('.players li').on('click', function (e) {
        e.stopImmediatePropagation();
        $('.player-menu:not(.hidden)').addClass('hidden');
        $('body').addClass('close-menu');
        $(this).find('.player-menu').removeClass('hidden');
    });

    $('body').on('click', function () {
        if($(this).hasClass('close-menu')) {
            $('.player-menu:not(.hidden)').addClass('hidden');
        }
    });

    $('.player-menu-collapse').on('click', function (e) {
        e.stopImmediatePropagation();
        $('#Modal_Overlay').addClass('hidden');
        $(this).closest('.player-menu').addClass('hidden');
    });

    $('.button.buy-in').click(function (e) {
        e.stopImmediatePropagation();
        var playerid = $(this).closest('li').data('gameplayerid');
        upsertPlayerBuyin(playerid, false, false);
    });

    $('.button.rebuy').on('click', function (e) {
        e.stopImmediatePropagation();
        upsertPlayerBuyin($(this).closest('li').data('gameplayerid'), true, false);
    });

    $('.button.boost').on('click', function (e) {
        e.stopImmediatePropagation();
        upsertPlayerBuyin($(this).closest('li').data('gameplayerid'), false, true);
    });

    $('.button.place').on('click', function (e) {
        e.stopImmediatePropagation();
        upsertPlayerPlacing($(this).closest('li').data('gameplayerid'));
    });

    $('.button.remove-player').on('click', function (e) {
        e.stopImmediatePropagation();
        removePlayer();
    });
    
    function upsertGamePlayers() {
        $('#result_message').html("");

        $("#Upsert_Players li").each(function () {
            if ($(this).find('input').is(':checked')) {
                $('#PlayerID').val($(this).data('id'));
                var data = upsertGamePlayer();
                if (data) {
                    if (data.message) {
                        $('#result_message').append(data.message + "\r\n");
                    }
                }
            }
        });
        
        $('#modal_overlay').addClass('hidden');
        $('.popup-add-player').addClass('hidden');
        stopTimer();
        location.reload();
    }

    function upsertGamePlayer() {
        var data = {
            'GameID': $('.game').data('id'),
            'PlayerID': $('#PlayerID').val(),
            'FirstName': $('#FirstName').val(),
            'LastName': $('#LastName').val(),
            'Phone': $('#Phone').val(),
            'Email': $('#Email').val()
        };

        $.ajax({
            url: "api/upsertgameplayer.php",
            type: "post",
            async: false,
            data: JSON.stringify(data),
            dataType: 'json'
        })
        .done(function (data) {
            return data;
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }

    function upsertPlayerBuyin(gpid, isrebuy, isboost) {
        var data = {
            'GamePlayerID': gpid,
            'IsRebuy': isrebuy,
            'IsBoost': isboost
        };

        $.ajax({
            url: "api/upsertbuyin.php",
            type: "post",
            data: JSON.stringify(data),
            dataType: 'json'
        })
        .done(function (data) {
            if (data) {
                if (data.message) {
                    $('#result_message').html(data.message);
                }
                else {
                    $('#modal_overlay').addClass('hidden');
                    $('.popup player-menu').addClass('hidden');
                    stopTimer();
                    location.reload();
                }
            }
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }

    function upsertPlayerPlacing(gameplayerid) {
        var data = {
            'GameID': $('.game').data('id'),
            'GamePlayerID': gameplayerid
        };

        $.ajax({
            url: "api/upsertplayerplacing.php",
            type: "post",
            data: JSON.stringify(data),
            dataType: 'json'
        })
        .done(function (data) {
            if (data) {
                if (data.message) {
                    $('#result_message').html(data.message);
                }
                else {
                    $('#modal_overlay').addClass('hidden');
                    $('.popup player-menu').addClass('hidden');
                    stopTimer();
                    location.reload();
                }
            }
        })
        .error(function (e) {
            alert(e.responseText);
        });
    }

    function stopTimer() {
        $('#stop_timer').click();
    }
});