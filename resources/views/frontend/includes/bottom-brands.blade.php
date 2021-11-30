<div id="brands-carousel" class="logo-slider wow fadeInUp" style="margin-top: 30px !important; margin-bottom: 75px !important;">
    <div class="logo-slider-inner">
      <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

        @foreach ($topBrands as $brand)
          <div class="item m-t-15"> 
            <a href="#" class="image"> 
              <img data-echo="{{ asset($brand->image) }}" src="{{ asset($brand->image) }}" alt=""> 
            </a> 
          </div>
          <!--/.item-->
        @endforeach

      </div>
      <!-- /.owl-carousel #logo-slider --> 
    </div>
    <!-- /.logo-slider-inner --> 
    
</div>