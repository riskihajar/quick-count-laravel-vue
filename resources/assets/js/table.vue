<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th class="text-right">Zakat</th>
                            <th class="text-right">Infaq</th>
                            <th class="text-right">Jumlah</th>
                            <th width="160">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(index, item) in items">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.nama }}</td>
                            <td class="text-right">{{ item.zakat|currency "Rp " 0 }}</td>
                            <td class="text-right">{{ item.infaq|currency "Rp " 0 }}</td>
                            <td class="text-right">{{ item.jumlah|currency "Rp " 0 }}</td>
                            <th class="text-right">
                                <button class="btn btn-default btn-xs" @click="editItem(item)"><i class="fa fa-pencil"></i> Edit</button>
                                <button class="btn btn-danger btn-xs" @click="deleteItem(item)"><i class="fa fa-times"></i> Hapus</button>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th class="text-right">{{ total_zakat|currency "Rp " 0 }}</th>
                            <th class="text-right">{{ total_infaq|currency "Rp " 0 }}</th>
                            <th class="text-right">{{ total|currency "Rp " 0 }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props: ['items', 'total_zakat', 'total_infaq', 'total', 'new-item']
    , methods: {
        deleteItem: function(item){
            var c = window.confirm('Kamu yakin akan menghapus data ini?');

            if(c) {
                this.$http.delete(BaseUrl+'/data/' + item.id).then(function(response){
                    this.items.$remove(item)
                })
            }
        }
        , editItem: function(item){
            // window.console.log(this.newItem)
            this.newItem = item
        }
    }
}
</script>
