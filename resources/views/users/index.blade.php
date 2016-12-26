@extends('layouts.app')

@section('title', "Listado de usuarios")

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="panel col-xs-10 col-md-10">
                <h4> Listado </h4>
                <hr>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($users as $user)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $user->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                         {{ $user->id }} {{ $user->name }}  {{ $user->email }}
                                        </a>
                                    </h4>
                            </div>
                                <div id="collapse{{ $user->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                    @foreach($user->notes()->paginate(5)->sortBy('created_at') as $notes)

                                            @if ( $notes->comments->count() > 0 )
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal{{ $notes->id }}">
                                                    Hay {{ $notes->comments->count() }} comentarios
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="">
                                                    Sin comentarios
                                                </button>
                                            @endif

                                            <a href="{{ route('viewNote', $notes->id) }}">{{ $notes->title }}</a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $notes->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">{{ $notes->title }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach($notes->comments as $comment)
                                                                <hr>
                                                                {{ $comment->content }}
                                                            @endforeach

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <hr>
                                    @endforeach
                                        {!! $user->notes()->paginate(5) !!}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

            </div>


        </div>
    </div>



@endsection