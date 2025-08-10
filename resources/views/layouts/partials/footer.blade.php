<footer class="bg-gray-800 text-gray-300 py-6">
    <div class="container mx-auto px-4 md:px-6 flex flex-col md:flex-row justify-between items-center">
        <div class="text-center md:text-left mb-4 md:mb-0">
            <p>&copy; {{ date('Y') }} Dandaron Tradition. All Rights Reserved.</p>
        </div>

        {{-- Компонент навигации с параметром, чтобы скрыть кнопки входа/регистрации --}}
        <x-navigation :in-footer="true" />
    </div>
</footer>
