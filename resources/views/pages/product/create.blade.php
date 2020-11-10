@extends('layout.form')
@section('content')
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Add Product </h5>
            </div>
           
        </div>
        <!-- /Title -->
            <!-- Row -->
        <form method="post" action="{{url('product')}}"  enctype="multipart/form-data" id="add-form">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <div class="row">         
            <div class="form-group">
                <label> Name</label>
                <input type="text" id="name" name="name" 
                    class="form-control" placeholder="Enter name" 
                    value="" required>
                @if ($errors->has('name'))
                    <label class="error">
                        {{ $errors->first('name') }}
                    </label>
                @endif
            </div>
            <div class="form-group">
                <label> Price</label>
                <input type="number" id="price" name="price" 
                    class="form-control" placeholder="Enter price" 
                    value="" required>
                @if ($errors->has('price'))
                    <label class="error">
                        {{ $errors->first('price') }}
                    </label>
                @endif
            </div>
            <div class="form-group">
                <label> Quantity</label>
                <input type="number" id="quantity" name="quantity" 
                    class="form-control" placeholder="Enter quantity" 
                    value="" required>
                @if ($errors->has('quantity'))
                    <label class="error">
                        {{ $errors->first('quantity') }}
                    </label>
                @endif
            </div>
            <div class="form-group">
                <label> Image</label>
                <input type="file" id="avatar" name="avatar" 
                    class="form-control" required>
                @if ($errors->has('avatar'))
                    <label class="error">
                        {{ $errors->first('avatar') }}
                    </label>
                @endif
            </div>
            <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i>
                <span class="btn-text">submit </span>
            </button>
        </div>
    </form>
        <!-- /Row -->
</div>
<!-- /Main Content -->
@endsection

@section('scripts')
    <script type="text/javascript">
        // validation
        $("#add-form").validate({
            rules: {
              
            },
            messages: {
                
            }
        });
       
    </script>
@endsection