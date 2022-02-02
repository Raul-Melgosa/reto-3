@extends('layouts.app')

@section('content')
            <div class="row justify-content-center">
                
                @foreach($manuales as $manual)
                    <div class="col-11 col-sm-6">
                        <iframe src="{{ asset('storage/manuales/') }}{{'/'.$manual->manual}}" width="75%" height="400vh"></iframe>
                    </div>
                @endforeach
                
            </div>
@endsection
