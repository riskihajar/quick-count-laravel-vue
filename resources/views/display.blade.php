@extends('_layout')

@section('content')
    <div class="container-fluid">
        <div class="col-md-8 col-md-offset-2">
            <display :items.sync="items" :total_zakat="total_zakat" :total_infaq="total_infaq" :total="total"></display>
        </div>
    </div>
@endsection
