@extends('layouts.app')

@section('content')
            <div class="row justify-content-center">

                <div class="accordion" id="acordeonManuales">
                    @foreach($manuales as $manual)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $manual->id }}">
                            
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $manual->id }}" aria-expanded="true" aria-controls="collapse{{ $manual->id }}">
                                {{ $manual->modelo }}
                            </button>
                        </h2>
                        <div id="collapse{{ $manual->id }}" class="accordion-collapse collapse  "  data-bs-parent="#acordeonManuales">
                            <div class="accordion-body">
                                <iframe src="{{ asset('storage/manuales/') }}{{'/'.$manual->manual}}" width="100%" height="400vh"></iframe>
                            </div>
                        </div>
                    </div>
                        
                    @endforeach
                </div>
            </div>
@endsection
