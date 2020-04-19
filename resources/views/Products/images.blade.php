@extends('Layout.layout')

@section('titulo')
Edit Image SKU
@endsection
@section('custom_css')
<link rel="stylesheet" href="/css/custom.css">
@endsection
@section('title_content')
<h1><i class="fa fa-dashboard"></i>Edit Image SKU</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
<li class="breadcrumb-item"><a href="{{url()->current()}}">edit Image</a></li>
@endsection

@section('content')
    <div class="tile">
        <h2 class="text-center">{{$name}}</h2>
    	@foreach($items as $item)
	    	<div class="card mt-2" >
			  <div class="card-body">
			    <div class="row">
			    	<div class="col-4">
			    		<img src="{{$item->url}}" alt="" width="150px">
			    	</div>
			    	<div class="col-8">
			    		<h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">Updated at: {{$item->updated}}</p>
                    <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" id="form-{{$item->id}}" >
			    			 <input type="hidden" id='id' name="id" value="{{ $item->id }}">
			    			<div class="custom-file">
	                            <input type="file" class="custom-file-input" id="image-{{$item->id}}" required>
	                            <label class="custom-file-label" for="validatedCustomFile">Choose img...</label>
	                         </div>
	                          <div class="row justify-content-center mt-2">
	                          	<div class="col-4">
	                          		<button class="btn btn-outline-primary btn-block " id="sendImage" onclick="updatedImage(event,{{$item->id}})"><i class="fa fa-upload" aria-hidden="true" ></i> Update Image</button>
	                          	</div>
                              </div>
                        </form>
			    	</div>
			    </div>
			  </div>
			</div>
		@endforeach
    </div>
 <script >
 	btn = document.getElementById("sendImage");
 	const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    //html loader
    const spinnerHTML='<i class="fa fa-refresh fa-spin"></i> Loading'
 	function updatedImage (event,id){
        event.preventDefault();
        const imageOriginal = document.getElementById("image-"+id).files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            console.log('RESULT', reader.result)
            const image = reader.result

            let html = btn.innerHTML;
            btn.innerHTML = spinnerHTML;
            const setting= {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    image,
                    id
                }),
            };
            fetch('/products/update/images',setting).then(function(res){
                return res.json();
            }).then(function(data){
                btn.innerHTML=html;
                toastr.success('Image updated')
            }).catch(function(error){
                btn.innerHTML=html;
                toastr.error('Something fail')
            });
        }
        reader.readAsDataURL(imageOriginal);

 	};
 </script>
@endsection
