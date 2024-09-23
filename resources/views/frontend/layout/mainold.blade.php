<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($featuredProduct->chunk(4) as $chunk)
                        <div class="item {{ $loop->first ? 'active' : '' }}">
                            <ul class="thumbnails">
                                @foreach($chunk as $featured)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <i class="tag"></i>
                                            <a href="">
                                                <img src="{{ asset('storage/' .$featured->mainImage->path ?? 'images/default-image.png') }}" alt="{{ $featured->name }}" class="img-fluid">
                                            </a>
                                            <div class="caption">
                                                <h5>{{ $featured->name }}</h5>
                                                <h4>
                                                    <a class="btn" href="">VIEW</a>
                                                    <span class="pull-right">{{ number_format($featured->price, 2) }} $</span>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
</div>
