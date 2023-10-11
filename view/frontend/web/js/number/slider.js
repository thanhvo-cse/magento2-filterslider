define([
    'jquery',
    'Magento_Catalog/js/price-utils',
    'jquery/ui',
    'ThanhVo_FilterSlider/js/layer'
], function($, priceUltil) {
    "use strict";

    $.widget('thanhvo.layerSlider', $.thanhvo.layer, {
        options: {
            sliderElement: '.thanhvo_number_slider',
            textElement: '.thanhvo_number_text'
        },
        _create: function () {
            var self = this;
            self.element.find(this.options.sliderElement).slider({
                min: self.options.priceMin,
                max: self.options.priceMax,
                values: [self.options.selectedFrom, self.options.selectedTo],
                slide: function( event, ui ) {
                    self.showText(ui.values[0], ui.values[1]);
                },
                change: function(event, ui) {
                    console.log('start loading');
                    self.ajaxSubmit(self.getUrl(ui.values[0], ui.values[1]));
                }
            });
            this.showText(this.options.selectedFrom, this.options.selectedTo);
        },

        getUrl: function(from, to){
            var href = new URL(this.options.ajaxUrl);
            href.searchParams.set(this.options.attributeCode, from + '-' + to);
            return href.toString();
        },

        showText: function(from, to){
            this.element.find(this.options.textElement).html('<span class="price">' + from + '</span> <span class="to">to</span> <span class="price">' + to + '</span>');
        }
    });

    return $.thanhvo.layerSlider;
});
