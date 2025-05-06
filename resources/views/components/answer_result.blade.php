@foreach ($question->answers as $answer)
    @php
        $isSelected = $answer->id === $selectedAnswerId;
        $isCorrect = $answer->is_correct;
        $classes = 'block w-full text-left px-4 py-3 rounded-lg my-2 ';
        $icon = '🟦';

        if ($isSelected) {
            $classes .= $isCorrect ? 'bg-green-100 border border-green-500' : 'bg-red-100 border border-red-500';
            $icon = $isCorrect ? '✅' : '❌';
        } else {
            $classes .= 'bg-blue-100';
        }
    @endphp

    <div class="{{ $classes }}">
        {{ $icon }} {{ $answer->content }}

        @if ($isCorrect && $answer->hints->isNotEmpty())
            <div class="mt-2 text-sm text-gray-700">
                <p class="italic mb-1">Gợi ý cho đáp án đúng:</p>
                @foreach ($answer->hints as $hint)
                    <label class="block ml-2">
                        <input type="checkbox" disabled class="mr-1"> {{ $hint->content }}
                    </label>
                @endforeach
            </div>
        @endif
    </div>
@endforeach
