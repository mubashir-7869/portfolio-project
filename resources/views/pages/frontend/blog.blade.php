
<div id="blog" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h4>Our Blog Posts</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($blogs as $index => $blog)
                <div class="col-md-6">
                    <div class="blog-item" data-index="{{ $index }}">
                        <div class="thumb">
                            <!-- Blog Post Image -->
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            <div class="text-content">
                                <h4>{{ $blog->title }}</h4>
                                <span>Posted: <em>{{ $blog->author }}</em> / Date: <em>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</em> / Category: <em>{{ $blog->category }}</em></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pop-up Section for Blog Post Details -->
                <div class="pop pop{{ $index }}" style="display:none;">
                    <span>✖</span>
                    <p>{{ $blog->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div id="fun-facts">
    <div class="container">
        <div class="row">
            @foreach ($funFacts as $fact)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="fact-item">
                        <div class="counter" data-count="{{ $fact->count }}">0</div>
                        <span>{{ $fact->label }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.blog-item').each(function() {
        $(this).on('click', function() {
            const index = $(this).data('index');
            const popUp = $('.pop' + index);
            popUp.show();
        });
    });

    $('.pop span').each(function() {
        $(this).on('click', function() {
            const popUp = $(this).closest('.pop');
            popUp.hide();
        });
    });
});

</script>