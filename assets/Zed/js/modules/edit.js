
'use strict';

var selectCountry = {
    selectId: 'tax_rate_fkCountry',

    init: function () {
        this.mapEvents();
    },

    mapEvents: function () {
        var self = this;

        $('#' + self.selectId).on('change', function() {
            var idCountry = $('#tax_rate_fkCountry').val();

            $.ajax({
                type: 'GET',
                url: '/tax/rate/regions',
                dataType: 'json',
                data: {
                    id_country: idCountry
                },
                success: function(data) {
                    var html = '';
                    data.forEach(function(item, index){
                        html += '<option value="' + item.value + '">' + item.label + '</option>'
                    });

                    $('#tax_rate_fkRegion').html(html);
                }
            });
        });
    }
}

$(document).ready(function() {
    selectCountry.init();
});