<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group" v-el:nama>
                <label for="nama" class="control-label">Nama</label>
                <input type="text" id="nama" v-model="newItem.nama" @keyup.enter="nextInput('zakat')" class="form-control" required>
            </div>
            <div class="form-group" v-el:zakat>
                <label for="zakat" class="control-label">Zakat</label>
                <input type="text" id="zakat" v-model="zakat" @keyup="onKeyUp($event, 'zakat', zakat)" @keyup.enter="nextInput('infaq')" class="form-control">
            </div>
            <div class="form-group" v-el:infaq>
                <label for="infaq" class="control-label">Infaq</label>
                <input type="text" id="infaq" v-model="infaq" @keyup="onKeyUp($event, 'infaq', infaq)" @keyup.enter="save" class="form-control">
            </div>
            <div class="form-group">
                <label for="jumlah" class="control-label">Jumlah</label>
                <input type="text" id="jumlah" v-model="jumlah" class="form-control" readonly>
            </div>
            <div class="form-group">
                <button class="btn btn-success" @click="save">
                    <i class="fa fa-spinner fa-spin" v-if="loading"></i>
                    <i class="fa fa-save" v-if="!loading"></i>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props: ['items', 'newItem']
    , data(){
        return{
            zakat: 0
            , infaq: 0
            , jumlah: 0
            , valid: false
            , loading: false
        }
    }
    , watch: {
        'newItem.zakat + newItem.infaq': function(){
            this.zakat = accounting.formatMoney(this.newItem.zakat)
            this.infaq = accounting.formatMoney(this.newItem.infaq)
            this.newItem.jumlah = parseFloat(this.newItem.zakat) + parseFloat(this.newItem.infaq);
        }
        , 'newItem.jumlah': function(val){
            this.jumlah = accounting.formatMoney(val)
        }
    }
    , methods: {
        save(){
            this.validate()
            if( ! this.valid ) return;
            this.loading = true
            var item = JSON.parse(JSON.stringify(this.newItem))
            if(item.id){
                this.$http.put(BaseUrl + '/data/' + item.id, item).then(function(response){
                    this.reset();
                })
            }else{
                this.$http.post(BaseUrl + '/data', item).then(function(response){
                    this.items.push(response.data)
                    this.reset()
                })
            }
        }
        , reset(){
            this.valid = false
            this.$set('newItem', {
                id: undefined
                , nama: null
                , zakat: 0
                , infaq: 0
                , jumlah: 0
            })
            this.loading = false
            $(this.$els.nama).find('input').focus()

        }
        , validate(){
            var formGroup = $(this.$els.nama)

            formGroup.find('span.help-block').remove();
            if( ! this.newItem.nama ){
                formGroup.addClass('has-error')
                formGroup.append('<span class="help-block"> Nama Tidak Boleh Kosong</span>');
            }else{
                formGroup.removeClass('has-error')
                this.valid = true
            }

            this.$http.get(BaseUrl + '/token').then(function(response){
                this.$http.options.headers['X-CSRF-TOKEN'] = response.data
            })
        }
        , onKeyUp(element, target, model){
            this[target] = accounting.formatMoney(model)
            this.newItem[target] = accounting.unformat(model)
        }
        , nextInput(target){
            $(this.$els[target]).find('input').focus()
        }
    }
}
</script>
