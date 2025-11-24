@section('title', 'Санскрито->Тибето->Латинская транслитерация мантр')

@section('content')

    <div class="text-justify text-lg sm:text-xl leading-relaxed space-y-4 prose max-w-none">

        <h3 class="text-center">Таблица транслитерации санскрита и тибетского</h3>
        <p class="text-center text-base text-sky-700 italic mb-4">Академические стандарты: IAST (санскрит) и Extended Wylie (тибетский)</p>

        <div class="flex justify-center my-6">
            <table class="comparison-table" style="max-width: 480px; table-layout: fixed;">
                <thead>
                <tr>
                    <th class="border border-sky-300 px-2 py-3 text-sky-900 font-bold text-center align-middle" style="width: 25%;">Санскрит<br><span style="font-size: 0.85rem; font-weight: normal;">(देवनागरी)</span></th>
                    <th class="border border-sky-300 px-2 py-3 text-sky-900 font-bold text-center align-middle" style="width: 25%;">IAST</th>
                    <th class="border border-sky-300 px-2 py-3 text-sky-900 font-bold text-center align-middle" style="width: 25%;">Тибетский<br><span style="font-size: 0.85rem; font-weight: normal;">(བོད་ཡིག)</span></th>
                    <th class="border border-sky-300 px-2 py-3 text-sky-900 font-bold text-center align-middle" style="width: 25%;">Wylie</th>
                </tr>
                </thead>
                <tbody>

                <!-- Om -->
                <tr class="bg-yellow-200">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ॐ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">oṃ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨོཾ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">oM</td>
                </tr>

                <!-- Разделитель -->
                <tr><td colspan="4" class="border-t-2 border-sky-400"></td></tr>

                <!-- ГЛАСНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Гласные (स्वर / དབྱངས།)</td>
                </tr>

                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">अ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">a</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">a</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">आ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ā</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨཱ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">A</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">इ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">i</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨི</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">i</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ई</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ī</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨཱི</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">I</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">उ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">u</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨུ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">u</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ऊ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ū</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨཱུ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">U</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ऋ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṛ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">རྀ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">r-i</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ॠ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṝ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">རཱྀ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">r-I</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ऌ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ḷ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ལྀ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">l-i</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ॡ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ḹ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ལཱྀ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">l-I</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ए</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">e</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨེ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">e</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ऐ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ai</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨཻ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ai</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ओ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">o</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨོ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">o</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">औ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">au</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨཽ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">au</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">अं</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">aṃ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨྃ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">aM</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">अः</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">aḥ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཨཿ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">aH</td>
                </tr>

                <!-- Разделитель -->
                <tr><td colspan="4" class="border-t-2 border-sky-400"></td></tr>

                <!-- ВЕЛЯРНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Велярные (कवर्ग / ཀ་ཚོགས།)</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">क</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ka</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཀ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ka</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ख</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">kha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཁ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">kha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ग</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ga</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ག</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ga</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">घ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">gha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">གྷ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">g+ha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ङ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṅa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ང</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">nga</td>
                </tr>

                <!-- ПАЛАТАЛЬНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Палатальные (चवर्ग / ཅ་ཚོགས།)</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">च</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ca</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཅ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">tsa</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">छ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">cha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཆ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">tsha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ज</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ja</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཇ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ja</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">झ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">jha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཇྷ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">j+ha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ञ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ña</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཉ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">nya</td>
                </tr>

                <!-- РЕТРОФЛЕКСНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Ретрофлексные (टवर्ग / ཊ་ཚོགས།)</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ट</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṭa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཊ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">Ta</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ठ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṭha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཋ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">Tha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ड</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ḍa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཌ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">Da</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ढ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ḍha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཌྷ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">D+ha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ण</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṇa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཎ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">Na</td>
                </tr>

                <!-- ДЕНТАЛЬНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Дентальные (तवर्ग / ཏ་ཚོགས།)</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">त</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ta</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཏ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ta</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">थ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">tha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཐ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">tha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">द</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">da</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ད</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">da</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ध</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">dha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">དྷ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">d+ha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">न</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">na</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ན</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">na</td>
                </tr>

                <!-- ГУБНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Губные (पवर्ग / པ་ཚོགས།)</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">प</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">pa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">པ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">pa</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">फ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">pha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཕ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">pha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ब</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ba</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">བ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ba</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">भ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">bha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">བྷ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">b+ha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">म</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ma</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">མ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ma</td>
                </tr>

                <!-- ПОЛУГЛАСНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Полугласные (अन्तःस्थ / འཇམ་དབྱངས།)</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">य</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ya</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཡ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ya</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">र</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ra</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ར</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ra</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ल</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">la</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ལ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">la</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">व</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">va</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཝ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">wa</td>
                </tr>

                <!-- ФРИКАТИВНЫЕ -->
                <tr class="bg-sky-200">
                    <td colspan="4" class="border border-sky-300 px-2 py-2 text-center align-middle font-bold text-sky-800" style="font-size: 1.05rem;">Фрикативные (ऊष्म / སྲ་སྒྲ།)</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">श</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">śa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཤ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">sha</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ष</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ṣa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཥ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">Sha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">स</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">sa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ས</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">sa</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">ह</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ha</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཧ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">ha</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">क्ष</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">kṣa</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཀྵ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">k+Sha</td>
                </tr>

                <!-- Разделитель -->
                <tr><td colspan="4" class="border-t-2 border-sky-500"></td></tr>

                <!-- МАНТРИЧЕСКИЕ СЛОГИ -->
                <tr class="bg-yellow-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">हूँ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">hūṃ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཧཱུྃ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">hUM</td>
                </tr>
                <tr class="bg-white">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">फट्</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">phaṭ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">ཕཊ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">phaT</td>
                </tr>
                <tr class="bg-sky-100">
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Devanagari', serif; font-size: 1.6rem;">स्वाहा</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">svāhā</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle" style="font-family: 'Noto Sans Tibetan', serif; font-size: 1.6rem;">སྭཱ་ཧཱ</td>
                    <td class="border border-sky-300 px-2 py-3 text-center align-middle font-mono" style="font-size: 1.1rem;">swA hA</td>
                </tr>

                </tbody>
            </table>
        </div>

        <h3 class="text-center">Правила транслитерации IAST</h3>
        <ul class="list-disc pl-5 space-y-2 ml-8 text-base">
            <li class="my-2"><strong>Долгота гласных</strong>: макрон обозначает долгую гласную (ā, ī, ū, ṝ, ḹ)</li>
            <li class="my-2"><strong>Ретрофлексные согласные</strong>: точка под буквой (ṭ, ṭh, ḍ, ḍh, ṇ, ṣ, ṛ, ḷ)</li>
            <li class="my-2"><strong>Палатальные</strong>: ś (палатальная), ñ (палатальная носовая)</li>
            <li class="my-2"><strong>Велярная носовая</strong>: ṅ</li>
            <li class="my-2"><strong>Анусвара</strong> (ं): записывается как ṃ</li>
            <li class="my-2"><strong>Висарга</strong> (ः): записывается как ḥ</li>
            <li class="my-2"><strong>Придыхательные</strong>: gh, jh, ḍh, dh, bh (две буквы = один звук)</li>
        </ul>

        <h3 class="text-center mt-6">Правила транслитерации Wylie</h3>
        <ul class="list-disc pl-5 space-y-2 ml-8 text-base">
            <li class="my-2"><strong>Заглавные буквы</strong>: обозначают санскритские звуки в Extended Wylie (ретрофлексные: T, Th, D, N, Sh; долгие гласные: A, I, U)</li>
            <li class="my-2"><strong>Составные согласные</strong>: соединяются знаком "+" (g+ha, k+Sha)</li>
            <li class="my-2"><strong>Гласные ṛ и ḷ</strong>: передаются как r-i, r-I, l-i, l-I</li>
            <li class="my-2"><strong>Анусвара</strong>: заглавная M</li>
            <li class="my-2"><strong>Висарга</strong>: заглавная H</li>
            <li class="my-2"><strong>Тибетские звуки</strong>: tsa, tsha, dza (палатальные ряды)</li>
        </ul>

        <h3 class="text-center mt-6">Примеры мантр в IAST и Wylie</h3>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-purple-50 rounded-r-lg">
            <h4 class="font-bold text-sky-800 mb-2">Краткая мантра Ваджрасаттвы:</h4>
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">ཨོཾ་བཛྲ་ས་ཏྭ་ཧཱུྃ།</p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono"><strong>IAST:</strong> <em>oṃ vajra sattva hūṃ</em></p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono"><strong>Wylie:</strong> <em>oM badz+ra sat+t+wa hUM</em></p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <h4 class="font-bold text-sky-800 mb-2">Стослоговая мантра Ваджрасаттвы:</h4>
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                ཨོཾ་བཛྲ་ས་ཏྭ་ས་མ་ཡ་མ་ནུ་པཱ་ལ་ཡ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>oṃ vajra sattva samaya manu pālaya</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>oM badz+ra sat+t+wa sa ma ya ma nu pA la ya</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                བཛྲ་ས་ཏྭ་ཏྭེ་ནོ་པ་ཏིཥྛ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>vajra sattva tvenopa tiṣṭha</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>badz+ra sat+t+wa t+we no pa tiShTha</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                དྲྀ་ཌྷོ་མེ་བྷ་ཝ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>dṛḍho me bhava</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>dr-iDho me b+ha wa</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                སུ་ཏོ་ཤྱོ་མེ་བྷ་ཝ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>sutoso me bhava</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>su to shYO me b+ha wa</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                སུ་པོ་ཤྱོ་མེ་བྷ་ཝ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>supoṣyo me bhava</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>su po shYO me b+ha wa</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                ཨ་ནུ་རཀྟོ་མེ་བྷ་ཝ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>anurakto me bhava</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>A nu RAKTO me b+ha wa</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                སརྦ་སིདྡྷི་མེ་པྲ་ཡ་ཙྪྱཱ་ཥྛི་ཏཾ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>sarva siddhi me prayaccha</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>SARBA SID DHI MME PRA YA TSHYa / TSHTSha</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                སརྦ་ཀརྨ་སུ་ཙ་མེ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>sarva karmasu ceme</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>SARBA KARMA SU TSA ME</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                ཚིཏྟི་ཾ་ཨཾ་ཤྲི་ཾ་ཡཾ་ཀུ་རུ་ཧཱུྃ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>cittīṃ śrīṃ yāṃ kuru hūṃ</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>TSITTIm SHRi YaM KU RU Hum</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-amber-100 rounded-r-lg">
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">
                ཧཱུྃ་ཕཊ།
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>IAST:</strong> <em>hūṃ phaṭ</em>
            </p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono">
                <strong>Wylie:</strong> <em>Hum PHAt</em>
            </p>
        </div>

        <div class="my-6 p-4 border-l-4 border-sky-600 bg-purple-50 rounded-r-lg">
            <h4 class="font-bold text-sky-800 mb-2">Мантра Ваджрабхайравы:</h4>
            <p class="font-medium text-sky-950 text-lg leading-relaxed" style="font-family: 'Noto Sans Tibetan', serif;">ཨོཾ་ཧྲཱིཿ་ཤྲཱིཿ་བི་ཀྲྀ་ཏ་ན་ན་ཧཱུྃ་ཕཊ།</p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono"><strong>IAST:</strong> <em>oṃ hrīḥ śrīḥ vikṛta nana hūṃ phaṭ</em></p>
            <p class="font-medium text-sky-950 text-base leading-relaxed font-mono"><strong>Wylie:</strong> <em>oM hrIH shrIH bi kr-i ta na na hUM phaT</em></p>
        </div>

        <div class="my-6 p-4 border-l-4 border-amber-500 bg-amber-50 rounded-r-lg">
            <ul class="list-disc pl-5 space-y-2 text-base">
                <li><strong>IAST (International Alphabet of Sanskrit Transliteration)</strong> — международный стандарт для санскрита, принятый в 1894 году. Используется в большинстве академических изданий по индологии и буддологии.</li>
                <li><strong>ISO 15919</strong> — стандарт 2001 года, практически идентичный IAST с минимальными отличиями (например, анусвара: ṁ вместо ṃ).</li>
                <li><strong>Wylie transliteration</strong> — система для тибетского письма, разработанная Турреллом Уайли в 1959 году. Передаёт орфографию, а не произношение.</li>
                <li><strong>Extended Wylie (EWTS)</strong> — расширение для транслитерации санскритских слов, записанных тибетским письмом. Использует заглавные буквы для санскритских звуков.</li>
            </ul>
        </div>

        <div class="my-6 p-4 border-l-4 border-purple-500 bg-purple-50 rounded-r-lg">
            <ul class="list-disc pl-5 space-y-2 text-base">
                <li><strong>Онлайн-конвертеры:</strong> Sanskrit OCR (sanskritdocuments.org), ITRANS converter</li>
                <li><strong>Словари:</strong> Monier-Williams Sanskrit Dictionary, Tibetan & Himalayan Library</li>
                <li><strong>Fonts:</strong> Noto Sans Devanagari, Noto Sans Tibetan (Google Fonts)</li>
                <li><strong>Стандарты:</strong> ISO 15919:2001, Unicode Standard для деванагари (U+0900–U+097F) и тибетского (U+0F00–U+0FFF)</li>
            </ul>
        </div>

    </div>
@endsection
