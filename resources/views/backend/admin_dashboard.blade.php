@extends('backend.backend_master')

@section('content')


<div class="page-wrapper">

    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <center>
            <h4 class="page-title">Admin Dashboard</h4>
          </center>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <div class="card" style="height:100%">

            @if (session('success_project'))
                <div class="alert alert-success">
                    <center>
                      {{ session('success_project') }}
                    </center>
                </div>
            @endif

            <form class="form-horizontal" action="{{route('projects.store')}}" method="post">
              @csrf
              <div class="card-body">
                <h3 class="card-title">Create Project</h3>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name <span style="color:red"><strong>*</strong></span></label>
                  <div class="col-sm-9">
                    <input required type="text" class="form-control" name="name" placeholder="e.g Paypal Integration">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="location" class="col-sm-3 text-end control-label col-form-label">Location <span style="color:red"><strong>*</strong></span></label>
                  <div class="col-md-9">
                    <div class="form-check">
                      <input checked type="radio" class="form-check-input" id="locationControlValidation1" name="external" value="0">
                      <label class="form-check-label mb-0" for="locationControlValidation1">Internal</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="locationControlValidation2" name="external" value="1">
                      <label class="form-check-label mb-0" for="locationControlValidation2">External</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="external_url" class="col-sm-3 text-end control-label col-form-label">External URL</label>
                  <div class="col-sm-9">
                    <input type="url" class="form-control" name="external_url" placeholder="e.g https://cardano.markevans.work">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="image" class="col-sm-3 text-end control-label col-form-label">Image <span style="color:red"><strong>*</strong></span></label>
                  <div class="col-sm-9">
                    <input required type="text" class="form-control" name="image" placeholder="e.g paypal.jpg">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-3 text-end control-label col-form-label">Description <span style="color:red"><strong>*</strong></span></label>
                  <div class="col-sm-9">
                    <textarea required type="text" rows="3" minlength="20" maxlength="200" class="form-control" name="description" placeholder="Up to 200 characters"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="category" class="col-sm-3 text-end control-label col-form-label">Category Tags <span style="color:red"><strong>*</strong></span></label>
                  <div class="col-sm-9">
                    <input required type="text" class="form-control" maxlength="100" name="category" placeholder="e.g laravel,blockchain,cardano">
                  </div>
                </div>

              </div>
              <div class="border-top">
                <div class="card-body">
                  <button type="submit" class="btn btn-primary" style="width:100%">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card" style="height:100%">
            <div class="card-body">
              <center>
                <h3 class="card-title">Projects</h3>
              </center>

              @if (session('success_delete'))
                <div class="alert alert-success">
                    <center>
                      {{ session('success_delete') }}
                    </center>
                </div>
            @endif

                @if($projects->count() > 0)
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>External?</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($projects as $project)
                      <tr>
                        <td>{{ ucfirst($project->name)}}</td>
                        <td>{{$project->position}}</td>
                        @if($project->external == true)
                          <td>{{ $project->external_url }}</td>
                        @else 
                          <td>Internal</td>
                        @endif
                        <td><a href="/admin/projects/{{$project->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                        <td>
                          <form action="/admin/projects/{{$project->id}}" method="post">
                            @csrf 
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                  </table>
                </div>

                @else 
                <p>
                  No projects created...
                </p>
                @endif
                
           
            </div>
       
          </div>
        </div>

      </div>
    </div>


@endsection


