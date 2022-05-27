

        <div class=" col-md-6">
            <div class="form-group col-md-12">
                <label for="guests">Seleccionar invitados</label>
                <input id="guests" wire:model="search" type="text" class="form-control @error('guests') is-invalid @enderror" name="guests" placeholder="Buscar entre los asistentes" value="{{ old('guests') }}" autocomplete="guests">
                @error('guests')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-12">
                <x-card class="overflow-auto pl-3" style="height: 350px;">
                    <div class="py-2">
                        @foreach ($invitations as $invitation)
                            <div class="form-check">
                                <input class="form-check-input invitation" type="checkbox" name="guests[]" value="{{$invitation->id}}" id="invitation{{$invitation->id}}">
                                <label id="name{{$invitation->id}}" class="form-check-label" for="invitation{{$invitation->id}}">
                                    {{ $invitation->firstname }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        </div>
    </div>


