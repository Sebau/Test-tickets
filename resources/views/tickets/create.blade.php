@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center gap-4">
        {{-- Botón para actualizar estado --}}
        <form method="POST" action="{{ route('tickets.save') }}" enctype="multipart/form-data">
            @csrf
            <!--Name-->
            <div class="mb-3">
                <label form="" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
                <div class="col-sm-8">
                <input id="name" name="name" type="text" class="form-control form-control-sm" require>
                </div>
            </div>
            <!--type-->
            <div class="mb-3">
                <label form="" class="col-sm-3 col-form-label col-form-label-sm">Type Of Ticket</label>
                <div class="">
                <select class="form-select" name="ticket_type" id="ticket_type" require>
                <option selected value="NULL">Selection type of Ticket</option>
                @foreach($types as $type)
                    <option value="{{ $type->type }}">{{ $type->type}}</option>  
                @endforeach 
                </select>
            </div>
            <!--Mode_of_Trasnport-->
            <div class="mb-3">
                <label form="" class="col-sm-3 col-form-label col-form-label-sm">Type Of Transport</label>
                <div class="">
                <select class="form-select" name="transport" id="transport" require>
                <option selected value="NULL">Selection type of Transport</option>
                @foreach($modeoftransport as $transport)
                    <option value="{{ $transport->name_mode_of_transport }}">{{ $transport->name_mode_of_transport}}</option>  
                @endforeach 
                </select>
            </div>
            <!--Product-->
            <div class="mb-3">
                <label form="" class="col-sm-2 col-form-label col-form-label-sm">Product</label>
                <div class="col-sm-8">
                <input id="product" name="product" type="text" class="form-control form-control-sm" require>
                </div>
            </div>
            <!--Product Condition-->
            <div class="mb-3">
                <label form="" class="col-sm-3 col-form-label col-form-label-sm">Type Of Transport</label>
                <div class="">
                <select class="form-select" name="product_condition" id="product_condition" require>
                <option selected value="NULL"></option>
                    <option value="1">Import</option>   
                    <option value="2">Export</option>   
                </select>
            </div>
            <!--Country_origin-->
            <div class="mb-3">
                <label form="" class="col-sm-3 col-form-label col-form-label-sm">Country of origin</label>
                <div class="">
                <select class="form-select" name="country_origin" id="country_origin" require>
                <option selected value="NULL">Selection Country of origin</option>
               
                @foreach($countryy as $country)
                    <option value="{{ is_array($country) ? $country['name']['common'] : $country }}">
                        {{ is_array($country) ? $country['name']['common'] : $country }}
                    </option>
                @endforeach 
                </select>
            </div>
            <!--Country_Destination-->
            <div class="mb-3">
                <label form="" class="col-sm-3 col-form-label col-form-label-sm">Country of Destination</label>
                <div class="">
                <select class="form-select" name="country_destination" id="country_destination" require>
                <option selected value="NULL">Selection Country of origin</option>
                 @foreach($countryy as $country)
                    <option value="{{ is_array($country) ? $country['name']['common'] : $country }}">
                        {{ is_array($country) ? $country['name']['common'] : $country }}
                    </option>
                @endforeach 
                </select>
            </div>
            <!--Add Documentation-->
            <div class="mb-3">
                <label for="file" class="form-label">Documentation</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <!--Status Not Complete-->
            <div class="mb-3">
                <hr>
                <button type="submit" value="{{ route('tickets.save') }}" class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
</div>
@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>
@endsection