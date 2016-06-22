var Vue = require('vue')
    , VueResource = require('vue-resource')

window.ls = require('local-storage')
window._ = require('underscore');
window.BaseUrl = document.querySelector('base').getAttribute('href');
window.accounting = require('accounting')

accounting.settings = {
	currency: {
		symbol : "Rp ",   // default currency symbol is 'rp'
		format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
		decimal : ".",  // decimal point separator
		thousand: ",",  // thousands separator
		precision : 0   // decimal places
	},
	number: {
		precision : 0,  // default precision on numbers is 0
		thousand: ",",
		decimal : "."
	}
}

Vue.use(VueResource)

Vue.http.options.headers['X-CSRF-TOKEN'] = document.querySelector('[name=_token]').getAttribute('content')

import formData from './form.vue'
import display from './display.vue'
import tableData from './table.vue'

new Vue({
    el: '#app'
    , data(){
        return {
            items: []
            , newItem: {
                id: undefined
                , nama: null
                , zakat: 0
                , infaq: 0
                , jumlah: 0
            }
        }
    }
    , attached(){
        this.init()
    }
    , methods: {
        init(){
            this.$http.get(BaseUrl+ '/data').then(function(response){
                if(response.data){
                    ls.set('data', response.data);
                    this.items = response.data
                }
            })
        }
    }
    , computed: {
        total_zakat(){
            return _.reduce(this.items, function(before, item){ return before + parseFloat(item.zakat); }, 0);
        }
        , total_infaq(){
            return _.reduce(this.items, function(before, item){ return before + parseFloat(item.infaq); }, 0);
        }
        , total(){
            return _.reduce(this.items, function(before, item){ return before + parseFloat(item.jumlah); }, 0);
        }
    }
    , watch: {
        items: {
            handler(val, old){
                ls.set('data', val)
            }
            , deep: true
        }
    }
    , components: {
        formData, display, tableData
    }
})
