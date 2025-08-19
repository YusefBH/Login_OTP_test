<?php

namespace App\DTOs;

readonly class RegisterDTO
{
    public function __construct(
        public string $name,
        public string $last_name,
        public string $national_code,
        public string $phone_number,
        public string $password,
    ) {
    }

    public static function fromRequest(
        string $name,
        string $last_name,
        string $national_code,
        string $phone_number,
        string $password,
    ): self {
        return new self(
            name: $name,
            last_name: $last_name,
            national_code: $national_code,
            phone_number: $phone_number,
            password: $password,
        );
    }
}
