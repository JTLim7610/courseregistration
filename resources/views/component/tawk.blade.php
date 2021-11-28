<!--Start of Tawk.to Script-->
@if(Auth::check())
<script type="text/javascript">
    var Tawk_API = Tawk_API || {};
    Tawk_API.visitor = {
        name: '{{Auth::user()->name}}',
        email: '{{getMerchant()->email}}'
    };
    var Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/60efcf58649e0a0a5ccc4b87/1fakc3sdo';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
@endif
<!--End of Tawk.to Script-->