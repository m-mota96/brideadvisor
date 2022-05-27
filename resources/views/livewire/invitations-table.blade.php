<div>
    <div class="row mb-4">
        <div class="col-6 form-inline">
            <button data-toggle="modal" data-target="#myModal2" class="btn bg-pink-400">Agregar invitados</button>
            <i class="fas fa-envelope fa-3x ml-2"></i>
        </div>

        <div class=" col-6 form-inline">
            <i class="fas fa-download fa-2x"></i>
            <i class="fas fa-file-upload fa-2x mx-2"></i>
            <input wire:model="search" class="form-control w-75" type="text" placeholder="Search guests...">
        </div>
    </div>

    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th><a wire:click.prevent="sortBy('firstname')" role="button" href="#">
                        NOMBRE
                        @include('includes._sort-icon', ['field' => 'firstname'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('lastname')" role="button" href="#">
                        APELLIDOS
                        @include('includes._sort-icon', ['field' => 'lastname'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                        ASISTENCIA
                        @include('includes._sort-icon', ['field' => 'status'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('table_id')" role="button" href="#">
                        MESA
                        @include('includes._sort-icon', ['field' => 'table_id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('group_id')" role="button" href="#">
                        GROUP
                        @include('includes._sort-icon', ['field' => 'group_id'])
                    </a></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($invitations as $invitation)
                <tr>
                    <td>{{ $invitation->firstname }}</td>
                    <td>{{ $invitation->lastname }}</td>
                    <td>
                        @if($invitation->status == 2)
                            <i class="fas fa-circle text-green-400 mr-2"></i><span>confirmado</span>
                        @elseif($invitation->status == 1)
                            <p><i class="fas fa-circle text-yellow-400"></i>sin respuesta</p>
                        @elseif($invitation->status == 0)
                            <p><i class="fas fa-circle text-red-400"></i>no asista</p>
                        @endif

                    </td>
                    <td> @isset($invitation->table->name)  {{ $invitation->table->name}} @endisset</td>
                    <td> @isset($invitation->group->name)  {{ $invitation->table->name}} @endisset</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
