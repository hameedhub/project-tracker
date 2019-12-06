@extends('student.layouts.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
<form action="{{ route('update', ['id'=> Auth::user()->id])}}", method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" id="first_name" placeholder="First Name">
          </div>
          <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control" id="inputPassword4" placeholder="Last Name">
          </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email Address</label>
                  <input type="email" disabled value="{{ Auth::user()->email }}" class="form-control" id="email" placeholder="Email Address">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Phone Number</label>
                  <input type="tel" name="phone" value="{{ Auth::user()->phone }}" class="form-control" id="phone" placeholder="Phone Number">
                </div>
              </div>
        <div class="form-group">
          <label for="inputAddress">Address</label>
          <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" id="inputAddress" placeholder="Address">
        </div>
        {{method_field('PATCH')}}
        
        <button type="submit" class="btn btn-primary">Update</button>
      </form>


</div>
@endsection