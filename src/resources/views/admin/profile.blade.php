@extends('admin.layouts.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
<form method="POST" action="{{ 'update/'.Auth::user()->id }}">
  {{ csrf_field() }}
  @if(session('success'))
  <p></p>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong> {{session('success')}} </strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                   @endif
                   @if(session('error'))
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong> {{session('error')}} </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
           @endif

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input name="first_name" type="text" class="form-control" value="{{ Auth::user()->first_name }}" id="first_name" placeholder="First Name">
          </div>
          <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input name="last_name" type="text" value="{{ Auth::user()->last_name }}" class="form-control" id="inputPassword4" placeholder="Last Name">
          </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email Address</label>
                  <input disabled name="email" type="email" value="{{ Auth::user()->email }}" class="form-control" id="email" placeholder="Email Address">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Phone Number</label>
                  <input name="phone" type="tel" value="{{ Auth::user()->phone }}" class="form-control" id="phone" placeholder="Phone Number">
                </div>
              </div>
        <div class="form-group">
          <label for="inputAddress">Address</label>
          <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" id="inputAddress" placeholder="Address">
        </div>
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-primary">Update</button>
      </form>


</div>
@endsection