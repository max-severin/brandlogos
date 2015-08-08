/**
 * brlgs.backend.settings.js
 * Module brlgsBackendSettings
 */

/*global $, brlgsBackendSettings */

var brlgsBackendSettings = (function () { "use strict";
    //---------------- BEGIN MODULE SCOPE VARIABLES ---------------
    var
        onFormSubmit, initModule;
    //----------------- END MODULE SCOPE VARIABLES ----------------

    //------------------- BEGIN EVENT HANDLERS --------------------
    onFormSubmit = function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        var f = $(this);
        var st = f.find('select[name="shop_brlgs[status]"] option:selected').val();
            
        $.post(f.attr('action'), f.serialize(), function(response) {
            if (response.status == 'ok') {
                f.find('#wa-design-button').removeClass('red').addClass('green');
                f.find('#wa-editor-status-fail').hide()
                f.find('#wa-editor-status-ok span').html(response.data.message);
                f.find('#wa-editor-status-ok').fadeIn('slow', function() {
                    $(this).fadeOut(1000);
                });
                if( st === 'on' ) {
                    $('#save-brlgs-form').closest('.settings-wrapper').show();
                } else {
                    $('#save-brlgs-form').closest('.settings-wrapper').hide();
                }
            } else {
                f.find('#wa-design-button').removeClass('green').addClass('red');
                f.find('#wa-editor-status-ok').hide();
                f.find('#wa-editor-status-fail span').html(response.errors.join(', '));
                f.find('#wa-editor-status-fail').fadeIn('slow');
            }
        }, 'json');
    };
    //------------------- END EVENT HANDLERS ----------------------

    //------------------- BEGIN PUBLIC METHODS --------------------
    initModule = function () {
        $('#plugins-settings-form').on('submit', onFormSubmit);
    };

    return {
        initModule: initModule
    };
    //------------------- END PUBLIC METHODS ----------------------
}());