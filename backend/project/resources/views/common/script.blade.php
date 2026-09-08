<!-- JS here -->
<script src="{{ asset('assets/front') }}/js/vendor/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/front') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/front') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('assets/front') }}/js/jquery.odometer.min.js"></script>
<script src="{{ asset('assets/front') }}/js/BeerSlider.js"></script>
<script src="{{ asset('assets/front') }}/js/jquery.appear.js"></script>
<script src="{{ asset('assets/front') }}/js/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/front') }}/js/jarallax.min.js"></script>
<script src="{{ asset('assets/front') }}/js/slick.min.js"></script>
<script src="{{ asset('assets/front') }}/js/gsap.js"></script>
<script src="{{ asset('assets/front') }}/js/ScrollTrigger.js"></script>
<script src="{{ asset('assets/front') }}/js/SplitText.js"></script>
<script src="{{ asset('assets/front') }}/js/gsap-animation.js"></script>
<script src="{{ asset('assets/front') }}/js/tg-cursor.min.js"></script>
<script src="{{ asset('assets/front') }}/js/wow.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/lazy.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/lazy.plugin.js') }}"></script>
<script src="{{ asset('assets/front') }}/js/aos.js"></script>
<script src="{{ asset('assets/front') }}/js/main.js"></script>
@include('notify.alert')


<script>
    'use strict';
   $(function() {
        $('.lazy').lazy();
    });
</script>

@if (@$gs->is_tawk)
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        'use strict';
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = "https://embed.tawk.to/{{ @$gs->tawk_id }}";
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endif
