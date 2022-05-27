@extends('layouts.app')
@section('title', ' Lista de Tarea')
@section('content')
    <div class="row" id="task-list">
        <h1 class="col-6">Tu lista de tareas</h1>
        <p class="col-6 text-right"> Faltan {{$diff}} días</p>
    </div>
    <div class="row pb-4">
        <div class="col-4">
            <div class="progress">
                <div class="progress-bar bg-pink-300" role="progressbar" style="width: {{$percentageCompleted}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p>Completado: {{$tasks->where('completed_at', '!=', null)->count()}} / {{$tasks->count()}} </p>
        </div>
        <div class="col-8">
           <button data-toggle="modal" data-target="#exampleModalCenter" class="btn bg-pink-300 float-right">Añadir Tareas</button>
        </div>
    </div>
    @php
    use Carbon\Carbon;
    @endphp
    <x-card class="justify-content-center" id="tasks">
        @foreach($tasksPerPage as $key => $tasks)
        <div class="m-4 tasksPerPage" id="month{{$key}}">
            @foreach($tasks as $date => $tasks)
                @php
                $date = new Carbon($date);
                $date->locale('es_ES');
                @endphp
                <h3 class="pt-2">{{$date->monthName}} {{$date->year}}</h3>
                <hr>
                <div class="row mx-5">
                    @foreach($tasks as  $task)
                        <div class="col-md-8">
                            @if($task->completed_at)
                                <i class="fas fa-check-circle mr-3"></i>
                            @else
                                <i class="far fa-circle mr-3"></i>
                            @endif
                                {{$task->name}}
                        </div>
                        <div class="col-md-4">
                            <a data-toggle="modal" data-target="#exampleModalCenter{{$task->id}}" href=""><i class="fas fa-ellipsis-h fa-2x float-right"></i></a>
                        </div>
                        @include('customer.modals.task')
                    @endforeach
                </div>
                <hr>
            @endforeach
        </div>
        @endforeach

        <nav aria-label="Page navigation" class="">
            <ul class="pagination justify-content-md-center" >
                <li class="page-item m-2">
                    <a class="page-btn" href="#task-list">
                        <input type="hidden" value="month0" id="">
                        <i class="fas fa-circle fa-2x"></i>
                    </a>
                </li>
                <li class="page-item m-2">
                    <a class="page-btn" href="#task-list">
                        <input type="hidden" value="month1" id="">
                        <i class="fas fa-circle fa-2x"></i>
                    </a>
                </li>
                <li class="page-item m-2">
                    <a class="page-btn" href="#task-list">
                        <input type="hidden" value="month2" id="">
                        <i class="fas fa-circle fa-2x"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </x-card>
    <x-modal type="" title="Registrar Tarea">
        <form method="POST" action="{{route('task.store')}}">
            @csrf
            <div class="form-group">
                <label for="task">Nombre de la tarea</label>
                <input type="text" name="name" class="form-control" id="task" placeholder="Nombre de la tarea">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status" id="status">
                <label class="form-check-label" for="status">Marcar como terminada</label>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" value="" class="form-control" name="date" id="fecha" aria-describedby="fechaHelp">
                <small id="fechaHelp" class="form-text text-muted">Ingresa la fecha planeada para esta tarea.</small>
            </div>
            <div class="form-group">
                <label for="comentario">Comentario</label>
                <textarea class="form-control" id="comentario" name="comment" rows="3">

                </textarea>
            </div>
            <button type="submit" class="btn bg-pink-300">Save changes</button>
        </form>
    </x-modal>
    <script>
        $( document ).ready(function() {
            $('#month1').hide();
            $('#month2').hide();
            $( ".page-btn" ).click(function() {
                $('.tasksPerPage').hide();
                let id = $(this).children('input').val();
                $('#'+id).show();
            });
        });
    </script>
@endsection
