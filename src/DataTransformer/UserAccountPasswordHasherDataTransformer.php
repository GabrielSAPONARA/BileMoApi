<?php

namespace App\DataTransformer;

use ApiPlatform\State\DataTransformerInterface;
use App\Entity\UserAccount;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAccountPasswordHasherDataTransformer implements DataTransformerInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {}

    /**
     * @param UserAccount $object
     */
    public function transform($object, string $to, array $context = []): UserAccount
    {
        if ($object->getPassword() && !$this->isPasswordHashed($object->getPassword())) {
            $hashedPassword = $this->passwordHasher->hashPassword($object, $object->getPassword());
            $object->setPassword($hashedPassword);
        }

        return $object;
    }

    /**
     * @param mixed $data
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // Apply this transformer only to UserAccount objects
        return $data instanceof UserAccount && $to === UserAccount::class;
    }

    private function isPasswordHashed(string $password): bool
    {
        return str_starts_with($password, '$2y$') || str_starts_with($password, '$argon2i$');
    }
}
