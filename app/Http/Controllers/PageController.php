<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug = 'home') // Если slug не передан, по умолчанию считаем, что это 'home'
    {
        // TODO: Здесь будет сложная логика поиска по вложенным slug'ам,
        // но пока для простоты ищем только по последнему сегменту.
        $placement = Placement::where('slug', $slug)->firstOrFail();

        // TODO: Здесь будет логика для отображения нужного шаблона
        // в зависимости от того, что привязано к placement'у (статья, книга и т.д.)

        // Временный вывод для проверки
        return "Вы на странице: " . $placement->title;
    }
}
