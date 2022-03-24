@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @include('forms.success')

            <div class="card">
                <div class="card-header">
                    Forms List
                    <a href="{{route('forms.create')}}" class="mb-3 btn-primary btn float-end">Create Form</a>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Form Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Field Count</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formsList as $form)
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$form->name}}</td>
                                <td>{{$form->status == 0 ? 'Inactive' : 'Active'}}</td>
                                <td>{{$form->form_elements_count}}</td>
                                <td>
                                    <a href="{{route('forms.edit',$form->id)}}" class="btn btn-primary">Edit</a>
                                    <!-- <a type="button" class="btn btn-danger">Delete -->

                                    <form action="{{ route('forms.destroy', $form->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                    </form>
                                    <!-- </a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection