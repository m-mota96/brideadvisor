<x-modal type="modal-dialog modal-lg" class="" title="Crea una mesa">
    <form method="post" action="{{route('create.table')}}">
        @csrf
    <div class="row">

        <div class=" col-md-6">
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="table">Nombre de la mesa</label>
                    <input id="table" type="text" class="form-control @error('table') is-invalid @enderror" name="name" placeholder="Nombre de la mesa" value="{{ old('table') }}" required autocomplete="table">
                    @error('table')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="capacity">Capacidad</label>
                    <select class="form-control" id="capacity" name="quantity">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    @error('capacity')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="col-12" >
                <x-card style="height: 350px;" class="overflow-auto">
                    <div class="list-group" id="invitationList">

                    </div>
                </x-card>
            </div>
        </div>
                @livewire('search-invitation')
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>

</x-modal>
