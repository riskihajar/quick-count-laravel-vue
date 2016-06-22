<style lang="scss">
h1,h2,h3,h4,h5,h6{
    margin: 0;
    padding: 0;
}
</style>
<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <h4 class="pull-left">Jumlah Zakat</h4>
            <h3 class="text-success pull-right">{{ total_zakat|currency "Rp &nbsp; " 0 }} ,-</h3>
            <div class="clearfix"></div>
            <hr>
            <h4 class="text-left">Jumlah Infaq</h4>
            <h3 class="text-success text-right">{{ total_infaq|currency "Rp &nbsp; " 0 }} ,-</h3>
            <div class="clearfix"></div>
            <hr>
            <h4 class="text-left">Jumlah Zakat + Infaq</h4>
            <h3 class="text-success text-right">{{ total|currency "Rp &nbsp; " 0 }} ,-</h3>
        </div>
    </div>
</template>
<script>
export default{
    props: ['items', 'total_zakat', 'total_infaq', 'total']
    , attached(){
        var self = this
        setInterval(function(){
            self.timer();
        }, 300)
    }
    , methods: {
        timer(){
            var data = ls.get('data');
            // window.console.log(data)
            this.items = data
        }
    }
}
</script>
