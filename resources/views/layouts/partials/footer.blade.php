{{--<footer class="bg-sky-400 py-2">--}}
{{--    <div class="container mx-auto px-4 md:px-6 text-center text-sky-100">--}}

{{--        <div class="flex justify-center">--}}
{{--            <x-navigation :in-footer="true" />--}}
{{--        </div>--}}
{{--        <p class="mt-2 text-sm text-sky-900">&copy; {{ date('Y') }} Dandaron Tradition. All--}}
{{--            Rights Reserved.</p>--}}
{{--    </div>--}}
{{--</footer>--}}


<footer class="bg-sky-400 py-4">
    <div class="container mx-auto px-4 md:px-6 text-center text-sky-100">
        <div class="flex justify-center mb-4">
            <x-footer-navigation />
        </div>
        <p class="text-sm text-sky-900">&copy; {{ date('Y') }} Dandaron Tradition. All Rights Reserved.</p>
    </div>
</footer>
