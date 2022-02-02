@extends('layouts.app')

@section('content')
            <div class="row justify-content-center">
                
                @foreach($manuales as $manual)
                    <div class="col-sm-6">
                        <iframe src="{{ asset('storage/manuales/') }}{{'/'.$manual->manual}}" width="75%" height="650vh"></iframe>
                    </div>
                @endforeach
                
            </div>
@endsection
