<div>
    <img 
        src="{{ asset('images/placeholder.png') }}" 
        data-src="{{ $url }}" 
        alt="{{ $alt ?? '' }}"
        class="lazy-image {{ $class ?? '' }}"
        width="{{ $width ?? 300 }}"
        height="{{ $height ?? 300 }}"
        loading="lazy"
    >
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    let lazyImages = [].slice.call(document.querySelectorAll("img.lazy-image"));

    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove("lazy-image");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
});
</script>
@endpush
