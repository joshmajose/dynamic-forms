@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Form

                <a href="{{route('forms.index')}}" class="mb-3 btn-primary btn float-end">List</a>
                </div>

                <div class="card-body">
                @include('forms.errors')
                    <form method="POST" action="{{ route('forms.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="formName" class="form-label">Form Name</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        <div class="mb-3">
                            <label for="formName" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status" >
                                <option value="1"{{old('status')== 1 ? 'selected': ''}}>Active</option>
                                <option value="0"{{old('status')== 0 ? 'selected': ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <h5>Form Fields</h5>
                        </div>
                        <div id="field_container">
                            <div class="row field-repeat">
                                <div class="mb-3 col-md-4">
                                    <label for="fieldLabel" class="form-label">Field Label</label>
                                    <input type="text" class="form-control" name="fieldLabel[]">
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label for="fieldType" class="form-label">Field Type</label>
                                    <select class="form-select field-type" aria-label="Default select example" name="fieldType[]">
                                        <option value="">--select--</option>
                                        @foreach($elementTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4 field-value" style="display: none;">
                                    <label for="fieldValue" class="form-label">Values</label>
                                    <input type="text" class="form-control" name="fieldValues[]" placeholder="Add values separated by commas">
                                </div>
                                <div class="mb-3 col-md-1 row-delete" style="display: none;">
                                    <button type="button" class="btn btn-danger float-end remove-row" id="">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success float-end" id="add_more">Add More</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection