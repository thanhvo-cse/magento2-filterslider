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
                frontendInput: self.options.frontendInput,
                min: self.options.min,
                max: self.options.max,
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
            this.element.find(this.options.textElement).html('<span class="price">' + this.formatNumber(from, this.options.fromPattern) + '</span> <span class="to">to</span> <span class="price">' + this.formatNumber(to, this.options.toPattern) + '</span>');
        },

        formatNumber: function(value, pattern) {
            var priceFormat = this.options.priceFormat;
            if (this.options.frontendInput != "price") {
                priceFormat.pattern = '%s';
            }

            if (pattern == "") {
                return priceUltil.formatPrice(value, priceFormat);
            }

            var numberPlaceholder = pattern.match(/\%s(\|\d+)?/g);
            var t = 0;
            return pattern.replace(/\%s(\|\d+)?/g, function(match) {
                var individualPriceFormat = { ...priceFormat };
                var placeholder = numberPlaceholder[t++].split("|");
                if (placeholder.length > 1) {
                    individualPriceFormat.precision = placeholder[1];
                    individualPriceFormat.requiredPrecision = placeholder[1];
                }

                return priceUltil.formatPrice(value, individualPriceFormat);
            });
        }
    });

    return $.thanhvo.layerSlider;
});
