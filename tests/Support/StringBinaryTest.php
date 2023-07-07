<?php

namespace Tests\Support;

use Support\StringBinary;

test('it transforms a string to a binary representation', function (string $input, string $expected) {
    $output = (new StringBinary())->toBinary($input);

    expect($output)->toBe($expected);
})->with([
    [
        'input' => 'String Here',
        'expected' => '01010011 01110100 01110010 01101001 01101110 01100111 00100000 01001000 01100101 01110010 01100101',
    ],
]);
