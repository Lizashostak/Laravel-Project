@extends('cms.cmsmaster')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="table-responsive col-xs-12 col-md-12">
                    <div class="table-responsive col-xs-1 col-md-1">
                    </div>
                    <div class="table-responsive col-xs-2 col-md-2">
                        <p> <b><u>Name</b></u></p> 
                    </div>
                    <div class="table-responsive col-xs-6 col-md-6">
                        <p><b><u> Email </b></u></p> 
                    </div>
                    <div class="table-responsive col-xs-2 col-md-2">
                        <p><b><u> Date </b></u></p> 
                    </div>
                </div>
                @foreach($messages as $message)
                <div class="table-responsive col-xs-12 col-md-12 msg">
                    <div class="table-responsive col-xs-1 col-md-1 msg-icon">
                        @if($message['status']==0)
                        <p><i class="fas fa-envelope"></i></p>
                        @else
                        <p><i class="far fa-envelope-open"></i></p>
                        @endif
                    </div>
                    <div class="table-responsive col-xs-2 col-md-2">
                        <p>{{ucwords($message['name'])}}</p>
                    </div>
                    <div class="table-responsive col-xs-6 col-md-6">
                        <p>{{$message['email']}}</p>
                    </div>
                    <div class="table-responsive col-xs-2 col-md-2">
                        <p>{{$message['created_at']}}</p>
                    </div>
                    <div style="display: none" class="msg_id">
                        {{$message['id']}}
                    </div>
                    <div class="table-responsive col-xs-1 col-md-1 trash" data-id="{{$message['id']}}">
                        <i class="far fa-trash-alt"></i>
                    </div>
                </div>
                <div style="display: none" class="table-responsive col-xs-12 col-md-12 msg-main" data-status="unread">
                    <p>{{$message['message']}}</p>
                </div>
                @endforeach
            </div>

            <div class="pull-right">
                {{ $messages_p->links() }}
            </div>
        </div>
    </div>
</div>

</section>


<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
            </div>
            <!--Body-->
            <div class="modal-body">
                <p class="heading">Delete this Message?</p>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center">
                <button type="button" class="btn main-btn" id="delete_msg">Yes</button>
                <button type="button" class="btn  primary-btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--Modal: modalConfirmDelete-->


@endsection('content')