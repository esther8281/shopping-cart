@extends('layout.form')
@section('content')
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">List  Products </h5>
            </div>
           
        </div>
        <!-- /Title -->
           <table border="1">
               <tr>
                    <td>Id</td>
                   <td>Name</td>
                   <td>Price</td>
                   <td>Qauntity</td>
                   <td>Image</td>
                   <td colspan="2">Action</td>
               </tr>
               @if(count($products))
               @foreach($products as $key => $product)
               <tr>
                   <td>{{ ++$key }}</td>
                   <td>{{$product->name}}</td>
                   <td>{{$product->price}}</td>
                   <td>{{$product->quantity}}</td>
                   <td><img src="{{$product->avatar_url}}" width="40px" height="50px"></td>
                   <td><a href="{{url('/product/'. $product->id.'/edit')}}">Edit</a></td>
                   <td><a href="{{url('/product/'. $product->id.'/destroy')}}">Delete</a></td>
               </tr>
               @endforeach
               @else
               <tr>
                   <td  colspan="6">No Products Found</td>
               </tr>
               @endif
           </table>
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