@extends('LayoutHome.PBmaster')

@section('content')
    <div class="container mt-4">
        @include('PB.ViewArticel.header_details')
        @include('PB.ViewArticel.success-message')
        <div class="row">
            @include('PB.ViewArticel.leftside')
            @include('PB.ViewArticel.Summary')
        </div>
    </div>
    </div>


@endsection
