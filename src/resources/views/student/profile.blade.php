@extends('student.layouts.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
<form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" value="{{ Auth::user()->first_name }}" id="first_name" placeholder="First Name">
          </div>
          <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input type="text" value="{{ Auth::user()->last_name }}" class="form-control" id="inputPassword4" placeholder="Last Name">
          </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email Address</label>
                  <input type="email" value="{{ Auth::user()->email }}" class="form-control" id="email" placeholder="Email Address">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Phone Number</label>
                  <input type="tel" value="{{ Auth::user()->phone }}" class="form-control" id="phone" placeholder="Phone Number">
                </div>
              </div>
        <div class="form-group">
          <label for="inputAddress">Address</label>
          <input type="text" value="{{ Auth::user()->address }}" class="form-control" id="inputAddress" placeholder="Address">
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
      </form>


</div>
@endsection