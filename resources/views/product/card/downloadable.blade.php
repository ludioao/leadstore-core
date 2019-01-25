
@include('avored-framework::forms.file',['name' => 'downloadable[demo_product]','label' => 'Demo Product (If any)'])

@if(isset($model) && isset($model->downloadable) && $model->downloadable->demo_path != "")
        
<a href="{{ route('admin.product.download.demo.media', $model->downloadable->token) }}"
           class="download-main-media-link" 
    >
        Download Demo Media
    </a>
@endif



@include('avored-framework::forms.file',['name' => 'downloadable[main_product]','label' => 'Main Product'])

@if(isset($model) && isset($model->downloadable) && $model->downloadable != "")

    
    
    <a href="{{ route('admin.product.download.main.media', $model->downloadable->token) }}"
           class="download-main-media-link" 
    >
        Download Main Media
    </a>
    

@endif
