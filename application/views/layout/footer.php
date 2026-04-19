<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container text-center">
        <img src="<?= base_url('assets/images/oes-logo.png'); ?>" alt="Logo" style="filter: brightness(0) invert(1); height: 50px;" class="mb-4">
        <p class="text-white-50 mx-auto" style="max-width: 500px;">Official provider of Oxbridge Educational Services books and curriculum materials.</p>
        <hr class="my-4 opacity-25">
        <p class="small mb-0">&copy; 2026 Oxbridge Educational Services. Developed by [Your Name]</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Initialize Product Slider
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.productSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            grabCursor: true,
            loop: false, // Set to true if you want infinite scrolling
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Responsiveness
            breakpoints: {
                640: { 
                    slidesPerView: 2,
                    spaceBetween: 20 
                },
                768: { 
                    slidesPerView: 3,
                    spaceBetween: 30 
                },
                1024: { 
                    slidesPerView: 4,
                    spaceBetween: 30 
                },
            }
        });
    });
</script>
</body>
</html>