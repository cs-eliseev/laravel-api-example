<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'string' => 'Полу :attribute должно быть строкой.',
    'numeric' => 'Поле :attribute должно содержать число.',
    'array' => 'Поле :attribute должно быть массивом.',
    'alpha' => 'В поле :attribute допустимы только буквы.',
    'regex' => 'Неверный формат поля :attribute.',
    'email' => 'Поле :attribute должно содержать корректный E-mail.',
    'required_without_all' => 'Хотя бы одно из полей должно быть заполнено: :attribute / :values.',
    'between' => [
        'numeric' => 'Значение поля :attribute должно быть в пределах от :min до :max.',
        'string' => 'Поле :attribute должно быть длинной от :min до :max символов.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute не должно превышать :max.',
        'string' => 'Поле :attribute не должно быть длиннее :max символов.',
    ],
];
