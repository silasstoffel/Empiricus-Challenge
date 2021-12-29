<?php

namespace Tests\Application\Users\Create;

use Empiricus\Domain\Users\UserRepositoryInterface;
use Empiricus\Application\Users\UserDTO;
use Empiricus\Domain\Users\User;
use Empiricus\Application\Users\Create\CreateUseCase;
use Empiricus\Infra\Shared\Password\PasswordManager;
use Empiricus\Infra\Shared\PrimaryKey\UUIDCreator;
use Tests\TestCase;
use Tests\Application\Mocks\UserRepositoryInMemory;

class CreateUseCaseTest extends TestCase
{
    private UserRepositoryInterface $repository;
    private string $userActionId = 'f5a336c1-e5de-4e00-9f96-7f0b9f1e0010';
    private string $userActionIdAnalyst = '2d671fda-4eb7-403c-a382-1ce8ff37b780';

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new UserRepositoryInMemory();
        $admin = User::fromArray([
            'id'           => $this->userActionId,
            'name'         => 'Admin Empiricus',
            'email'        => 'admin@empiricus.com.br',
            'role'         => 'admin',
            'avatarUrl'    => '',
            'city'         => 'Sao Paulo',
            'password'     => '1234656',
        ]);

        $analyst = User::fromArray([
            'id'           => $this->userActionIdAnalyst,
            'name'         => 'Analyst Empiricus',
            'email'        => 'analyst@empiricus.com.br',
            'role'         => 'analyst',
            'avatarUrl'    => '',
            'city'         => 'Sao Paulo - Sao Paulo',
            'password'     => '1234656',
        ]);
        $this->repository->save($admin);
        $this->repository->save($analyst);
    }

    public function testShouldAbleToCreateAnUser()
    {
        $useCase = new CreateUseCase(
            $this->repository,
            new UUIDCreator(),
            new PasswordManager()
        );

        $dto = UserDTO::fromArray([
            'name'         => 'Silas Stoffel de Castro Moura',
            'email'        => 'silasstofel@gmail.com',
            'role'         => 'customer',
            'avatarUrl'    => '',
            'city'         => 'Serra - ES',
            'password'     => '123456',
            'userIdAction' => $this->userActionId
        ]);

        $created = $useCase->execute($dto);
        $user = $this->repository->find($created->id);
        self::assertNotNull($user);
    }

    public function testShouldNotAbleToCreateAnUserWithoutEmail()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Argument email is not valid');

        $useCase = new CreateUseCase(
            $this->repository,
            new UUIDCreator(),
            new PasswordManager()
        );

        $dto = UserDTO::fromArray([
            'id'           => '8dbc3423-c2d5-4b76-a760-f9fc0ca69799',
            'name'         => 'Customer',
            'email'        => '',
            'role'         => 'admin',
            'avatarUrl'    => '',
            'city'         => 'Serra - ES',
            'password'     => '123456',
            'userIdAction' => $this->userActionId
        ]);

        $useCase->execute($dto);
    }

    public function testShouldNotAbleToCreateAnUserIsUserIsNotAdmin()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("You don't have permission to create users.");

        $useCase = new CreateUseCase(
            $this->repository,
            new UUIDCreator(),
            new PasswordManager()
        );

        $dto = UserDTO::fromArray([
            'id'           => '8dbc3423-c2d5-4b76-a760-f9fc0ca69799',
            'name'         => 'Customer',
            'email'        => 'email@email.com.br',
            'role'         => 'admin',
            'avatarUrl'    => '',
            'city'         => 'Serra - ES',
            'password'     => '123456',
            'userIdAction' => $this->userActionIdAnalyst
        ]);

        $useCase->execute($dto);
    }
}
