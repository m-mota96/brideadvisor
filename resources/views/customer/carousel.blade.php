<div id="carouselExample" class="carousel slide pt-4" data-ride="carousel" data-interval="9000">
    <div class="carousel-inner row w-100 mx-auto" role="listbox">
        @foreach ($categories as $key => $category)
        @php
             $active = $key == 0 ? 'active' : '';
             $img =  str_replace(' ','_',strtolower($category->name));
        @endphp
        <div class="carousel-item col-md-4 {{$active}} ">
           <div class="panel panel-default">
              <div class="panel-thumbnail">
                <a href="#" title="image 1" class="thumb">
                    <img class="img-fluid mx-auto d-block " style="max-width: 100%; border-radius: 1.5rem !important;" src="{{asset('media/content/customer/banquete.jpg')}}">
                </a>
              </div>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
