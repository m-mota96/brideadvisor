@extends('layouts.app')
@section('title', ' Invitacion')
@push('styles')
   <link href="{{ asset('css/customer/expense.css') }}" rel="stylesheet">

    <style>
        .vl {
            border-left: 2px solid green;
            height: 100px;
        }

        .modal.left .modal-dialog,
        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 500px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content,
        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left .modal-body,
        .modal.right .modal-body {
            padding: 15px 15px 80px;
        }

        /*Left*/


        /*Right*/
        .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .modal-header {
            border-bottom-color: #EEEEEE;
            background-color: #FAFAFA;
        }

        /* ----- v CAN BE DELETED v ----- */


        .demo {
            padding-top: 60px;
            padding-bottom: 110px;
        }

        .btn-demo {
            margin: 15px;
            padding: 10px 15px;
            border-radius: 0;
            font-size: 16px;
            background-color: #FFFFFF;
        }

        .btn-demo:focus {
            outline: 0;
        }

    </style>
@endpush
@section('content')

    <section id="tabs" class="project-tab">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Invitados</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Acomodo de mesas</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @include('includes._invitations-stats')
                        <h4 class="py-3">Tu lista de invitados</h4>
                        <div>
                                @livewire('invitations-table')
                                @include('includes.sidebar')
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @include('includes._invitations-stats')
                        <h1 class="text-center mt-2">Asigna una mesa a tus invitados</h1>
                        <div class="row">
                            <div class="col-4">
                                <button class="btn bg-pink-400" data-toggle="modal" data-target="#exampleModalCenter">Crear una mesa</button>
                            </div>
                            <div class="col-4">
                                <p>No de invitados sin mesa: {{$invitationWithoutTable}}</p>
                            </div>
                            <div class="col-4 float-right">
                                <i class="fas fa-download fa-1x"></i>
                                <i class="fas fa-file-upload fa-1x mx-2"></i>
                            </div>
                        </div>
                        <div class="row py-4">
                            @foreach($tables as $table)
                            <div class="col-4">
                                <x-card class="" style="height: 350px;">
                                    <div class="bg-pink-100 pl-3">
                                    <h3>{{$table->name}}</h3>
                                        <p><small>Capacidad de {{$table->quantity}} invitados</small></p>
                                    </div>
                                    <div class="pl-3 overflow-auto" style="height: 220px;">
                                    @foreach($table->invitation as $guest)
                                        <p>{{$guest->firstname}} {{$guest->lastname}}</p>
                                    @endforeach
                                    </div>
                                    <div class="text-center">
                                        <a class="btn bg-pink-400 btn-sm">Editar</a>
                                        <a class="btn bg-pink-400 btn-sm">Borrar</a>
                                    </div>
                                </x-card>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('includes._create-table')
    </section>
    @push('scripts')
        <script>
            var count = 0;
            $(function(){
            $("#btn-add").click(function(){
                if(count < 5)
                {
                    $("#wrapper").append('<div class="input-group mb-3"><input type="text" class="form-control" name="guests[]"/>   <div class="input-group-append guest"><button class="btn btn-outline-secondary remove_field" type="button"><i class="fas fa-trash"></i></button></div>  </div>');
                    $("#wrapper").find("button").unbind("click");
                    count ++;
                }else{
                    alert('No se puede tener mas de 4 invitados');
                }
                $("#wrapper").find("div.guest").click(function(){
                    $(this).parent().remove();
                    count --;
                });
            });
        });
            $( document ).ready(function() {
           var invitationList = [];
                $("input:checkbox[name=type]:checked").each(function(){
                    invitationList.push($(this).val());
                });

            $('#guests').on('keydown paste',searchInvitation);
            checkInvitation(invitationList);
            console.log(invitationList);
            function checkInvitation(invitationList) {
                $(".invitation").change(function() {
                    let val = $(this).val();
                        let person = $(this).next('label').text();
                    if(this.checked) {
                       // invitationList.splice($.inArray(val, invitationList),1);
                        invitationList.push(val);
                        $("#"+val).remove();
                        $( "#invitationList" ).append( "<li class='list-group-item' id='"+val+"'>"+person+"</li>" );
                    }else{
                        invitationList.splice($.inArray(val, invitationList),1);
                        $("#"+val).remove();
                    }
                    return invitationList;
                });
            }
            function searchInvitation() {
               // checkInvitation(invitationList);
                $.each(invitationList, function( intIndex, objValue) {
                    $("input[id*='"+objValue+"']").each(function(){
                        //console.log(objValue);
                        $("#invitation"+objValue).prop("checked", true);
                    });
                });
            }
            });
        </script>
    @endpush
@endsection
